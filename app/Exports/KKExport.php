<?php

namespace App\Exports;

use App\Models\KK;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class KKExport implements FromCollection, WithHeadings
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
        return KK::all(); // Sesuaikan dengan nama kolom yang ingin diekspor
    }

    public function headings(): array
    {
        return [
            'ID Rumah',
            'Nomor KK',
            'Kepala Keluarga',
            'Anggota Keluarga'
        ];
    }
}
