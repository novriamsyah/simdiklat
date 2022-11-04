<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;
use App\Models\PengajuanDiklat;
use App\Models\Peserta;
use App\Models\Diklat;
use App\Models\DaftarDiklat;

class HalamanDashboardController extends Controller
{
    public function index()
    {
        if(!session()->has('email')){
            return redirect()->route('login.peserta');
        } else {
            $cek_nip = session()->get('nip');
            $cek_profil1 = Peserta::select('peserta.*')->where('nip', $cek_nip)->first();
            $cek_profil2 = $cek_profil1->jabatan;
            $cek_profil3 = $cek_profil1->golongan;
            $datas =  DB::table('diklat')->select('diklat.*')
            ->orderBy('diklat.created_at','desc')
            ->get();

            $ct_diklat1 = Db::table('daftar_diklat')
                            ->where('nip_peserta', $cek_nip)
                            ->count();
            $ct_diklat2 = Db::table('pengajuan_diklat')
                            ->where('nip_peserta', $cek_nip)
                            ->count();

            $ct_sukses_diklat_1 = DaftarDiklat::where('status','=','1')
                                    ->where('nip_peserta', $cek_nip)
                                    ->count();
            $ct_sukses_diklat_2 = PengajuanDiklat::where('status','=','1')
                                    ->where('nip_peserta', $cek_nip)
                                    ->count();

            $ct_tolak_diklat_1 = DaftarDiklat::where('status','=','2')
                                    ->where('nip_peserta', $cek_nip)
                                    ->count();
            $ct_tolak_diklat_2 = PengajuanDiklat::where('status','=','2')
                                    ->where('nip_peserta', $cek_nip)
                                    ->count();

            $ct_tunggu_diklat_1 = DaftarDiklat::where('status','=','0')
                                    ->where('nip_peserta', $cek_nip)
                                    ->count();
            $ct_tunggu_diklat_2 = PengajuanDiklat::where('status','=','0')
                                    ->where('nip_peserta', $cek_nip)
                                    ->count();

            $ct_total_diklat =  $ct_diklat1 +  $ct_diklat2;
            $ct_total_sukses = $ct_sukses_diklat_1 + $ct_sukses_diklat_2;
            $ct_total_tolak = $ct_tolak_diklat_1 + $ct_tolak_diklat_2;
            $ct_total_tunggu = $ct_tunggu_diklat_1 + $ct_tunggu_diklat_2;

            return view('peserta.dashboard', ['datas'=>$datas, 'cek_profil2'=>$cek_profil2,
        'cek_profil3'=>$cek_profil3, 'ct_total_diklat'=>$ct_total_diklat, 'ct_total_sukses'=>$ct_total_sukses, 'ct_total_tolak'=>$ct_total_tolak, 'ct_total_tunggu'=>$ct_total_tunggu]);
        }
        
    }

    public function dashboard_list_diklat($id)
    {
        $lihat_diklat = Diklat::find($id);
        $jenis_diklat = DB::table('jenis_diklat')
        ->where('id', $lihat_diklat->id_jenis_diklat)
        ->first();

        $st_daftar = Carbon::parse($lihat_diklat->mulai_pendaftaran)->translatedFormat('d F Y');
        $sl_daftar = Carbon::parse($lihat_diklat->selesai_pendaftaran)->translatedFormat('d F Y');
        $st_laksana = Carbon::parse($lihat_diklat->mulai_pelakasanaan)->translatedFormat('d F Y');
        $sl_laksana = Carbon::parse($lihat_diklat->selesai_pelakasanaan)->translatedFormat('d F Y');
        $bt_upl = Carbon::parse($lihat_diklat->batas_upload)->translatedFormat('d F Y');

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
            'selisih3'=>$selisih3
        ));
    }

    public function tambah_diklat_baru($id) 
    {
        $cek_nip = session()->get('nip');
        $cek_id_diklat = DaftarDiklat::where('id_diklat', '=', $id)->where('nip_peserta', $cek_nip)->count();

        if($cek_id_diklat >= 1) {
            Session::flash('fail_diklat', 'diklat telah Teredaftar');
            return redirect('/');
        } else {
            $tgl_now = Carbon::now();
            $cek_nip = session()->get('nip');
            $status_default = "0";

            $dt_daftar_diklat = new DaftarDiklat;
            $dt_daftar_diklat->id_diklat = $id;
            $dt_daftar_diklat->nip_peserta = $cek_nip;
            $dt_daftar_diklat->tanggal_daftar = $tgl_now ;
            $dt_daftar_diklat->status = $status_default;
            $simpan = $dt_daftar_diklat->save();
            
            if($simpan) {
                Session::flash('berhasil', 'Anda berhasil mendaftarkan diklat SIDEISEL');
                return redirect('/halaman_daftar_diklat');
            } else {
                Session::flash('gagal', 'Pendaftaran diklat anda gagal');
                return redirect('/');
            }
        }
    }
}
