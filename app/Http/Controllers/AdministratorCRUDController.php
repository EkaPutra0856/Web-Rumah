<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministratorCRUDController extends Controller
{


    public function index()
    {
        if (Auth::guard('administrators')->check()) {

            $userId = Auth::guard('administrators')->user()->id;
            $admin = Administrator::where('id', $userId)->get();
            $admin = Administrator::all();
            return view('Administrator.index', compact('admin'));
        } else {
            return redirect("/")->withErrors('You are not allowed to access');
        }
    }
    public function insert(Request $request)
    {

        $userId = Auth::guard('administrators')->user()->id;

        $admin = new Administrator();

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->gender = $request->gender;
        $admin->password = bcrypt($request->password);
        $admin->notelp = $request->notelp;


        $admin->save();
        session()->flash('success', 'Save Data Successfully!');
        return Redirect('/admintable');
    }

    public function update(Request $request, $id)
    {
        $admin = Administrator::where('id', $id)->first();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->gender = $request->gender;
        $admin->password = bcrypt($request->password);
        $admin->notelp = $request->notelp;
        $admin->save();
        session()->flash('success', 'Edit Data Successfully!');
        return Redirect('/admintable');
    }

    public function delete(Request $request, $id)
    {
        // Temukan administrator yang dipilih untuk dihapus
        $admin = Administrator::find($id);

        // Pastikan administrator ditemukan
        if (!$admin) {
            return redirect('/admintable')->withErrors('Administrator not found!');
        }

        // Periksa apakah administrator yang dipilih adalah administrator yang saat ini masuk
        if ($admin->id == Auth::guard('administrators')->user()->id) {
            // Lakukan logout otomatis
            Auth::guard('administrators')->logout();

            // Redirect ke halaman login
            return redirect('/login')->with('success', 'Your account has been deleted. Please login again.');
        }

        // Hapus administrator jika tidak ada masalah
        $admin->delete();

        // Redirect kembali ke halaman indeks dengan pesan sukses
        return redirect('/admintable')->with('success', 'Administrator deleted successfully!');
    }




    // public function delete(Request $request, $id)
    // {
    //     // Temukan administrator yang dipilih untuk dihapus
    //     $admin = Administrator::find($id);

    //     // Pastikan administrator ditemukan
    //     if (!$admin) {
    //         return redirect('/admintable')->withErrors('Administrator not found!');
    //     }

    //     // Periksa apakah administrator yang dipilih adalah administrator yang saat ini masuk
    //     if ($admin->id == Auth::guard('administrators')->user()->id) {
    //         // Lakukan logout otomatis
    //         Auth::guard('administrators')->logout();

    //         // Redirect ke halaman login
    //         return redirect('/login')->with('success', 'Your account has been deleted. Please login again.');
    //     }

    //     // Hapus administrator jika tidak ada masalah
    //     $admin->delete();

    //     // Redirect kembali ke halaman indeks dengan pesan sukses
    //     return redirect('/admintable')->with('success', 'Administrator deleted successfully!');
    // }




}
