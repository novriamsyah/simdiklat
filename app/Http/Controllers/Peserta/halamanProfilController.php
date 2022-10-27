<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;
use App\Models\Opd;
use App\Models\User;
use App\Models\Peserta;


class HalamanProfilController extends Controller
{
    public function profil_saya()
    {

        if(!session()->has('nip')){
            return redirect()->route('login.peserta');
        } else {
            $cek_nip = session()->get('nip');
            $datas = DB::table('peserta')->select('peserta.*')
            ->where('nip', $cek_nip)
            ->first();

            $nama = $datas->nama_lengkap;
            $nip = $cek_nip;
            $email = $datas->email;

            $opd = Opd::all();
            return view('peserta.profil.halaman_profil', ['datas'=>$datas, 'nama'=>$nama, 'nip'=>$nip, 'opd'=>$opd, 'email'=>$email]);
        }
       
    }

    public function halaman_tambah_profil()
    {
        

        if(!session()->has('nip')){
            return redirect()->route('login.peserta');
        } else {
            $cek_nip = session()->get('nip');
            $datas = DB::table('peserta')
            ->where('nip', $cek_nip)
            ->first();

            $nama = $datas->nama_lengkap;
            $nip = $cek_nip;
            $email = $datas->email;

            $opd = Opd::all();
            return view('peserta.profil.halaman_tambah_profil', ['nama'=>$nama, 'opd'=>$opd, 'nip'=>$nip, 'email'=>$email]);
        }
    }

    public function simpan_profil(Request $req) 
    {
        $this->validate($req, [
            'jk' => 'required',
            'opd_id'=>'required',
        ]);

        $cek_nip = session()->get('nip');
        $tanggal_lahir = Carbon::createFromFormat('m/d/Y',$req->tanggal_lahir)->format('Y-m-d');

        $simpan = Peserta::where('nip', '=', $cek_nip)
            ->update([
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
            Session::flash('barui', 'Anda berhasil memperbarui profil');
            return redirect('/');
        } else {
            Session::flash('gagal', 'profil gagal diperbarui');
            return redirect()->back();
        }
    }

    public function edit_profil($email)
    {
        $cek_nip = session()->get('nip');
        $datas = DB::table('peserta')->select('peserta.*')
        ->where('nip', $cek_nip)
        ->where('email', $email)
        ->first();

        $opd = Opd::all();

        if(!session()->has('nip')){
            return redirect()->route('login.peserta');
        } else {
            return view('peserta.profil.halaman_edit_profil', ['datas'=>$datas, 'email'=>$email, 'opd'=>$opd]);
        }
    }

    public function ubah_profil(Request $req, $email)
    {
        $this->validate($req, [
            'jk' => 'required',
            'opd_id'=>'required',
        ]);

        $cek_nip = session()->get('nip');
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
            Session::flash('barui', 'Anda berhasil memperbarui profil');
            return redirect('/profil_saya');
        } else {
            Session::flash('gagal', 'profil gagal diperbarui');
            return redirect()->back();
        }
    }

    public function kelola_profil()
    {
        if(!session()->has('nip')){
            return redirect()->route('login.peserta');
        } else {
            $cek_nip = session()->get('nip');
            $data = DB::table('peserta')->select('peserta.*')
            ->where('nip', $cek_nip)
            ->first();

            $nama = $data->nama_lengkap;
            $nip = $cek_nip;
            $email = $data->email;

            $opd = Opd::all();
            return view('peserta.profil.kelola_profil', ['data'=>$data, 'nama'=>$nama, 'nip'=>$nip, 'opd'=>$opd, 'email'=>$email]);
        }
    }

    public function ubah_password(Request $request, $email)
    {
        $users = DB::table('peserta')->select('peserta.*')
        ->where('email', $email)
        ->first();
        if(Hash::check($request->old_password, $users->password)){
            Peserta::where('email', '=', $email)
            ->update(['password' => Hash::make($request->new_password)]);
            echo "sukses";
        }else{
            echo "gagal";
        }
    }
}
