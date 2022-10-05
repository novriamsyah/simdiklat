<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class halamanPengajuanDiklatController extends Controller
{
    public function halaman_pengajuan_diklat()
    {
        return view('side_menu.pengajuan_diklat.halaman_pengajuan_diklat');
    }
}
