<?php

namespace App\Exports;

use App\Models\Region;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class RegionExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return Region::all();
    // }
    public function collection()
    {
        return Region::all(['id', 'kecamatan', 'kelurahan_desa', 'kode_pos']); // Sesuaikan dengan nama kolom yang ingin diekspor
    }

    public function headings(): array
    {
        return [
            'id',
            'Kecamatan',
            'Kelurahan/Desa',
            'Kode Pos'
        ];
    }
}
