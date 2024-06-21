<?php

namespace App\Imports;

use App\Models\Region;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RegionImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        //mendapatkan ID administrator yang sedang masuk
        $userId = auth()->guard('administrators')->user()->id;

        return new Region([
            'administrator_id' => $userId,
            'kecamatan' => $row['kecamatan'],
            'kelurahan_desa' => $row['kelurahan_desa'],
            'kode_pos' => $row['kode_pos']
        ]);
    }
}
