<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\Region;
use App\Models\RegionalAdmin;
use Illuminate\Http\Request;
use App\Exports\RegionalAdminExport;
use App\Imports\RegionalAdminImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class RegionalAdminController extends Controller
{
    public function index(){
        if (Auth::guard('administrators')->check()) {
            $userId = Auth::guard('administrators')->user()->id;
            $regions = Region::where('administrator_id', $userId)->get();
            $regionAdmin = RegionalAdmin::where('administrator_id', $userId)->with('region')->get();

            // Mengumpulkan data untuk grafik
            $regionCounts = RegionalAdmin::selectRaw('region_id, COUNT(*) as count')
                ->where('administrator_id', $userId)
                ->groupBy('region_id')
                ->pluck('count', 'region_id');

            $regionNames = Region::whereIn('id', $regionCounts->keys())->pluck('kecamatan', 'id');

            // Data untuk grafik
            $graphtypes = [];
            foreach ($regionNames as $id => $name) {
                $graphtypes[] = [
                    'name' => $name,
                    'count' => $regionCounts[$id] ?? 0
                ];
            }
            // Hitung jumlah wilayah yang ada
            $graphtype1 = 1;
            $graphtype2 = 1;

            session(['filtered_admin' => $regionAdmin]);
            return view('AdminWilayah.index', compact('regionAdmin', 'regions', 'graphtypes', 'graphtype1', 'graphtype2'));

        } else {
            return redirect("/")->withErrors('You are not allowed to access');
        }
    }
    public function insert(Request $request){
        $existingEmail = Administrator::where('email', $request->email)->first();

        if ($existingEmail) {
            session()->flash('fail', 'Save Data Failed!');
            return redirect('/adminwilayah');
        }

        $userId = Auth::guard('administrators')->user()->id;

        $data = new RegionalAdmin();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->notelp = $request->notelp;
            $data->region_id = $request->region_id;
            $data->password = bcrypt($request->password);
            
            $data->administrator_id = $userId;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $data->image = $path;
        }

        $data -> save();
        session()->flash('success', 'Save Data Successfully!');
        return Redirect('/adminwilayah');
    }

    public function update(Request $request, $id)
    {
        $data = RegionalAdmin::where('id', $id)->first();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->notelp = $request->notelp;
        $data->region_id = $request->region_id;
        if ($request->hasFile('image')) {
            if ($data->image) {
                Storage::disk('public')->delete($data->image);
            }
            $path = $request->file('image')->store('images', 'public');
            $data->image = $path;
        }
    
        $data -> save();
        session()->flash('success', 'Edit Data Successfully!');
        return Redirect('/adminwilayah');
    }

    public function delete(Request $request, $id)
    {
        $penduduk = RegionalAdmin::where('id', $id);
        $penduduk->delete();
        session()->flash('success', 'Delete Data Successfully!');
        return redirect('/adminwilayah');
    }

    public function exportRegionalAdmin()
    {
        $regionAdmin = session('filtered_admin', RegionalAdmin::all());
        return Excel::download(new RegionalAdminExport($regionAdmin), 'adminwilayah.xlsx');
    }

    public function exportPDF()
    {
        $regionAdmin = session('filtered_admin', RegionalAdmin::all());
        $pdf = FacadePdf::loadView('AdminWilayah.pdf', ['regionAdmin' => $regionAdmin]);
        return $pdf->download('adminwilayah.pdf');
    }

    public function importRegionalAdmin(Request $request)
    {
        try {
            // Validasi jenis file
            $request->validate([
                'import_file' => 'required|file|mimes:xls,xlsx',
            ]);

            // Proses impor data
            Excel::import(new RegionalAdminImport(), $request->file('import_file'));

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
        $regionAdmin = RegionalAdmin::where('administrator_id', $userId)->with('region')->get();
        
        $query = $request->input('query');
        $regionAdmin = RegionalAdmin::where('administrator_id', $userId)
                                    ->with('region')
                                    ->whereHas('region', function ($q) use ($query) {
                                        $q->where('kelurahan_desa', 'like', "%$query%");
                                    })
                                    ->orWhere('name', 'like', "%$query%")
                                    ->orWhere('email', 'like', "%$query%")
                                    ->orWhere('notelp', 'like', "%$query%")
                                    ->orWhere('region_id', 'like', "%$query%")
                                    ->get();

                             
        // Mengumpulkan data untuk grafik
        $regionCounts = RegionalAdmin::selectRaw('region_id, COUNT(*) as count')
        ->where('administrator_id', $userId)
        ->groupBy('region_id')
        ->pluck('count', 'region_id');

        $regionNames = Region::whereIn('id', $regionCounts->keys())->pluck('kecamatan', 'id');

        // Data untuk grafik
        $graphtypes = [];
        foreach ($regionNames as $id => $name) {
            $graphtypes[] = [
                'name' => $name,
                'count' => $regionCounts[$id] ?? 0
            ];
        }
        // Hitung jumlah wilayah yang ada
        $graphtype1 = 1;
        $graphtype2 = 1;
    
        session(['filtered_admin' => $regionAdmin]);
      
        return view('AdminWilayah.index', compact('regionAdmin', 'regions', 'graphtype1', 'graphtype2', 'graphtypes'));
    }
}