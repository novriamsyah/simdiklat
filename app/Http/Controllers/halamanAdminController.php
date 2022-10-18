<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class halamanAdminController extends Controller
{
    public function admin()
    {
        $ct_peserta = DB::table('peserta')->count();
        $ct_daftar = DB::table('daftar_diklat')->count();
        $ct_pengajuan = DB::table('pengajuan_diklat')->count();
        return view('side_menu.dashboard', ['ct_peserta'=>$ct_peserta, 'ct_daftar'=>$ct_daftar, 'ct_pengajuan'=>$ct_pengajuan]);
    }
}
