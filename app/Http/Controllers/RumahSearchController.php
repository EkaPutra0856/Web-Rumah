<?php

namespace App\Http\Controllers;

use App\Models\RegionalAdmin;
use App\Models\Rumah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RumahSearchController extends Controller
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

            // Mengambil semua rumah yang terkait dengan region_id dari regadmin yang sedang login dan menerapkan filter pencarian
            $rumah = Rumah::whereHas('region', function ($subQuery) use ($regionId) {
                $subQuery->where('id', $regionId);
            })
            ->where(function ($subQuery) use ($query) {
                $subQuery->where('id', 'like', "%$query%")
                        ->orWhere('norumah', 'like', "%$query%")
                        ->orWhere('alamat', 'like', "%$query%")
                        ->orWhere('luas', 'like', "%$query%")
                        ->orWhere('status', 'like', "%$query%")
                        ->orWhere('tahun', 'like', "%$query%")
                        ->orWhere('renov', 'like', "%$query%");
            })
            ->get();

            // Menghitung jumlah rumah berdasarkan status
            $graphtype1 = $rumah->where('status', 'Sehat')->count();
            $graphtype2 = $rumah->where('status', 'Tidak Layak')->count(); 

            session(['filtered_admin' => $rumah]);
            return view('Rumah.index', compact('rumah', 'graphtype1', 'graphtype2'));
        } else {
            return redirect("/")->withErrors('You are not allowed to access');
        }
    }
   
}
