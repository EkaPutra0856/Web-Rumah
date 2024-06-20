<?php

namespace App\Exports;

use App\Models\RegionalAdmin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RegionalAdminExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return RegionalAdmin::with('region')->get()->map(function($admin) {
            return [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
                'notelp' => $admin->notelp,
                'region_id' => $admin->region_id,
                'kecamatan' => $admin->region->kecamatan, // Pastikan 'kecamatan' adalah kolom di tabel Region
            ];
        });
    }

    public function headings(): array
    {
        return [
            'id',
            'Nama',
            'Email',
            'No Telp',
            'ID Wilayah',
            'Kecamatan'
        ];
    }
}