<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class monitoring extends Model
{
    use HasFactory;
    use Notifiable;

    protected $table = 'monitorings';

    protected $fillable = [
        'temperature',
        'ph',
        'tds',
        'tinggi_air',
        'status_pompa',
        'status_pembuangan',
        'sisa_pakan'
    ];
}
