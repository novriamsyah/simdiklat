<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\JenisDiklat;

class HalamanJenisDiklatController extends Controller
{
    public function halaman_jenis_diklat()
    {
        
        $query = DB::table('jenis_diklat')->select('jenis_diklat.*')
        ->orderBy('jenis_diklat.created_at','desc')
        ->get();

        return view('master_data.master_data_jenis_diklat.halaman_jenis_diklat', ['datas'=>$query]);
    }

    public function halaman_tambah_jenis_diklat()
    {
        return view('master_data.master_data_jenis_diklat.halaman_tambah_jenis_diklat');
    }

    public function simpan_jenis_diklat(Request $req)
    {
        // dd($req->all());
        $cek_jenis_diklat = JenisDiklat::where('jenis_diklat', '=', $req->jenis_diklat)->count();
        if($cek_jenis_diklat == 1) {
            Session::flash('fail', 'Jenis diklat telah digunakan');
            return redirect('/halaman_tambah_jenis_diklat');
        } else {
            $dt_jenis_diklat = new JenisDiklat;
            $dt_jenis_diklat->jenis_diklat = $req->jenis_diklat;
            $simpan = $dt_jenis_diklat->save();
            
            if($simpan) {
                Session::flash('berhasil', 'Data jenis diklat baru berhasil tersimpan');
                return redirect('/halaman_jenis_diklat');
            } else {
                Session::flash('gagal', 'Data jenis diklat gagal tersimpan');
                return redirect()->back();
            }
        }
        
    }

    public function edit_jenis_diklat($id)
    {
        $datas = JenisDiklat::find($id);
        return view('master_data.master_data_jenis_diklat.halaman_edit_jenis_diklat', ['id'=>$id, 'datas'=>$datas]);
    }

    public function ubah_jenis_diklat(Request $req, $id)
    {
            $dt_jenis_diklat = JenisDiklat::find($id);
            $dt_jenis_diklat->jenis_diklat = $req->jenis_diklat;
            $simpan = $dt_jenis_diklat->save();
            
            if($simpan) {
                Session::flash('diubah', 'Data jenis diklat berhasil diubah');
                return redirect('/halaman_jenis_diklat');
            } else {
                Session::flash('gagal', 'Data jenis diklat gagal diubah');
                return redirect()->back();
            } 
    }


    public function hapus_jenis_diklat($id)
    {
        $jenis_diklat = JenisDiklat::where('id', $id)->delete();
        
         if($jenis_diklat == 1) {
             $success = true;
             $message = "Jenis diklat berhasil dihapus !";
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
