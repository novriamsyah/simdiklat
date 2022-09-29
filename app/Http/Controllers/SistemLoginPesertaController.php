<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SistemLoginPesertaController extends Controller
{
    public function halaman_login()
    {
        return view('peserta.login.halaman_login');
    }

    public function loginVerifikasi(Request $req)
    {
        $peserta = DB::table('peserta')
        ->where('email', $req->email)
        ->first();

        if (!$peserta || empty($peserta))
        {
            return back()->with('gagal_login', 'Data Email atau Password anda tidak ditemukan');
        } else {
            $datas = $peserta;
            if (Hash::check($req->password, $peserta->password)){
                $req->session()->put('email', $peserta->email);
                return redirect()->route('dash.peserta')->with(['datas'=>$datas]);
            } else {
                return back()->with('gagal_login', 'Data Email atau Password anda masukan salah');
            }
        }
        
    }

    public function log_out()
    {
        if(session()->has('email')){
            session()->pull('email');
            return redirect()->route('login.peserta')->with('berhasil', 'Selamat tinggal, kamu berhasi keluar');
        }
    }
}
