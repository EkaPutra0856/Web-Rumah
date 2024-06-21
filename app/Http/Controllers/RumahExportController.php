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
    $request->validate([
        'import_file' => 'required|file|mimes:xls,xlsx',
    ]);

    try {
        // Impor data dari file Excel yang diunggah
        Excel::import(new RumahImport(), $request->file('import_file'));

        // Beri feedback sukses dan arahkan kembali ke halaman sebelumnya
        return redirect()->back()->with('success', 'Data imported successfully.');
    } catch (\Exception $e) {
        // Tangkap dan beri feedback jika terjadi kesalahan
        return redirect()->back()->with('fail', 'Failed to import data: ' . $e->getMessage());
    }
}

}
