<?php

namespace App\Http\Controllers\peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Diklat;


class halamanListDiklatController extends Controller
{
    public function halaman_list_diklat()
    {
        $datas =  DB::table('diklat')->select('diklat.*')
        ->orderBy('diklat.created_at','desc')
        ->get();
        
        if(!session()->has('nip')){
            return redirect()->route('login.peserta');
        } else {
            return view('peserta.list_diklat.halaman_list_diklat', ['datas'=>$datas]);
        }
        
    }

    public function lihat_list_diklat($id)
    {
        $lihat_diklat = Diklat::find($id);
        $jenis_diklat = DB::table('jenis_diklat')
        ->where('id', $lihat_diklat->id_jenis_diklat)
        ->first();
        Carbon::setLocale('id');
        $st_daftar = Carbon::createFromFormat('Y-m-d',$lihat_diklat->mulai_pendaftaran)->format('d F Y');
        $sl_daftar = Carbon::createFromFormat('Y-m-d',$lihat_diklat->selesai_pendaftaran)->format('d F Y');
        $st_laksana = Carbon::createFromFormat('Y-m-d',$lihat_diklat->mulai_pelakasanaan)->format('d F Y');
        $sl_laksana = Carbon::createFromFormat('Y-m-d',$lihat_diklat->selesai_pelakasanaan)->format('d F Y');
        $bt_upl = Carbon::createFromFormat('Y-m-d',$lihat_diklat->batas_upload)->format('d F Y');
        return response()->json(array(
            'lihat_diklat'=>$lihat_diklat,
            'jenis_diklat'=>$jenis_diklat,
            'st_daftar'=>$st_daftar,
            'sl_daftar'=>$sl_daftar,
            'st_laksana'=>$st_laksana,
            'sl_laksana'=>$sl_laksana,
            'bt_upl'=>$bt_upl
        ));
    }
}
