<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalisisController extends Controller
{
    public function index()
    {
        return view('page.monitoring.analisis');
    }
}
