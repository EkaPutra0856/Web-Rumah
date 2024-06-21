<?php

namespace App\Exports;

use App\Models\Region;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class RegionExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Region::all(['id', 'kecamatan', 'kelurahan_desa', 'kode_pos']); //mendapatkan data dari kolom yg dipilih

    }

    public function headings(): array
    {
        return [
            'ID',
            'Kecamatan',
            'Kelurahan/Desa',
            'Kode Pos'
        ];
    }
}
