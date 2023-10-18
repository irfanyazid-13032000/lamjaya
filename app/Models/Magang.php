<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
     use HasFactory;

    // protected $table = 'magangs';

    protected $guarded = ['id'];

    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];
}
