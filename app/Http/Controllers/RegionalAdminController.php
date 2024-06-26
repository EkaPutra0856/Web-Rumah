<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\Region;
use App\Models\RegionalAdmin;
use Illuminate\Http\Request;
use App\Exports\RegionalAdminExport;
use App\Imports\RegionalAdminImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class RegionalAdminController extends Controller
{
    public function index(){
        if (Auth::guard('administrators')->check()) {
            $userId = Auth::guard('administrators')->user()->id;
            $regions = Region::where('administrator_id', $userId)->get();
            $regionAdmin = RegionalAdmin::where('administrator_id', $userId)->with('region')->get();



            $graphtype1 = 1;
            $graphtype2 =1;
            return view('AdminWilayah.index', compact('regionAdmin', 'regions', 'graphtype1', 'graphtype2'));


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
    public function export()
    {
        return Excel::download(new RegionalAdminExport, 'adminwilayah.xlsx');
    }
    public function import(Request $request)
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
        // Excel::import(new RegionImport, $request->file('import_file'));
        // return redirect('/wilayah');
    }

}