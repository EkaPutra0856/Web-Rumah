<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdministratorCRUDController extends Controller
{


    public function index()
{
    if (Auth::guard('administrators')->check()) {
        $userId = Auth::guard('administrators')->user()->id;
        $admin = Administrator::all();
        
        // Hitung jumlah pria dan wanita
        $graphtype1 = $admin->where('gender', 'Pria')->count();
        $graphtype2 = $admin->where('gender', 'Wanita')->count();
        
        return view('Administrator.index', compact('admin', 'graphtype1', 'graphtype2'));
    } else {
        return redirect("/")->withErrors('You are not allowed to access');
    }
}

public function insert(Request $request)
{
    $userId = Auth::guard('administrators')->user()->id;

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'gender' => 'required|string',
        'password' => 'required|string|min:6',
        'notelp' => 'required|string|max:15',
    ]);

    $admin = new Administrator();

    $admin->name = $request->name;
    $admin->email = $request->email;
    $admin->gender = $request->gender;
    $admin->password = bcrypt($request->password);
    $admin->notelp = $request->notelp;

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('images', 'public');
        $admin->image = $path;
    }

    $admin->save();

    session()->flash('success', 'Save Data Successfully!');
    return redirect('/admintable');
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'gender' => 'required|string',
        'password' => 'nullable|string|min:6',
        'notelp' => 'required|string|max:15',
    ]);

    $admin = Administrator::where('id', $id)->first();
    $admin->name = $request->name;
    $admin->email = $request->email;
    $admin->gender = $request->gender;

    if ($request->password) {
        $admin->password = bcrypt($request->password);
    }

    $admin->notelp = $request->notelp;

    if ($request->hasFile('image')) {
        if ($admin->image) {
            Storage::disk('public')->delete($admin->image);
        }
        $path = $request->file('image')->store('images', 'public');
        $admin->image = $path;
    }

    $admin->save();

    // dd($admin->image); // Untuk melihat path atau nama file gambar yang tersimpan

    session()->flash('success', 'Edit Data Successfully!');
    return redirect('/admintable');
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
