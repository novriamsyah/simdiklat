<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\PengajuanDiklat;
use App\Models\DokumenPengajuan;

class halamanPengajuanDiklatController extends Controller
{
    public function halaman_pengajuan_diklat()
    {

        $datas = DB::table('pengajuan_diklat')
            ->select('pengajuan_diklat.*', 'peserta.*')
            ->join('peserta', 'peserta.nip', '=','pengajuan_diklat.nip_peserta')
            ->orderBy('pengajuan_diklat.created_at', 'DESC')
            ->get();

        return view('side_menu.pengajuan_diklat.halaman_pengajuan_diklat', ['datas'=>$datas]);
    }

    public function lihat_pengajuan_peserta($id)
    {
        $data = PengajuanDiklat::find($id);
        return response()->json($data);
    }

    public function peserta_doc_pengajuan($id)
    {
        $datas = DB::table('dokumen_pengajuan')
            ->select('dokumen_pengajuan.*')
            ->where('id_pengajuan', $id)
            ->first();
        return response()->json($datas);
    }


    public function get_edit_pengajuan($id)
    {
        $datas = PengajuanDiklat::find($id);
        //return response
        return response()->json([
            'success' => true,
            'data'    => $datas  
        ]); 
    }

    public function get_dokumen_pengajuan($id)
    {
        $data = DB::table('dokumen_pengajuan')
            ->select('dokumen_pengajuan.*')
            ->where('id_pengajuan', $id)
            ->first();
        return response()->json([
            'success' => true,
            'data'    => $data  
        ]); 
    }



    public function proses_validasi_pengajuan(Request $request, $id)
    {
        $datas = PengajuanDiklat::find($id);
        // $reques = $request->all();
        // //return response
        // return response()->json([
        //     'success' => true,
        //     'data'    => $datas,
        //     'reques'  => $reques  
        // ]); 

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

    public function proses_validasi_dokumen_peserta(Request $request, $id)
    {
        $datas = DokumenPengajuan::find($id);
        // $reques = $request->all();
        // //return response
        // return response()->json([
        //     'success' => true,
        //     'data'    => $datas,
        //     'reques'  => $reques  
        // ]); 

        $validator = Validator::make($request->all(), [
            'cek'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $datas->update([
            'cek'     => $request->cek, 
            'catatan'   => $request->catatan_doc,
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data dokumen Berhasil divalidasi!',
            'data'    => $datas  
        ]);
    }
}
