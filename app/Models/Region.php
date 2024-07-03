<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table = "regions";

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'administrator_id',
        'kecamatan',
        'kelurahan_desa',
        'kode_pos',
        'image'        
    ];

    public function administrator()
    {
        return $this->belongsTo(Administrator::class);
    }

    public function rumah()
    {
        return $this->hasMany(Rumah::class);
    }

    public function regionalAdmin()
    {
        return $this->hasMany(RegionalAdmin::class);
    }
    public function coordinates()
    {
        return $this->hasMany(Coordinate::class);
    }
}
