<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\DaftarDiklat;


class HalamanRiwayatDiklatController extends Controller
{
    

    public function halaman_riwayat_diklat()
    {
        $datas = DB::table('peserta')
            ->select('peserta.*', 'daftar_diklat.*', 'diklat.*')
            ->join('daftar_diklat', 'daftar_diklat.nip_peserta', '=','peserta.nip')
            ->join('diklat', 'daftar_diklat.id_diklat', '=','diklat.id')
            ->orderBy('daftar_diklat.created_at', 'DESC')
            ->get();
            // dd($datas);
        return view('side_menu.riwayat_diklat.halaman_riwayat_diklat', ['datas'=>$datas]);
    }

    public function lihat_sertifikat_rwyt($id)
    {
        $data =  DB::table('daftar_diklat')
        ->select('daftar_diklat.*')
        ->where('id_diklat', $id)
        ->first();
        return response()->json($data);
    }

    public function lihat_verifikasi_diklat($id)
    {
        $datas = DB::table('peserta')
            ->select('peserta.*', 'daftar_diklat.*', 'diklat.*')
            ->join('daftar_diklat', 'daftar_diklat.nip_peserta', '=','peserta.nip')
            ->join('diklat', 'daftar_diklat.id_diklat', '=','diklat.id')
            ->where('id_diklat', $id)
            ->orderBy('daftar_diklat.created_at', 'DESC')
            ->first();
        
        $dftr_diklat =  DB::table('daftar_diklat')
            ->select('daftar_diklat.*')
            ->where('id_diklat', $id)
            ->first();
            
        $idd = $dftr_diklat->id;

        $dkmn =  DB::table('dokumen')
            ->select('dokumen.*')
            ->where('id_daftar_diklat', $idd)
            ->get();
        
        $ct_dkmn =  DB::table('dokumen')
            ->select('dokumen.*')
            ->where('id_daftar_diklat', $idd)
            ->count();

        $id_opd = $datas->opd_id;
        $opd = DB::table('opd')
            ->where('id', $id_opd)
            ->first();
        
        $id_jenis_diklat = $datas->id_jenis_diklat;
        $jenis_diklat = DB::table('jenis_diklat')
            ->where('id', $id_jenis_diklat)
            ->first();

        return view('side_menu.riwayat_diklat.lihat_verif_diklat', ['datas'=>$datas, 'dkmn'=>$dkmn, 'opd'=>$opd, 'jenis_diklat'=>$jenis_diklat, 'ct_dkmn'=>$ct_dkmn]);
    }

    public function detail_pendaftaran_diklat_peserta($id)
    {
        $datas = DB::table('peserta')
            ->select('peserta.*', 'daftar_diklat.*', 'diklat.*')
            ->join('daftar_diklat', 'daftar_diklat.nip_peserta', '=','peserta.nip')
            ->join('diklat', 'daftar_diklat.id_diklat', '=','diklat.id')
            ->where('id_diklat', $id)
            ->orderBy('daftar_diklat.created_at', 'DESC')
            ->first();
        
        $dftr_diklat =  DB::table('daftar_diklat')
            ->select('daftar_diklat.*')
            ->where('id_diklat', $id)
            ->first();
            
        $idd = $dftr_diklat->id;

        $dkmn =  DB::table('dokumen')
            ->select('dokumen.*')
            ->where('id_daftar_diklat', $idd)
            ->get();
        
        $ct_dkmn =  DB::table('dokumen')
            ->select('dokumen.*')
            ->where('id_daftar_diklat', $idd)
            ->count();

        $id_opd = $datas->opd_id;
        $opd = DB::table('opd')
            ->where('id', $id_opd)
            ->first();
        
        $id_jenis_diklat = $datas->id_jenis_diklat;
        $jenis_diklat = DB::table('jenis_diklat')
            ->where('id', $id_jenis_diklat)
            ->first();

        return view('side_menu.riwayat_diklat.lihat_dtl_diklat', ['datas'=>$datas, 'dkmn'=>$dkmn, 'opd'=>$opd, 'jenis_diklat'=>$jenis_diklat, 'ct_dkmn'=>$ct_dkmn]);
    }

    public function get_edit_daftar($id)
    {
        // $datas = DaftarDiklat::find($id);
        $datas =  DB::table('daftar_diklat')
        ->select('daftar_diklat.*')
        ->where('id_diklat', $id)
        ->first();
        //return response
        return response()->json([
            'success' => true,
            'data'    => $datas  
        ]); 
    }

    public function proses_validasi_daftar(Request $request, $id)
    {
        $datas = DaftarDiklat::find($id);

        $validator = Validator::make($request->all(), [
            'status'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $datas->update([
            'status'     => $request->status,
            'catatan'   => $request->catatan,
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil divalidasi!',
            'data'    => $datas
        ]);
    }

    public function hapus_diklat($id)
    {
        $jenis_diklat = DB::table('daftar_diklat')
        ->select('daftar_diklat.*')
        ->where('id_diklat', $id)
        ->delete();
        
         if($jenis_diklat == 1) {
             $success = true;
             $message = "Data diklat berhasil dihapus !";
         } else {
             $success = false;
             $message = "gagal menghapus";
         }
         return response()->json([
             'success' => $success,
             'message' => $message,
         ]);
    }

    
}
