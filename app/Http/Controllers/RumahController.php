<?php

namespace App\Http\Controllers;


use App\Models\Region;
use App\Models\Rumah;
use App\Models\RegionalAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RumahController extends Controller
{
    public function index(){
        if (Auth::guard('regadmin')->check()) {
            // Mengambil id regadmin yang sedang login
            $regadminId = Auth::guard('regadmin')->user()->id;
            
            // Mengambil region_id dari regadmin yang sedang login
            $regadmin = RegionalAdmin::findOrFail($regadminId);
            $regionId = $regadmin->region_id;
            
            // Mengambil semua rumah yang terkait dengan region_id dari regadmin yang sedang login
            $rumah = Rumah::whereHas('region', function ($query) use ($regionId) {
                $query->where('id', $regionId);
            })->get();
            $graphtype1 = 1;
            $graphtype2 =1; 
            return view('Rumah.index', compact('rumah', 'graphtype1', 'graphtype2'));
        } else {
            return redirect("/")->withErrors('You are not allowed to access');
        }
    }

    public function insert(Request $request)
    {
        // Mengambil id dari regadmin yang sedang login
        $regadminId = Auth::guard('regadmin')->user()->id;

        // Menggunakan relasi untuk mengambil region yang terkait dengan regadmin
        $regadmin = RegionalAdmin::with('region')->findOrFail($regadminId);

        // Mendapatkan region_id dari regadmin
        $regionId = $regadmin->region->id;

        // Membuat objek Rumah baru
        $rumah = new Rumah();
        $rumah->id = $request->id;
        $rumah->norumah = $request->norumah;
        $rumah->alamat = $request->alamat;
        $rumah->luas = $request->luas;
        $rumah->status = $request->status;
        $rumah->tahun = $request->tahun;
        $rumah->renov = $request->renov;
        $rumah->region_id = $regionId; // Menggunakan region_id yang didapatkan

        $rumah->latitude =  $request->latitude1;
        $rumah->longitude =  $request->longitude1;
        $rumah->save();
        
        session()->flash('success', 'Data berhasil disimpan!');
        return redirect('/rumah');
    }

    public function update(Request $request, $id)
    {
        $rumah = Rumah::where('id', $id)->first();
      

        // Mengambil id dari regadmin yang sedang login
    $regadminId = Auth::guard('regadmin')->user()->id;

    // Menggunakan relasi untuk mengambil region yang terkait dengan regadmin
    $regadmin = RegionalAdmin::with('region')->findOrFail($regadminId);

    // Mendapatkan region_id dari regadmin
    $regionId = $regadmin->region->id;

        $rumah->norumah = $request->norumah;
        $rumah->alamat = $request->alamat;
        $rumah->luas = $request->luas;
        $rumah->status = $request->status;
        $rumah->tahun = $request->tahun;
        $rumah->renov = $request->renov;
        $rumah->id = $request->id;
        $rumah->norumah = $request->norumah;
        
        $rumah -> save();
        session()->flash('success', 'Edit Data Successfully!');
        return Redirect('/rumah');
    }

    public function delete(Request $request, $id)
    {
        $rumah = Rumah::where('id', $id);
        $rumah->delete();
        session()->flash('success', 'Delete Data Successfully!');
        return redirect('/rumah');
    }


}