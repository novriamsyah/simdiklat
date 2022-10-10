<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\DaftarDiklat;

class halamanRiwayatDiklatController extends Controller
{
    

    public function halaman_riwayat_diklat()
    {
        $datas = DB::table('peserta')
            ->select('peserta.*', 'daftar_diklat.*', 'diklat.*')
            ->join('daftar_diklat', 'daftar_diklat.nip_peserta', '=','peserta.nip')
            ->join('diklat', 'daftar_diklat.id_diklat', '=','diklat.id')
            ->orderBy('daftar_diklat.created_at', 'DESC')
            ->get();
        return view('side_menu.riwayat_diklat.halaman_riwayat_diklat', ['datas'=>$datas]);
    }

    public function lihat_sertifikat_rwyt($id)
    {
        $data = DaftarDiklat::find($id);
        return response()->json($data);
    }
}
