<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\KK;
use App\Models\RegionalAdmin;
use App\Models\Rumah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KKSearchController extends Controller
{
    public function search(Request $request)
{
    if (Auth::guard('regadmin')->check()) {
        // Mengambil id regadmin yang sedang login
        $regadminId = Auth::guard('regadmin')->user()->id;

        // Mengambil region_id dari regadmin yang sedang login
        $regadmin = RegionalAdmin::findOrFail($regadminId);
        $regionId = $regadmin->region_id;

        // Mengambil query dari request
        $query = $request->input('query');

        // Mengambil semua rumah yang terkait dengan region_id dari regadmin yang sedang login
        $rumah = Rumah::where('region_id', $regionId)->get();

        // Mengambil ID rumah yang terkait dengan region_id
        $rumahIds = $rumah->pluck('id')->toArray();

        // Mengambil semua KK yang terkait dengan rumah_id dari region_id yang sedang login dan menerapkan filter pencarian
        $kk = KK::whereIn('rumah_id', $rumahIds)
                ->where(function ($subQuery) use ($query) {
                    $subQuery->where('rumah_id', 'like', "%$query%")
                             ->orWhere('nokk', 'like', "%$query%")
                             ->orWhere('namakk', 'like', "%$query%")
                             ->orWhere('anggota', 'like', "%$query%");
                })
                ->with('rumah')
                ->get();

        // Menghitung jumlah KK berdasarkan jumlah anggota
        $graphtype1 = $kk->where('anggota', '>', 10)->count();
        $graphtype2 = $kk->where('anggota', '<=', 10)->count();

        session(['filtered_admin' => $kk]);
        return view('KK.index', compact('kk', 'rumah', 'graphtype1', 'graphtype2'));
    } else {
        return redirect("/")->withErrors('You are not allowed to access');
    }
}

    
}
