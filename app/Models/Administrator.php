<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Administrator extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $table = "administrators";

    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'gender',
        'notelp',
        'image'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function regions()
    {
        return $this->hasMany(Region::class);
    }

    public function regionalAdmins()
    {
        return $this->hasMany(RegionalAdmin::class);
    }
    // Mutator untuk mengenkripsi password menggunakan Bcrypt

}
