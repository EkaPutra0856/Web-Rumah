<?php

namespace App\Http\Controllers;

use App\Models\RegionalAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegAdminController extends Controller
{
    public function index(){
        if (Auth::guard('administrators')->check()) {
            $userId = Auth::guard('administrators')->user()->id;
            $regionAdmin = RegionalAdmin::where('administrator_id', $userId)->get();
            return view('AdminWilayah.index', compact('regionAdmin'));
        } else {
            return redirect("/")->withErrors('You are not allowed to access');
        }
    }
    public function insert(Request $request){

        $userId = Auth::guard('administrators')->user()->id;

        $data = new RegionalAdmin();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->wilayah_id = $request->wilayah_id;
            $data->password = $request->password;
            
            $data->administrator_id = $userId;

        $data -> save();
        session()->flash('success', 'Save Data Successfully!');
        return Redirect('/dashboard');
    }

    public function update(Request $request, $id)
    {
        $data = RegionalAdmin::where('id', $id)->first();
            $data->name = $request->name;
        $data -> save();
        session()->flash('success', 'Edit Data Successfully!');
        return Redirect('/dashboard');
    }

    public function delete(Request $request, $id)
    {
        $penduduk = RegionalAdmin::where('id', $id);
        $penduduk->delete();
        session()->flash('success', 'Delete Data Successfully!');
        return redirect('/dashboard');
    }
}
