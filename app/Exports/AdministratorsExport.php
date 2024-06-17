<?php

namespace App\Exports;

use App\Models\Administrator;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdministratorsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Administrator::all(['id','name', 'email', 'notelp', 'gender']); // Sesuaikan dengan nama kolom yang ingin diekspor
    }

    public function headings(): array
    {
        return [
            'id',
            'Name',
            'Email',
            'No Telp',
            'Gender'
        ];
    }
}
