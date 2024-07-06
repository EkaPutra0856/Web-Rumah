<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Coordinate;
use App\Models\RegionalAdmin;
use Illuminate\Http\Request;
use App\Exports\RegionExport;
use App\Imports\RegionImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class RegionController extends Controller
{
    public function index()
    {
        if (Auth::guard('administrators')->check()) {
            $userId = Auth::guard('administrators')->user()->id;
            $regions = Region::where('administrator_id', $userId)->get();

            // Mengumpulkan data untuk grafik
            $kecamatanCounts = Region::where('administrator_id', $userId)
                ->select('kecamatan', 'kelurahan_desa')
                ->get()
                ->groupBy('kecamatan')
                ->map(function ($group) {
                    return $group->count();
                });

            // Data untuk grafik
            $graphtypes = [];
            foreach ($kecamatanCounts as $kecamatan => $count) {
                $graphtypes[] = [
                    'name' => $kecamatan,
                    'count' => $count
                ];
            }

            // Hitung jumlah wilayah yang ada
            $graphtype1 = 1;
            $graphtype2 = 1;

            session(['filtered_admin' => $regions]);
            return view('Region.index', compact('regions', 'graphtype1', 'graphtype2', 'graphtypes'));
        } else {
            return redirect("/")->withErrors('You are not allowed to access');
        }
    }

    public function getMarkers()
    {
        // Ambil semua marker dari database
        $markers = Coordinate::all(['latitude', 'longitude']);

        // Kembalikan data marker dalam format JSON
        return response()->json($markers);
    }

    public function insert(Request $request)
    {
        $userId = Auth::guard('administrators')->user()->id;

        $data = new Region();
        $data->administrator_id = $userId;
        $data->kecamatan = $request->kecamatan;
        $data->kelurahan_desa = $request->kelurahan_desa;
        $data->kode_pos = $request->kode_pos;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $data->image = $path;
        }

        // Save initial region data
        $data->save();

        // Loop through the latitude and longitude inputs
        foreach ($request->all() as $key => $value) {
            if (preg_match('/latitude(\d+)/', $key, $matches)) {
                $index = $matches[1];
                $latitude = $value;
                $longitudeKey = "longitude{$index}";
                if ($request->has($longitudeKey)) {
                    $longitude = $request->$longitudeKey;
                    // Save each coordinate pair
                    Coordinate::create(['region_id' => $data->id, 'latitude' => $latitude, 'longitude' => $longitude]);
                }
            }
        }

        session()->flash('success', 'Save Data Successfully!');
        return redirect('/wilayah');
    }

    public function update(Request $request, $id)
    {
        $data = Region::find($id);
        $data->kecamatan = $request->kecamatan;
        $data->kelurahan_desa = $request->kelurahan_desa;
        $data->kode_pos = $request->kode_pos;
        if ($request->hasFile('image')) {
            if ($data->image) {
                Storage::disk('public')->delete($data->image);
            }
            $path = $request->file('image')->store('images', 'public');
            $data->image = $path;
        }
        $data->save();

        // Delete old coordinates
        Coordinate::where('region_id', $id)->delete();

        // Loop through the latitude and longitude inputs
        foreach ($request->all() as $key => $value) {
            if (preg_match('/latitude(\d+)/', $key, $matches)) {
                $index = $matches[1];
                $latitude = $value;
                $longitudeKey = "longitude{$index}";
                if ($request->has($longitudeKey)) {
                    $longitude = $request->$longitudeKey;
                    // Save each coordinate pair
                    Coordinate::create(['region_id' => $data->id, 'latitude' => $latitude, 'longitude' => $longitude]);
                }
            }
        }

        session()->flash('success', 'Edit Data Successfully!');
        return redirect('/wilayah');
    }

    public function delete(Request $request, $id)
    {
        $data = Region::find($id);
        $data->delete();

        // Delete coordinates
        Coordinate::where('region_id', $id)->delete();

        session()->flash('success', 'Delete Data Successfully!');
        return redirect('/wilayah');
    }

    public function exportRegion()
    {
        $regions = session('filtered_admin', Region::all());
        return Excel::download(new RegionExport($regions), 'wilayah.xlsx');
    }

    public function exportPDF()
    {
        $regions = session('filtered_admin', Region::all());
        $pdf = FacadePdf::loadView('Region.pdf', ['regions' => $regions]);
        return $pdf->download('wilayah.pdf');
    }

    public function importRegion(Request $request)
    {
        try {
            // Validasi jenis file
            $request->validate([
                'import_file' => 'required|file|mimes:xls,xlsx',
            ]);

            // Proses impor data
            Excel::import(new RegionImport(), $request->file('import_file'));

            // Jika sukses
            return redirect()->back()->with('success', 'Data imported successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Jika validasi gagal
            return redirect()->back()->with('fail', 'Failed to import data: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Jika ada kesalahan lain
            return redirect()->back()->with('fail', 'Failed to import data: ' . $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        $userId = Auth::guard('administrators')->user()->id;
        $regions = Region::where('administrator_id', $userId)->get();
        
        $query = $request->input('query');
        $regions = Region::where('id', 'like', "%$query%")
                            ->orWhere('kecamatan', 'like', "%$query%")
                            ->orWhere('kelurahan_desa', 'like', "%$query%")
                            ->orWhere('kode_pos', 'like', "%$query%")
                            ->get();
                             
        // Mengumpulkan data untuk grafik
        $kecamatanCounts = Region::where('administrator_id', $userId)
        ->select('kecamatan', 'kelurahan_desa')
        ->get()
        ->groupBy('kecamatan')
        ->map(function ($group) {
            return $group->count();
        });

        // Data untuk grafik
        $graphtypes = [];
        foreach ($kecamatanCounts as $kecamatan => $count) {
            $graphtypes[] = [
                'name' => $kecamatan,
                'count' => $count
            ];
        }

        // Hitung jumlah wilayah yang ada
        $graphtype1 = 1;
        $graphtype2 = 1;
    
        session(['filtered_admin' => $regions]);
      
        return view('Region.index', compact('regions', 'graphtype1', 'graphtype2', 'graphtypes'));
    }

    public function getRegions()
    {
        $regions = Region::all(['id', 'kelurahan_desa', 'image']);
        return response()->json($regions);
    }


    public function getImageUrl($imageName)
    {
        $imagePath = 'images/' . $imageName;
        
        // Periksa apakah file gambar ada di storage/images
        if (Storage::disk('public')->exists($imagePath)) {
            $imageUrl = asset('storage/' . $imagePath);
            return response()->json(['imageUrl' => $imageUrl]);
        } else {
            return response()->json(['error' => 'Image not found.'], 404);
        }
    }
    public function searchKelurahanDesa(Request $request)
    {
        $query = $request->input('query');

        $regions = Region::where('kelurahan_desa', 'like', "%$query%")->get();

        return view('search_results', compact('regions'));
    }

    public function coordinates($id)
    {
        $coordinates = Coordinate::where('region_id', $id)->first();

        if (!$coordinates) {
            return response()->json(['error' => 'Coordinates not found'], 404);
        }

        return response()->json($coordinates);
    }

}
