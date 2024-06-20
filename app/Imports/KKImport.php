<?php

// File: app/Imports/AdministratorsImport.php

namespace App\Imports;

use App\Models\KK;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class KKImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        Log::info('Importing KK: ' . json_encode($row));

        return new KK([
            'rumah_id' => $row['rumah_id'],
            'nokk' => $row['nokk'],
            'namakk' => $row['namakk'],
            'anggota' => $row['anggota'],
            'regional_admins_id' => $row['regadmin']
        ]);
    }
}
