<?php

namespace App\Imports;

use App\Models\Rumah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\RegionalAdmin;

class RumahImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Mengambil id regadmin yang sedang login
        $regadminId = Auth::guard('regadmin')->user()->id;

       // Mengambil data regadmin berdasarkan ID
       $regadmin = RegionalAdmin::findOrFail($regadminId);

       $regionId = $regadmin->region->id;


        // Logging data yang akan disimpan
        Log::info('Importing Rumah: ' . json_encode($row));

        // Mengembalikan model Rumah dengan data yang sesuai
        return new Rumah([
            'id' => $row['id'], // Sesuaikan dengan kolom Excel yang sesuai
            'norumah' => $row['norumah'],
            'alamat' => $row['alamat'],
            'luas' => $row['luas'],
            'status' => $row['status'],
            'tahun' => $row['tahun'],
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude'],
            'renov' => $row['renov'],
            'region_id' => $regionId, // Menggunakan region_id yang didapatkan dari regadmin
        ]);
    }
}
