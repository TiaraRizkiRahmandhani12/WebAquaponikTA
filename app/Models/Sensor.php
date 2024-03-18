<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    protected $fillable = [
        'suhu',
        'ph',
        'tds',
        'ketinggian_air',
        'ketinggian_pakan'
    ];
}
