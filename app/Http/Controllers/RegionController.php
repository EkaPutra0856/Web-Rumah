<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Coordinate;
use Illuminate\Http\Request;
use App\Exports\RegionExport;
use App\Imports\RegionImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class RegionController extends Controller
{
    public function index()
    {
        if (Auth::guard('administrators')->check()) {
            $userId = Auth::guard('administrators')->user()->id;
            $regions = Region::where('administrator_id', $userId)->get();
            // Hitung jumlah pria dan wanita
            $graphtype1 = 1;
            $graphtype2 = 1;
            return view('Region.index', compact('regions', 'graphtype1', 'graphtype2'));
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

    public function export()
    {
        return Excel::download(new RegionExport, 'region.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:xls,xlsx',
        ]);

        try {
            Excel::import(new RegionImport(), $request->file('import_file'));

            return redirect()->back()->with('success', 'Data imported successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to import data: ' . $e->getMessage());
        }
        // Excel::import(new RegionImport, $request->file('import_file'));
        // return redirect('/wilayah');
    }
}
