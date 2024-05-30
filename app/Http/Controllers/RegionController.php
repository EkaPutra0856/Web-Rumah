<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegionController extends Controller
{
    public function index(){
        if (Auth::guard('administrators')->check()) {
            $userId = Auth::guard('administrators')->user()->id;
            $region = Region::where('administrator_id', $userId)->get();
            return view('Region.index', compact('region'));
        } else {
            return redirect("/")->withErrors('You are not allowed to access');
        }
    }
    public function insert(Request $request){

        $userId = Auth::guard('administrators')->user()->id;

        $data = new Region();
            $data->name = $request->name;
            $data->administrator_id = $userId;
            $data->id = $request->id;

        $data -> save();
        session()->flash('success', 'Save Data Successfully!');
        return Redirect('/wilayah');
    }

    public function update(Request $request, $id)
    {
        $data = Region::where('id', $id)->first();
            $data->name = $request->name;
            $data->id = $request->id;
        $data -> save();
        session()->flash('success', 'Edit Data Successfully!');
        return Redirect('/wilayah');
    }

    public function delete(Request $request, $id)
    {
        $penduduk = Region::where('id', $id);
        $penduduk->delete();
        session()->flash('success', 'Delete Data Successfully!');
        return redirect('/wilayah');
    }


}
