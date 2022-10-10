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

class halamanDashboardController extends Controller
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

            return view('peserta.dashboard', ['datas'=>$datas, 'cek_profil2'=>$cek_profil2,
        'cek_profil3'=>$cek_profil3]);
        }
        
    }

    public function dashboard_list_diklat($id)
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
