<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function deviceView()
    {
        return view('page.menu.device');
    }
}
