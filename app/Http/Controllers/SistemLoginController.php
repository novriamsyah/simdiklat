<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class SistemLoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function lupa_password()
    {
        return view('lupa_password');
    }

    // Verifikasi Login
    public function verifikasiLogin(Request $request)
    {
        // dd($request->all());
    	// if(Auth::guard('pengguna')->attempt($request->only('email', 'password')))
    	// {
        //     // dd(Auth::guard('peserta')->user()->role);
        //     Session::flash('berhasil_login', 'Kamu berhasil login ke dashboard');
    	// 	return redirect('/');
    	// } elseif(Auth::guard('user')->attempt($request->only('email', 'password'))){
        //     // dd(Auth::guard('user')->user()->role);
        //     Session::flash('berhasil_login', 'Kamu berhasil login ke dashboard');
    	// 	return redirect('/');
    	// }

        if(Auth::attempt($request->only('email', 'password'))){
            Session::flash('berhasil_login', 'Kamu berhasil login ke dashboard');
    		return redirect('/admin');
        }
        Session::flash('gagal_login', 'Maaf username atau password anda salah');
    	return redirect('/admin/login');
    }

    // Proses Logout
    public function logout()
    {
        // if(Auth::guard('pengguna')->check()){
        //     Auth::guard('pengguna')->logout();
        // } elseif(Auth::guard('user')->check()){
        //     Auth::guard('user')->logout();
        // }
        Auth::logout();
    	return redirect('/admin/login');
    }



}
