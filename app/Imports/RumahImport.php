<?php

// File: app/Imports/AdministratorsImport.php

namespace App\Imports;

use App\Models\Rumah;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class RumahImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        Log::info('Importing Rumah: ' . json_encode($row));

        return new Rumah([
            'id' => $row['id'],
            'regional_admins_id' => $row['regadmin'],
            'norumah' => $row['norumah'],
            'alamat' => $row['alamat'],
            'luas' => $row['luas'],
            'status' => $row['status'],
            'tahun' => $row['tahun'],
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude'],
            'renov' => $row['renov']
        ]);
    }
}
