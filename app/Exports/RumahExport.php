<?php

namespace App\Exports;

use App\Models\Rumah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RumahExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Rumah::all(); // Sesuaikan dengan nama kolom yang ingin diekspor
    }

    public function headings(): array
    {
        return [
            'ID',
            'ID Admin Wilayah',
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
