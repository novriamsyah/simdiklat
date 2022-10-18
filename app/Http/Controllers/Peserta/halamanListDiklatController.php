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

        //status
        $now_date = \Carbon\Carbon::now()->format('d-m-Y');

        $str_date = \Carbon\Carbon::parse($lihat_diklat->mulai_pendaftaran)->format('d-m-Y');
        $end_date = \Carbon\Carbon::parse($lihat_diklat->selesai_pendaftaran)->format('d-m-Y');
        $str_date1 = \Carbon\Carbon::parse($lihat_diklat->mulai_pelakasanaan)->format('d-m-Y');
        $end_date1 = \Carbon\Carbon::parse($lihat_diklat->selesai_pelakasanaan)->format('d-m-Y');

        $sekarang = \Carbon\Carbon::createFromFormat('d-m-Y', $now_date);
        $mulai_dftr = \Carbon\Carbon::createFromFormat('d-m-Y', $str_date);
        $selesai_dftr = \Carbon\Carbon::createFromFormat('d-m-Y', $end_date);
        $mulai_lksana = \Carbon\Carbon::createFromFormat('d-m-Y', $str_date1 );
        $selesai_lksana  = \Carbon\Carbon::createFromFormat('d-m-Y', $end_date1);

        $selisih = $sekarang->diffInDays($mulai_dftr, false);
        $selisih1 = $sekarang->diffInDays($selesai_dftr, false);
        $selisih2 = $sekarang->diffInDays($mulai_lksana, false);
        $selisih3 = $sekarang->diffInDays($selesai_lksana, false);

        return response()->json(array(
            'lihat_diklat'=>$lihat_diklat,
            'jenis_diklat'=>$jenis_diklat,
            'st_daftar'=>$st_daftar,
            'sl_daftar'=>$sl_daftar,
            'st_laksana'=>$st_laksana,
            'sl_laksana'=>$sl_laksana,
            'bt_upl'=>$bt_upl,
            'selisih'=>$selisih,
            'selisih1'=>$selisih1,
            'selisih2'=>$selisih2,
            'selisih3'=>$selisih3,
        ));
    }
}
