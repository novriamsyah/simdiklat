<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Diklat;
use App\Models\JenisDiklat;

class halamanDiklatController extends Controller
{
    public function halaman_diklat()
    {
        $query = DB::table('diklat')->select('diklat.*')
        ->orderBy('diklat.created_at','desc')
        ->get();

        return view('side_menu.diklat.halaman_diklat', ['datas'=>$query]);
    }

    public function lihat_diklat($id)
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

    public function halaman_tambah_diklat()
    {
        $jenis_diklat = JenisDiklat::all();
        return view('side_menu.diklat.halaman_tambah_diklat', ['jenis_diklat'=>$jenis_diklat]);
    }

    public function simpan_diklat(Request $req)
    {
        $this->validate($req, [
            'id_jenis_diklat'=>'required',
        ]);
        // dd($req->all());
        $cek_nama_diklat = Diklat::where('nama_diklat', '=', $req->nama_diklat)->count();
        if($cek_nama_diklat == 1) {
            Session::flash('fail', 'Nama diklat telah digunakan');
            return redirect('/halaman_tambah_diklat');
        } else {
            $dt_diklat = new Diklat;
            $dt_diklat->nama_diklat = $req->nama_diklat;
            $dt_diklat->tempat_diklat = $req->tempat_diklat;
            $dt_diklat->jp = $req->jp;
            $dt_diklat->id_jenis_diklat = $req->id_jenis_diklat;
            $dt_diklat->angkatan = $req->angkatan;
            $dt_diklat->tahun = $req->tahun;
            $dt_diklat->mulai_pendaftaran = Carbon::createFromFormat('m/d/Y',$req->mulai_pendaftaran)->format('Y-m-d');
            $dt_diklat->selesai_pendaftaran = Carbon::createFromFormat('m/d/Y',$req->selesai_pendaftaran)->format('Y-m-d');
            $dt_diklat->mulai_pelakasanaan = Carbon::createFromFormat('m/d/Y',$req->mulai_pelakasanaan)->format('Y-m-d');
            $dt_diklat->selesai_pelakasanaan = Carbon::createFromFormat('m/d/Y',$req->selesai_pelakasanaan)->format('Y-m-d');
            $dt_diklat->batas_upload = Carbon::createFromFormat('m/d/Y',$req->batas_upload)->format('Y-m-d');
            $simpan = $dt_diklat->save();
            
            if($simpan) {
                Session::flash('berhasil', 'Data diklat baru berhasil tersimpan');
                return redirect('/halaman_diklat');
            } else {
                Session::flash('gagal', 'Data diklat gagal tersimpan');
                return redirect()->back();
            }
        }
        
    }

    public function edit_diklat($id)
    {
        $jenis_diklat = JenisDiklat::all();
        $datas = Diklat::find($id);
        return view('side_menu.diklat.halaman_edit_diklat', ['id'=>$id, 'datas'=>$datas, 'jenis_diklat'=>$jenis_diklat]);
    }

    public function ubah_diklat(Request $req, $id)
    {
        $dt_diklat =  Diklat::find($id);;
        $dt_diklat->nama_diklat = $req->nama_diklat;
        $dt_diklat->tempat_diklat = $req->tempat_diklat;
        $dt_diklat->jp = $req->jp;
        $dt_diklat->id_jenis_diklat = $req->id_jenis_diklat;
        $dt_diklat->angkatan = $req->angkatan;
        $dt_diklat->tahun = $req->tahun;
        $dt_diklat->mulai_pendaftaran = Carbon::createFromFormat('m/d/Y',$req->mulai_pendaftaran)->format('Y-m-d');
        $dt_diklat->selesai_pendaftaran = Carbon::createFromFormat('m/d/Y',$req->selesai_pendaftaran)->format('Y-m-d');
        $dt_diklat->mulai_pelakasanaan = Carbon::createFromFormat('m/d/Y',$req->mulai_pelakasanaan)->format('Y-m-d');
        $dt_diklat->selesai_pelakasanaan = Carbon::createFromFormat('m/d/Y',$req->selesai_pelakasanaan)->format('Y-m-d');
        $dt_diklat->batas_upload = Carbon::createFromFormat('m/d/Y',$req->batas_upload)->format('Y-m-d');
        $simpan = $dt_diklat->save();
        
        if($simpan) {
            Session::flash('berhasil', 'Data diklat baru berhasil diubah');
            return redirect('/halaman_diklat');
        } else {
            Session::flash('gagal', 'Data diklat gagal diubah');
            return redirect()->back();
        }
    }


    public function hapus_diklat($id)
    {
        $jenis_diklat = Diklat::where('id', $id)->delete();
        
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
