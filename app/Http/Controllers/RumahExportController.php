<?php

// File: app/Http/Controllers/ImportExportController.php

namespace App\Http\Controllers;

use App\Exports\RumahExport;
use App\Imports\RumahImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RumahExportController extends Controller
{
    public function exportRumah()
    {
        return Excel::download(new RumahExport(), 'rumah.xlsx');
    }



    public function importRumah(Request $request)
    {
        try {
            // Validasi jenis file
            $request->validate([
                'import_file' => 'required|file|mimes:xls,xlsx',
            ]);
    
            // Proses impor data
            Excel::import(new RumahImport(), $request->file('import_file'));
    
            // Jika sukses
            return redirect()->back()->with('success', 'Data imported successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Jika validasi gagal
            return redirect()->back()->with('fail', 'Failed to import data: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Jika ada kesalahan lain
            return redirect()->back()->with('fail', 'Failed to import data: ' . $e->getMessage());
        }
    }
}
