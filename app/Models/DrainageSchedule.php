<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrainageSchedule extends Model
{
    use HasFactory;
    protected $table = 'drainage_schedule';
    protected $fillable = [
        'every',
    ];
}
