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
        $userId = Auth::guard('regadmin')->user()->id;
        $rumah = Rumah::where('region_id', $userId)->get();
        $kk = KK::where('rumah_id', $userId)->with('rumah')->get();

        $query = $request->input('query');
        $kk = KK::where('rumah_id', 'like', "%$query%")
                    ->orWhere('nokk', 'like', "%$query%")
                    ->orWhere('namakk', 'like', "%$query%")
                    ->orWhere('anggota', 'like', "%$query%")
                    ->get();
                              
        $graphtype1 = $kk->where('anggota', '>', 10)->count();
        $graphtype2 = $kk->where('anggota', '<=', 10)->count();
    
        session(['filtered_admin' => $kk]);
        return view('KK.index', compact('kk', 'rumah', 'graphtype1', 'graphtype2'));
    }
    
}
