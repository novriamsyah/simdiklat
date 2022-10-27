<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Opd;

class HalamanOpdController extends Controller
{
    public function halaman_opd()
    {
        
        $query = DB::table('opd')->select('opd.*')
        ->orderBy('opd.created_at','desc')
        ->get();

        return view('master_data.master_data_opd.halaman_opd', ['datas'=>$query]);
    }

    public function halaman_tambah_opd()
    {
        return view('master_data.master_data_opd.halaman_tambah_opd');
    }

    public function simpan_opd(Request $req)
    {
        // dd($req->all());
        $cek_opd = Opd::where('opd', '=', $req->opd)->count();
        if($cek_opd == 1) {
            Session::flash('fail', 'Nama OPD telah digunakan');
            return redirect('/halaman_tambah_opd');
        } else {
            $dt_opd = new Opd;
            $dt_opd->opd = $req->opd;
            $simpan = $dt_opd->save();
            
            if($simpan) {
                Session::flash('berhasil', 'Data OPD baru berhasil tersimpan');
                return redirect('/halaman_opd');
            } else {
                Session::flash('gagal', 'Data OPD gagal tersimpan');
                return redirect()->back();
            }
        }
        
    }

    public function edit_opd($id)
    {
        $datas = Opd::find($id);
        return view('master_data.master_data_opd.halaman_edit_opd', ['id'=>$id, 'datas'=>$datas]);
    }

    public function ubah_opd(Request $req, $id)
    {
            $dt_opd = Opd::find($id);
            $dt_opd->opd = $req->opd;
            $simpan = $dt_opd->save();
            
            if($simpan) {
                Session::flash('diubah', 'Data OPD berhasil diubah');
                return redirect('/halaman_opd');
            } else {
                Session::flash('gagal', 'Data OPD gagal diubah');
                return redirect()->back();
            } 
    }


    public function hapus_opd($id)
    {
        $opd = Opd::where('id', $id)->delete();
        
         if($opd == 1) {
             $success = true;
             $message = "Data OPD berhasil dihapus !";
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
