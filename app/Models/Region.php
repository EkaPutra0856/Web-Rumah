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
        'name',
    ];

    public function administrator()
    {
        return $this->belongsTo(Administrator::class);
    }
}

