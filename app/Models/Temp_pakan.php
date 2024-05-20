<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temp_Pakan extends Model
{
    use HasFactory;

    protected $fillable = [
        'jam_pertama',
        'jam_kedua',
        'jam_ketiga',
        'nilai'
    ];
}
