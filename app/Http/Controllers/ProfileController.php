<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('page.profile.profile');
    }

    public function changePassword()
    {
        return view('page.profile.change_password');
    }
}
