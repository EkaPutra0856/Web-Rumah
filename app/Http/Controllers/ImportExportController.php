<?php

// File: app/Http/Controllers/ImportExportController.php

namespace App\Http\Controllers;

use App\Exports\AdministratorsExport;
use App\Imports\AdministratorsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{
    public function exportAdministrators()
    {
        return Excel::download(new AdministratorsExport(), 'administrators.xlsx');
    }



    public function importAdministrators(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:xls,xlsx',
        ]);

        try {
            Excel::import(new AdministratorsImport(), $request->file('import_file'));

            return redirect()->back()->with('success', 'Data imported successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', 'Failed to import data: ' . $e->getMessage());
        }
    }
}
