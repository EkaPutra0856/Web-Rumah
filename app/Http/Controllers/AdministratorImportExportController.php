<?php

namespace App\Http\Controllers;

use App\Exports\AdministratorsExport;
use App\Imports\AdministratorsImport;
use App\Models\Administrator;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class AdministratorImportExportController extends Controller
{
    public function exportAdministrators()
    {
        $admin = session('filtered_admin', Administrator::all());
        return Excel::download(new AdministratorsExport($admin), 'administrators.xlsx');
    }

    public function exportPDF()
    {
        $admin = session('filtered_admin', Administrator::all());
        $pdf = FacadePdf::loadView('Administrator.pdf', ['admin' => $admin]);
        return $pdf->download('administrators.pdf');
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
}
