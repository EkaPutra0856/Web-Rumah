<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class KK extends Authenticatable
{
    use HasApiTokens, Notifiable;
protected $table='kks';



protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'regional_admins_id',
        'rumah_id',
        'nokk',
        'namakk',
        'anggota',
        'filekk'
    ];

    

    public function regionalAdmin()
    {
        return $this->belongsTo(RegionalAdmin::class);
    }
    public function rumah()
    {
        return $this->belongsTo(Rumah::class);
    }

  
}