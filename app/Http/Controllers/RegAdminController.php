<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
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
            $data->wilayah_id = $request->wilayah_id;
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
        $data->wilayah_id = $request->wilayah_id;
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
}
