<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class halamanAdminController extends Controller
{
    public function admin()
    {
        return view('side_menu.dashboard');
    }
}
