<?php

// File: app/Http/Controllers/ImportExportController.php

namespace App\Http\Controllers;

use App\Exports\AdministratorsExport;
use App\Imports\AdministratorsImport;
use App\Models\Administrator;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class ImportExportController extends Controller
{
    public function exportAdministrators()
    {
        return Excel::download(new AdministratorsExport(), 'administrators.xlsx');
    }

    public function importAdministrators(Request $request)
    {
        try {
            // Validasi jenis file
            $request->validate([
                'import_file' => 'required|file|mimes:xls,xlsx',
            ]);
    
            // Proses impor data
            Excel::import(new AdministratorsImport(), $request->file('import_file'));
    
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

        // Method untuk mengekspor ke PDF
        public function exportPDF()
        {
            $admin = Administrator::all(); // Ambil semua data administrator
            $pdf = FacadePdf::loadView('Administrator.pdf', ['admin' => $admin]);
            return $pdf->download('administrators.pdf');
        }
}
