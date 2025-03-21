<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavbarController extends Controller
{
    public function pimpinan()
    {
        return view('pimpinan');
    }

    public function pesantren()
    {
        return view('pesantren');
    }
}
