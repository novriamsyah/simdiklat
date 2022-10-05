<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class halamanDashboardPesertaController extends Controller
{
    
    public function dashboard_peserta()
    {
        $cek_nip = session()->get('nip');
        $datas = DB::table('pengajuan_diklat')
            ->select('pengajuan_diklat.*')
            ->where('pengajuan_diklat.nip_peserta', $cek_nip)
            ->orderBy('pengajuan_diklat.created_at', 'DESC')
            ->get();
  
        if(!session()->has('nip')){
            return redirect()->route('login.peserta');
        } else {
            return view('peserta.dashboard', ['datas'=>$datas]);
        }
    }
}
