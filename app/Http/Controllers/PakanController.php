<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PakanController extends Controller
{
    public function index()
    {
        return view('layouts.pakan');
    }

    public function apakek()
    {
        return view('layouts.apakek');
    }

    public function apakek2()
    {
        return view('layouts.apakek2');
    }
}
