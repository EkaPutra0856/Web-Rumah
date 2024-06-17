<?php

// File: app/Imports/AdministratorsImport.php

namespace App\Imports;

use App\Models\Administrator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class AdministratorsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        Log::info('Importing administrator: ' . json_encode($row));

        return new Administrator([
            'name' => $row['name'],
            'email' => $row['email'],
            'gender' => $row['gender'],
            'password' => bcrypt($row['password']),
            'notelp' => $row['notelp'],
        ]);
    }
}
