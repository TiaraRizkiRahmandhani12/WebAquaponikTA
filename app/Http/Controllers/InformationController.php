<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function informationView()
    {
        return view('page.menu.information');
    }
}
