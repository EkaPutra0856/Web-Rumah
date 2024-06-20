<?php

// File: app/Http/Controllers/ImportExportController.php

namespace App\Http\Controllers;

use App\Exports\KKExport;
use App\Imports\KKImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportKKController extends Controller
{
    public function exportKK()
    {
        return Excel::download(new KKExport(), 'kk.xlsx');
    }

    public function importKK(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:xls,xlsx',
        ]);

        try {
            Excel::import(new KKImport(), $request->file('import_file'));

            return redirect()->back()->with('success', 'Data imported successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to import data: ' . $e->getMessage());
        }
    }
}
