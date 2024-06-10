<?php

namespace App\Http\Controllers;


use App\Models\Region;
use App\Models\Rumah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RumahController extends Controller
{
    public function index(){
        if (Auth::guard('regadmin')->check()) {
            $regadmin = Auth::guard('regadmin')->user()->id;
            $rumah= Rumah::all();
            return view('Rumah.index', compact('rumah'));
        } else {
            return redirect("/")->withErrors('You are not allowed to access');
        }
    }
    public function insert(Request $request){

        $regadmin = Auth::guard('regadmin')->user()->id;

        $rumah = new Rumah();
        $rumah->id = $request->id;
        $rumah->norumah = $request->norumah;
        $rumah->alamat = $request->alamat;
        $rumah->luas = $request->luas;
        $rumah->status = $request->status;
        $rumah->tahun = $request->tahun;
        $rumah->renov = $request->renov;
        $rumah->region_id =  $request->region_id;
        $rumah->latitude =  $request->latitude1;
        $rumah->longitude =  $request->longitude1;
        $rumah -> save();
        
        session()->flash('success', 'Save Data Successfully!');
        return Redirect('/rumah');
    }

    public function update(Request $request, $id)
    {
        $rumah = Rumah::where('id', $id)->first();
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
