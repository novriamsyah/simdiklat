<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class halamanDashboardController extends Controller
{
    public function index()
    {
        if(!session()->has('email')){
            return redirect()->route('login.peserta');
        } else {
            return view('peserta.dashboard');
        }
        
    }
}
