<?php

// File: app/Http/Controllers/ImportExportKKController.php

namespace App\Http\Controllers;

use App\Exports\KKExport;
use App\Imports\KKImport;
use App\Models\KK;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class KKImportExportController extends Controller
{
    public function exportKK()
    {
        $kk = session('filtered_admin', KK::all());
        return Excel::download(new KKExport($kk), 'kk.xlsx');
    }

    public function exportPDF()
    {
        $kk = session('filtered_admin', KK::all());
        $pdf = FacadePdf::loadView('KK.pdf', ['kk' => $kk]);
        return $pdf->download('kk.pdf');
    }

    public function importKK(Request $request)
    {
        try {
            // Validasi jenis file
            $request->validate([
                'import_file' => 'required|file|mimes:xls,xlsx',
            ]);
    
            // Proses impor data
            Excel::import(new KKImport(), $request->file('import_file'));
    
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
