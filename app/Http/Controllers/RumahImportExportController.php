<?php

// File: app/Http/Controllers/ImportExportController.php

namespace App\Http\Controllers;

use App\Exports\RumahExport;
use App\Imports\RumahImport;
use App\Models\Rumah;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class RumahImportExportController extends Controller
{
    public function exportRumah()
    {
        $rumah = session('filtered_admin', Rumah::all());
        return Excel::download(new RumahExport($rumah), 'rumah.xlsx');
    }

    public function exportPDF()
    {
        $rumah = session('filtered_admin', Rumah::all());
        $pdf = FacadePdf::loadView('Rumah.pdf', ['rumah' => $rumah]);
        return $pdf->download('rumah.pdf');
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
