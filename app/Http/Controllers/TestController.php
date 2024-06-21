<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rumah;
use App\Models\RegionalAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    public function insert()
    {
        try {
            // Mengambil id dari regadmin yang sedang login
            $regadminId = Auth::guard('regadmin')->user()->id;

            // Menggunakan relasi untuk mengambil region yang terkait dengan regadmin
            $regadmin = RegionalAdmin::with('region')->findOrFail($regadminId);

            // Mendapatkan region_id dari regadmin
            $regionId = $regadmin->region->id;

            // Data Rumah
            $data = [
                'norumah' => 123,
                'alamat' => 'Test Alamat',
                'luas' => 100,
                'status' => 'Layak',
                'tahun' => 2023,
                'latitude' => -7.628424,
                'longitude' => 110.0571134,
                'renov' => 2024,
                'region_id' => $regionId, // Menggunakan region_id yang didapatkan dari regadmin
            ];

            // Logging data yang akan disimpan
            Log::info('Creating Rumah with data: ' . json_encode($data));

            // Membuat model Rumah
            $rumah = new Rumah();
            $rumah->fill($data); // Mengisi atribut rumah dari array data

            // Logging sebelum simpan
            Log::info('Saving Rumah: ' . json_encode($rumah));

            // Menyimpan model Rumah ke database
            $rumah->save();

            // Logging setelah simpan
            Log::info('Rumah saved successfully: ' . json_encode($rumah));

            return 'Rumah saved successfully!';
        } catch (\Exception $e) {
            Log::error('Error saving Rumah: ' . $e->getMessage());
            return 'Error: ' . $e->getMessage();
        }
    }
}
