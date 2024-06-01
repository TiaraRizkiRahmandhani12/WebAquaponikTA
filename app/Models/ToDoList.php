<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    use HasFactory;

    protected $table = 'to_do_lists';
    protected $primaryKey = 'item';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['item', 'status', 'action', 'created_at', 'upadate_at'];
    protected $attributes = [
        'action' => 'Assign', // Nilai default untuk kolom 'action'
    ];
}
