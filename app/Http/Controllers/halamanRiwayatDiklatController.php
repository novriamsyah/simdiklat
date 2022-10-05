<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class halamanRiwayatDiklatController extends Controller
{
    public function halaman_riwayat_diklat()
    {
        return view('side_menu.riwayat_diklat.halaman_riwayat_diklat');
    }
}
