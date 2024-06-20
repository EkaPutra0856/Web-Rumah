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
                'id',
                'regional_admins_id'=> $admin->region->kecamatan,
                'norumah',
                'alamat',
                'luas',
                'status',
                'tahun',
                'latitude', 
                'longitude',
                'renov',    
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
