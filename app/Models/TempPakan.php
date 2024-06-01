<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempPakan extends Model
{
    use HasFactory;

    protected $table = 'temp_pakans';

    protected $fillable = [
        'jam_pertama',
        'jam_kedua',
        'jam_ketiga',
        'nilai'
    ];
}
