<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    public $timestamps = false;
    public $incrementing = false; // Jika tidak menggunakan auto-increment ID
    protected $primaryKey = 'email';
    protected $fillable = ['email', 'token', 'created_at'];
}
