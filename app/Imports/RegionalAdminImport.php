<?php

namespace App\Imports;

use App\Models\RegionalAdmin;
use App\Models\Region; // Pastikan Anda mengimpor model Region jika digunakan
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash; // Import Hash untuk hashing password
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RegionalAdminImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Mendapatkan ID administrator yang sedang masuk
        $userId = auth()->guard('administrators')->user()->id;

        // Mendapatkan region yang terkait dengan administrator
        $regions = Region::where('administrator_id', $userId)->pluck('id'); // Misalnya Anda mengambil ID region yang terkait

        // Validasi apakah region_id dari data impor terkait dengan administrator
        if (!$regions->contains($row['region_id'])) {
            Log::error("Unauthorized access: Administrator with ID {$userId} is not authorized to import RegionalAdmin for region {$row['region_id']}.");
            throw new \Exception('Unauthorized access.');
        }

        // Logging data yang akan disimpan
        Log::info('Importing RegionalAdmin: ' . json_encode($row));

        return new RegionalAdmin([
          
            'administrator_id' => $userId, // Gunakan ID administrator yang sedang masuk
            'region_id' => $row['region_id'], // Pastikan ini sesuai dengan region yang terkait dengan administrator
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => Hash::make($row['password']), // Gunakan hashing password untuk keamanan
            'notelp' => $row['notelp']
        ]);
    }
}
