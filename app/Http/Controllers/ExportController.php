<?php

namespace App\Http\Controllers;

use App\Exports\AdministratorsExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportAdministrators()
    {
        return Excel::download(new AdministratorsExport(), 'administrators.xlsx');
    }
}
