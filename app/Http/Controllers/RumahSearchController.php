<?php

namespace App\Http\Controllers;

use App\Models\Rumah;
use Illuminate\Http\Request;

class RumahSearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $rumah = Rumah::where('id', 'like', "%$query%")
                              ->orWhere('norumah', 'like', "%$query%")
                              ->orWhere('alamat', 'like', "%$query%")
                              ->orWhere('luas', 'like', "%$query%")
                              ->orWhere('status', 'like', "%$query%")
                              ->orWhere('tahun', 'like', "%$query%")
                              ->orWhere('renov', 'like', "%$query%")
                              ->get();
                              
        $graphtype1 = $rumah->where('gender', 'Pria')->count();
        $graphtype2 = $rumah->where('gender', 'Wanita')->count();
    
        session(['filtered_admin' => $rumah]);
    
        return view('Rumah.index', compact('rumah', 'graphtype1', 'graphtype2'));
    }
    
}
