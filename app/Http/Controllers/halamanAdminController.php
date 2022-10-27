<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;
use App\Models\JenisDiklat;
use App\Models\PengajuanDiklat;
use App\Models\DaftarDiklat;

class HalamanAdminController extends Controller
{
    public function admin()
    {
        $ct_peserta = DB::table('peserta')->count();
        $ct_daftar = DB::table('daftar_diklat')->count();
        $ct_pengajuan = DB::table('pengajuan_diklat')->count();

        $jenis_diklat = JenisDiklat::all();


        return view('side_menu.dashboard', ['ct_peserta'=>$ct_peserta, 'ct_daftar'=>$ct_daftar, 'ct_pengajuan'=>$ct_pengajuan, 'jenis_diklat'=>$jenis_diklat]);
    }

    public function pdf_laporan_diklat(Request $req)
    {
        // dd($req->all());
        if($req->id_jenis_diklat == '0' && $req->semua_cek == '1'){

            $datas2 = DB::table('pengajuan_diklat')
            ->select('pengajuan_diklat.*', 'peserta.nama_lengkap')
            ->join('peserta', 'peserta.nip', '=','pengajuan_diklat.nip_peserta')
            ->orderBy('pengajuan_diklat.created_at', 'DESC')
            ->get();

            $datas1 = DB::table('peserta')
            ->select('peserta.nama_lengkap', 'daftar_diklat.*', 'diklat.*')
            ->join('daftar_diklat', 'daftar_diklat.nip_peserta', '=','peserta.nip')
            ->join('diklat', 'daftar_diklat.id_diklat', '=','diklat.id')
            ->orderBy('daftar_diklat.created_at', 'DESC')
            ->get();

            $tanggal = "Semua Diklat";
            $jenis1 = "Semua Diklat";
            $jenis = "Semua Diklat";
            $start_date2 = "";
            $end_date2 = "";

            $pdf = PDF::loadview('side_menu.laporan_filter', [
                'datas1' => $datas1,
                'datas2' => $datas2,
                'tanggal'=> $tanggal,
                'jenis' => $jenis,
                'jenis1' => $jenis1,
                'start_date2' => $start_date2,
                'end_date2' => $end_date2
            ]);

            return $pdf->stream();
            

        } else if($req->id_jenis_diklat != '0' && $req->semua_cek == '1'){

            $datas2 = DB::table('pengajuan_diklat')
            ->select('pengajuan_diklat.*', 'peserta.nama_lengkap')
            ->join('peserta', 'peserta.nip', '=','pengajuan_diklat.nip_peserta')
            ->where('id_jenis_diklat', $req->id_jenis_diklat)
            ->orderBy('pengajuan_diklat.created_at', 'DESC')
            ->get();

            $datas1 = DB::table('peserta')
            ->select('peserta.nama_lengkap', 'daftar_diklat.*', 'diklat.*')
            ->join('daftar_diklat', 'daftar_diklat.nip_peserta', '=','peserta.nip')
            ->join('diklat', 'daftar_diklat.id_diklat', '=','diklat.id')
            ->where('id_jenis_diklat', $req->id_jenis_diklat)
            ->orderBy('daftar_diklat.created_at', 'DESC')
            ->get();

            $tanggal = "Semua Diklat";
            $jenis1 = "";
            $jns_diklat = JenisDiklat::where('id', $req->id_jenis_diklat)->first();
            $jenis = $jns_diklat->jenis_diklat;
            $start_date2 = "";
            $end_date2 = "";

            $pdf = PDF::loadview('side_menu.laporan_filter', [
                'datas1' => $datas1,
                'datas2' => $datas2,
                'tanggal'=> $tanggal,
                'jenis' => $jenis,
                'jenis1' => $jenis1,
                'start_date2' => $start_date2,
                'end_date2' => $end_date2
            ]);

            return $pdf->stream();

        } else if($req->id_jenis_diklat == '0' && $req->semua_cek != '1') {
            $start_date = $req->start_date;
            $end_date = $req->end_date;

            $start_date2 = $start_date[6].$start_date[7].$start_date[8].$start_date[9].'-'.$start_date[0].$start_date[1].'-'.$start_date[3].$start_date[4];

            $end_date2 = $end_date[6].$end_date[7].$end_date[8].$end_date[9].'-'.$end_date[0].$end_date[1].'-'.$end_date[3].$end_date[4];

            $datas2 = DB::table('pengajuan_diklat')
            ->select('pengajuan_diklat.*', 'peserta.nama_lengkap')
            ->join('peserta', 'peserta.nip', '=','pengajuan_diklat.nip_peserta')
            ->whereBetween('pengajuan_diklat.created_at', array($start_date2, $end_date2))
            ->orderBy('pengajuan_diklat.created_at', 'DESC')
            ->get();

            $datas1 = DB::table('peserta')
            ->select('peserta.nama_lengkap', 'daftar_diklat.*', 'diklat.*')
            ->join('daftar_diklat', 'daftar_diklat.nip_peserta', '=','peserta.nip')
            ->join('diklat', 'daftar_diklat.id_diklat', '=','diklat.id')
            ->whereBetween('daftar_diklat.created_at', array($start_date2, $end_date2))
            ->orderBy('daftar_diklat.created_at', 'DESC')
            ->get();

            $tanggal = "";
            $jenis1 = "Semua Diklat";
            $jenis = "Semua Diklat";
            $start_date2 = $start_date;
            $end_date2 = $end_date;

            $pdf = PDF::loadview('side_menu.laporan_filter', [
                'datas1' => $datas1,
                'datas2' => $datas2,
                'tanggal'=> $tanggal,
                'jenis' => $jenis,
                'jenis1' => $jenis1,
                'start_date2' => $start_date2,
                'end_date2' => $end_date2
            ]);

            return $pdf->stream();

        } else {
            $start_date = $req->start_date;
            $end_date = $req->end_date;

            $start_date2 = $start_date[6].$start_date[7].$start_date[8].$start_date[9].'-'.$start_date[0].$start_date[1].'-'.$start_date[3].$start_date[4];

            $end_date2 = $end_date[6].$end_date[7].$end_date[8].$end_date[9].'-'.$end_date[0].$end_date[1].'-'.$end_date[3].$end_date[4];

            $datas2 = DB::table('pengajuan_diklat')
            ->select('pengajuan_diklat.*', 'peserta.nama_lengkap')
            ->join('peserta', 'peserta.nip', '=','pengajuan_diklat.nip_peserta')
            ->where('id_jenis_diklat', $req->id_jenis_diklat)
            ->whereBetween('pengajuan_diklat.created_at', array($start_date2, $end_date2))
            ->orderBy('pengajuan_diklat.created_at', 'DESC')
            ->get();

            $datas1 = DB::table('peserta')
            ->select('peserta.nama_lengkap', 'daftar_diklat.*', 'diklat.*')
            ->join('daftar_diklat', 'daftar_diklat.nip_peserta', '=','peserta.nip')
            ->join('diklat', 'daftar_diklat.id_diklat', '=','diklat.id')
            ->where('id_jenis_diklat', $req->id_jenis_diklat)
            ->whereBetween('daftar_diklat.created_at', array($start_date2, $end_date2))
            ->orderBy('daftar_diklat.created_at', 'DESC')
            ->get();

            $tanggal = "";
            $jenis1 = "";
            $jns_diklat = JenisDiklat::where('id', $req->id_jenis_diklat)->first();
            $jenis = $jns_diklat->jenis_diklat;
            $start_date2 = $start_date;
            $end_date2 = $end_date;

            $pdf = PDF::loadview('side_menu.laporan_filter', [
                'datas1' => $datas1,
                'datas2' => $datas2,
                'tanggal'=> $tanggal,
                'jenis' => $jenis,
                'jenis1' => $jenis1,
                'start_date2' => $start_date2,
                'end_date2' => $end_date2
            ]);

            return $pdf->stream();
        }
    }
}
