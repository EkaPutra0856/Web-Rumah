<?php

namespace App\Imports;

use App\Models\Region;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RegionImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Region([
            'id' => $row['id'],
            'administrator_id' => $row['administrator_id'],
            'kecamatan' => $row['kecamatan'],
            'kelurahan_desa' => $row['kelurahan_desa'],
            'kode_pos' => $row['kode_pos']
        ]);
    }
}
