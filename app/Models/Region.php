<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table = "wilayahs";

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'administrator_id',
        // 'name',
        'provinsi',
        'kabupaten_kota',
        'kecamatan',
        'kelurahan_desa',
        'kode_pos'
    ];

    public function administrator()
    {
        return $this->belongsTo(Administrator::class);
    }

    public function rumah()
    {
        return $this->hasMany(Rumah::class);
    }
}

