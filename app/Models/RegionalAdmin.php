<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class RegionalAdmin extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = "admin_wilayahs";

    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'administrator_id',
        'wilayah_id',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function administrator()
    {
        return $this->belongsTo(Administrator::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}

