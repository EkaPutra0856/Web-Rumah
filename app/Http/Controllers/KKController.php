<?php

namespace App\Http\Controllers;

use App\Models\KK;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KKController extends Controller
{
    public function index(){
        if (Auth::guard('regadmin')->check()) {
            $regadmin = Auth::guard('regadmin')->user()->id;
            $kk = KK::all();
            return view('KK.index', compact('kk'));
        } else {
            return redirect("/")->withErrors('You are not allowed to access');
        }
    }
    public function insert(Request $request){

        $regadmin = Auth::guard('regadmin')->user()->id;

        $kk = new KK();
            $kk->nokk = $request->nokk;
            $kk->admin_wilayahs_id = $regadmin;
        $kk -> save();
        
        session()->flash('success', 'Save Data Successfully!');
        return Redirect('/kk');
    }

    public function update(KK $request, $id)
    {
        $kk = KK::where('id', $id)->first();
        $kk->nokk = $request->nokk;
        $kk->admin_wilayahs_id =  $request->admin_wilayahs_id;
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
