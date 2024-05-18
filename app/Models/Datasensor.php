<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datasensor extends Model
{
    use HasFactory;

    protected $fillable = ['tdsValue', 'suhu', 'jarakAir', 'phAir', 'jarakPakan'];
}
