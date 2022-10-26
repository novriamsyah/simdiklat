<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Dokumen;

class HalamanDokumenController extends Controller
{
    public function halaman_dokumen()
    {
        
        $query = DB::table('master_dokumen')->select('master_dokumen.*')
        ->orderBy('master_dokumen.created_at','desc')
        ->get();

        return view('master_data.master_data_dokumen.halaman_dokumen', ['datas'=>$query]);
    }

    // public function lihat_dokumen($id)
    // {
    //     $data = Dokumen::find($id);
    //     return response()->json($data);
    // }

    // public function unduh_dokumen($id)
    // {
    //     $get_file = Dokumen::where('id', $id)->firstOrFail();
    //     $path_file = Storage::path('public/dokumen/'.$get_file->file_dokumen);
    //     return response()->download($path_file);
    // }

    public function halaman_tambah_dokumen()
    {
        return view('master_data.master_data_dokumen.halaman_tambah_dokumen');
    }

    public function simpan_dokumen(Request $req)
    {
        // dd($req->all());
        $this->validate($req, [
            'master_dokumen' => 'required',
        ]);
        
        $cek_doc = Dokumen::where('master_dokumen', '=', $req->master_dokumen)->count();
        if($cek_doc == 1) {
            Session::flash('fail', 'Dokumen telah digunakan');
            return redirect('/halaman_tambah_dokumen');
        } else {

            $simpan = Dokumen::create([
                'master_dokumen'=> $req->master_dokumen
            ]);
            
            if($simpan) {
                Session::flash('berhasil', 'Data dokumen baru berhasil tersimpan');
                return redirect('/halaman_dokumen');
            } else {
                Session::flash('gagal', 'Data dokumen gagal tersimpan');
                return redirect()->back();
            }
        }
        
    }

    public function edit_dokumen($id)
    {
        $datas = Dokumen::find($id);
        return view('master_data.master_data_dokumen.halaman_edit_dokumen', ['id'=>$id, 'datas'=>$datas]);
    }

    public function ubah_dokumen(Request $req, $id)
    {
        $this->validate($req,[
            'master_dokumen'    =>  'required'
        ]);  
        
        $dt_dokumen = Dokumen::find($id);

            $dt_dokumen->update([
                'master_dokumen' => $req->master_dokumen
            ]);
       
            
        if($dt_dokumen) {
            Session::flash('diubah', 'Data dokumen berhasil diubah');
            return redirect('/halaman_dokumen');
        } else {
            Session::flash('gagal', 'Data dokumen gagal diubah');
            return redirect()->back();
        } 
    }


    public function hapus_dokumen($id)
    {
        $doc = Dokumen::where('id', $id)->delete();
        
         if($doc == 1) {
             $success = true;
             $message = "Data Dokumen berhasil dihapus !";
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
