<?php

namespace App\Exports;

use App\Models\RegionalAdmin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RegionalAdminExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return RegionalAdmin::all(['id','name', 'email', 'notelp', 'region_id']); // Sesuaikan dengan nama kolom yang ingin diekspor
    }

    public function headings(): array
    {
        return [
            'id',
            'Nama',
            'Email',
            'No Telp',
            'ID Wilayah'
        ];
    }
}