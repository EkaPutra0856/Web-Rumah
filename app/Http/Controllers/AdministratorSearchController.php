<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use Illuminate\Http\Request;

class AdministratorSearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $admin = Administrator::where('name', 'like', "%$query%")
                              ->orWhere('email', 'like', "%$query%")
                              ->orWhere('gender', 'like', "%$query%")
                              ->orWhere('notelp', 'like', "%$query%")
                              ->get();
                              
        $graphtype1 = $admin->where('gender', 'Pria')->count();
        $graphtype2 = $admin->where('gender', 'Wanita')->count();
    
        session(['filtered_admin' => $admin]);
    
        return view('administrator.index', compact('admin', 'graphtype1', 'graphtype2'));
    }
    
}
