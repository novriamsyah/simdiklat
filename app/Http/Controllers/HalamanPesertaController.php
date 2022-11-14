<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;
use App\Models\Opd;
use App\Models\Peserta;

class HalamanPesertaController extends Controller
{
    public function halaman_peserta()
    {
            $datas = Peserta::all();

            $opd = Opd::all();
            return view('side_menu.peserta.halaman_peserta', ['datas'=>$datas, 'opd'=>$opd]);
       
    }

    public function lihat_peserta($id) {

        // $lihat_peserta = Peserta::find($id);   
        $lihat_peserta = DB::table('peserta')
                ->where('nip', $id)
                ->first();
        
        $opd_id = $lihat_peserta->opd_id;
        $opd_list = DB::table('opd')
                ->where('id', $opd_id)
                ->first();
        $opd = $opd_list->opd;
        $sex = $lihat_peserta->jk;

        if($sex == 'L') {
            $sexx = "Laki-laki";
        } else {
            $sexx = "Perempuan";
        }
        
        $tanggal_lahir = Carbon::parse($lihat_peserta->tanggal_lahir)->translatedFormat('d F Y');
        return response()->json(array(
            'lihat_peserta' => $lihat_peserta,
            'opd' => $opd,
            'tanggal_lahir' => $tanggal_lahir,
            'sexx' => $sexx,
        ));
    }

    public function edit_peserta($email)
    {
        $datas = DB::table('peserta')->select('peserta.*')
        ->where('email', $email)
        ->first();

        $opd = Opd::all();
        
        return view('side_menu.peserta.halaman_edit_peserta', ['datas'=>$datas, 'email'=>$email, 'opd'=>$opd]);
    }

    public function ubah_peserta(Request $req, $email)
    {
        $this->validate($req, [
            'jk' => 'required',
            'opd_id'=>'required',
        ]);

        $tanggal_lahir = Carbon::createFromFormat('m/d/Y',$req->tanggal_lahir)->format('Y-m-d');

        $simpan = Peserta::where('email', '=', $email)
            ->update([
                'nama_lengkap'=>$req->nama_lengkap,
                'nip'=>$req->nip,
                'jk' => $req->jk,
                'alamat' => $req->alamat,
                'nohp' => $req->nohp,
                'tempat_lahir' => $req->tempat_lahir,
                'tanggal_lahir'  => $tanggal_lahir,
                'golongan' => $req->golongan,
                'jabatan' => $req->jabatan,
                'opd_id' => $req->opd_id
            ]);
        
        if($simpan) {
            Session::flash('barui', 'Anda berhasil memperbarui data peserta');
            return redirect('/halaman_kelola_peserta');
        } else {
            Session::flash('gagal', 'Data peserta gagal diperbarui');
            return redirect()->back();
        }
    }

    public function hapus_peserta($id)
    {
        $dt_peserta = Peserta::where('nip', $id)->delete();
        
         if($dt_peserta == 1) {
             $success = true;
             $message = "Data Peserta berhasil dihapus !";
         } else {
             $success = false;
             $message = "gagal menghapus";
         }
         return response()->json([
             'success' => $success,
             'message' => $message,
         ]);
    }

    public function ubah_password($nip)
    {
      

        $lihat_peserta = DB::table('peserta')
                ->where('nip', $nip)
                ->first();
        
        $opd_id = $lihat_peserta->opd_id;
        $opd = DB::table('opd')
                ->where('id', $opd_id)
                ->first();
        $sex = $lihat_peserta->jk;

        if($sex == 'L') {
            $sexx = "Laki-laki";
        } else {
            $sexx = "Perempuan";
        }

        $new_password = "PesertaSideisel";
        
        $simpan = Peserta::where('nip', '=', $nip)
            ->update(['password' => Hash::make($new_password)]);
            
        
        if($simpan) {
            echo "sukses";
            return view('side_menu.peserta.halaman_info_peserta', [
                'lihat_peserta' => $lihat_peserta,
                'opd' => $opd,
                'new_password' => $new_password,
                'sexx' => $sexx,
            ]);
        } else {
            Session::flash('gagal', 'Data peserta gagal diperbarui');
            return redirect()->back();
            echo "gagal";
        }
        
    }
}
