<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class halamanDashboardPesertaController extends Controller
{
    
    public function dashboard_peserta()
    {
        return view('peserta.dashboard_peserta');
    }
}
