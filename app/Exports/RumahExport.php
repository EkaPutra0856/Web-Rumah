<?php

namespace App\Exports;

use App\Models\Rumah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RumahExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Rumah::with('regionalAdmin')->get()->map(function($admin) {
            return [
                'id' => $admin->id,
                'regional_admins_id' => $admin->region->kecamatan,
                'norumah' => $admin->norumah,
                'alamat' => $admin->alamat,
                'luas' => $admin->luas,
                'status' => $admin->status,
                'tahun' => $admin->tahun,
                'latitude' => $admin->latitude, 
                'longitude' => $admin->longitude,
                'renov' => $admin->renov,    
            ];
        });
        // return Rumah::all(); 
    }

    public function headings(): array
    {
        return [
            'ID',
            'Admin Wilayah',
            'Nomor Rumah',
            'Alamat',
            'Luas',
            'Status',
            'Tahun',
            'Latitude',
            'Longitude',
            'Renovasi'
        ];
    }
}
