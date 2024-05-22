<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function profileView()
    {
        return view('page.profile.profile');
    }
}
