<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Rumah extends Authenticatable
{
    use HasApiTokens, Notifiable;
protected $table='rumahs';
protected $primaryKey='id';
    protected $fillable = [
        'id',
        'regional_admins_id',
        'region_id',
        'norumah',
        'alamat',
        'luas',
        'status',
        'tahun',
        'latitude', 
        'longitude',
        'renov',
        'image'
    ];

    

    public function kk()
    {
        return $this->hasMany(KK::class);
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function regionalAdmin()
    {
        return $this->belongsTo(RegionalAdmin::class);
    }

}