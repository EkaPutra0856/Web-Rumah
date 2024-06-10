<?php

namespace App\Http\Controllers;

use App\Models\KK;
use App\Models\Region;
use App\Models\Rumah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KKController extends Controller
{
    public function index(){
        if (Auth::guard('regadmin')->check()) {
            $userId = Auth::guard('regadmin')->user()->id;
            $rumah = Rumah::all();
            $kk = KK::where('regional_admins_id', $userId)->with('rumah')->get();
         
            return view('KK.index', compact('kk', 'rumah'));
        } else {
            return redirect("/")->withErrors('You are not allowed to access');
        }
    }
    public function insert(Request $request){

        $regadmin = Auth::guard('regadmin')->user()->id;
    //         // Memeriksa apakah semua input terisi
    // if(!$request->filled(['nokk', 'namakk', 'anggota'])) {
    //     return redirect()->back()->withErrors('Input cannot be empty.');
    // }

        $kk = new KK();
            $kk->nokk = $request->nokk;
            $kk->rumah_id = $request->rumah_id;
            $kk->namakk = $request->namakk;
            $kk->anggota = $request->anggota;
            $kk->regional_admins_id = $regadmin;
        $kk -> save();
        
        session()->flash('success', 'Save Data Successfully!');
        return Redirect('/kk');
    }

    public function update(Request $request, $id)
    {
        $kk = KK::where('id', $id)->first();
       
        $kk->nokk = $request->nokk;
        $kk->rumah_id = $request->rumah_id;
        $kk->namakk = $request->namakk;
        $kk->anggota = $request->anggota;
        
        $kk -> save();
        session()->flash('success', 'Edit Data Successfully!');
        return Redirect('/kk');
    }

    public function delete(Request $request, $id)
    {
        $kk = KK::where('id', $id);
        $kk->delete();
        session()->flash('success', 'Delete Data Successfully!');
        return redirect('/kk');
    }


}
