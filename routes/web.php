<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/temp', function () {
//     return view('template.master');
// });

// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/tes', function () {
    return view('dash.test');
});


//sistem login
Route::get('/admin/login', [App\Http\Controllers\SistemLoginController::class, 'login'])->name('login');
Route::post('/login_verifikasi', [App\Http\Controllers\SistemLoginController::class, 'verifikasiLogin'])->name('login.verifikasi');
Route::get('/logout', [App\Http\Controllers\SistemLoginController::class, 'logout'])->name('logout');

//forgot password
Route::get('/forget-password', [App\Http\Controllers\ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('/proses-forget-password', [App\Http\Controllers\ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('/reset-password/{token}', [App\Http\Controllers\ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('/reset-password', [App\Http\Controllers\ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


//================================= Akeses super_admin ======================================
Route::group(['middleware' => ['auth', 'cekrole:Admin']], function(){

    //user
    
    Route::get('/halaman_user', [App\Http\Controllers\halamanUserController::class, 'halaman_user']);
    Route::get('/halaman_tambah_user', [App\Http\Controllers\halamanUserController::class, 'halaman_tambah_user']);
    Route::post('/simpan_user', [App\Http\Controllers\halamanUserController::class, 'simpan_user']);
    Route::get('/edit_user/{id}', [App\Http\Controllers\halamanUserController::class, 'edit_user']);
    Route::post('/ubah_user/{id}', [App\Http\Controllers\halamanUserController::class, 'ubah_user']);
    Route::post('/hapus_user/{id}', [App\Http\Controllers\halamanUserController::class, 'hapus_user']);


});

Route::group(['middleware' => ['auth', 'cekrole:Admin,Operator,Peserta']], function(){

    //index
    Route::get('/admin', [App\Http\Controllers\halamanAdminController::class, 'admin']);
    //kelola profil
    Route::get('/kelola_profil', [App\Http\Controllers\halamanUserController::class, 'kelola_profil']);
    Route::post('/update_profil', [App\Http\Controllers\halamanUserController::class, 'update_profil']);
    Route::post('/ubah_password/{id}', [App\Http\Controllers\halamanUserController::class, 'ubah_password']);

    //master opd
    Route::get('/halaman_opd', [App\Http\Controllers\halamanOpdController::class, 'halaman_opd']);
    Route::get('/halaman_tambah_opd', [App\Http\Controllers\halamanOpdController::class, 'halaman_tambah_opd']);
    Route::post('/simpan_opd', [App\Http\Controllers\halamanOpdController::class, 'simpan_opd']);
    Route::get('/edit_opd/{id}', [App\Http\Controllers\halamanOpdController::class, 'edit_opd']);
    Route::post('/ubah_opd/{id}', [App\Http\Controllers\halamanOpdController::class, 'ubah_opd']);
    Route::post('/hapus_opd/{id}', [App\Http\Controllers\halamanOpdController::class, 'hapus_opd']);

    //master dokumen
    Route::get('/halaman_dokumen', [App\Http\Controllers\halamanDokumenController::class, 'halaman_dokumen']);
    Route::get('/lihat_dokumen/{id}', [App\Http\Controllers\halamanDokumenController::class, 'lihat_dokumen']);
    Route::get('/unduh_dokumen/{id}', [App\Http\Controllers\halamanDokumenController::class, 'unduh_dokumen']);
    Route::get('/halaman_tambah_dokumen', [App\Http\Controllers\halamanDokumenController::class, 'halaman_tambah_dokumen']);
    Route::post('/simpan_dokumen', [App\Http\Controllers\halamanDokumenController::class, 'simpan_dokumen']);
    Route::get('/edit_dokumen/{id}', [App\Http\Controllers\halamanDokumenController::class, 'edit_dokumen']);
    Route::post('/ubah_dokumen/{id}', [App\Http\Controllers\halamanDokumenController::class, 'ubah_dokumen']);
    Route::post('/hapus_dokumen/{id}', [App\Http\Controllers\halamanDokumenController::class, 'hapus_dokumen']);

    //master jenis diklat
    Route::get('/halaman_jenis_diklat', [App\Http\Controllers\halamanJenisDiklatController::class, 'halaman_jenis_diklat']);
    Route::get('/halaman_tambah_jenis_diklat', [App\Http\Controllers\halamanJenisDiklatController::class, 'halaman_tambah_jenis_diklat']);
    Route::post('/simpan_jenis_diklat', [App\Http\Controllers\halamanJenisDiklatController::class, 'simpan_jenis_diklat']);
    Route::get('/edit_jenis_diklat/{id}', [App\Http\Controllers\halamanJenisDiklatController::class, 'edit_jenis_diklat']);
    Route::post('/ubah_jenis_diklat/{id}', [App\Http\Controllers\halamanJenisDiklatController::class, 'ubah_jenis_diklat']);
    Route::post('/hapus_jenis_diklat/{id}', [App\Http\Controllers\halamanJenisDiklatController::class, 'hapus_jenis_diklat']);

    Route::get('/halaman_diklat', [App\Http\Controllers\halamanDiklatController::class, 'halaman_diklat']);
    Route::get('/lihat_diklat/{id}', [App\Http\Controllers\halamanDiklatController::class, 'lihat_diklat']);
    Route::get('/halaman_tambah_diklat', [App\Http\Controllers\halamanDiklatController::class, 'halaman_tambah_diklat']);
    Route::post('/simpan_diklat', [App\Http\Controllers\halamanDiklatController::class, 'simpan_diklat']);
    Route::get('/edit_diklat/{id}', [App\Http\Controllers\halamanDiklatController::class, 'edit_diklat']);
    Route::post('/ubah_diklat/{id}', [App\Http\Controllers\halamanDiklatController::class, 'ubah_diklat']);
    Route::post('/hapus_diklat/{id}', [App\Http\Controllers\halamanDiklatController::class, 'hapus_diklat']);

    Route::get('/halaman_riwayat_diklat', [App\Http\Controllers\halamanRiwayatDiklatController::class, 'halaman_riwayat_diklat']);

    Route::get('/halaman_pengajuan_diklat', [App\Http\Controllers\halamanPengajuanDiklatController::class, 'halaman_pengajuan_diklat']);

});


//Route untuk peserta

//sistem register dan login
Route::get('/register', [App\Http\Controllers\SistemLoginPesertaController::class, 'register_akun'])->name('register.akun');
Route::post('/proses_register', [App\Http\Controllers\SistemLoginPesertaController::class, 'proses_register'])->name('proses.register');
Route::get('/login', [App\Http\Controllers\SistemLoginPesertaController::class, 'halaman_login'])->name('login.peserta');
Route::post('/verifikasilogin', [App\Http\Controllers\SistemLoginPesertaController::class, 'loginVerifikasi'])->name('verifikasi.login');
Route::get('/log_out', [App\Http\Controllers\SistemLoginPesertaController::class, 'log_out'])->name('logout.peserta');

//dashboard
Route::get('/', [App\Http\Controllers\halamanDashboardController::class, 'index'])->name('dash.peserta');
Route::get('/dashboard_list_diklat/{id}', [App\Http\Controllers\halamanDashboardController::class, 'dashboard_list_diklat']);
Route::get('/tambah_diklat_baru/{id}', [App\Http\Controllers\halamanDashboardController::class, 'tambah_diklat_baru']);

//list Diklat
Route::get('/halaman_list_diklat', [App\Http\Controllers\Peserta\halamanListDiklatController::class, 'halaman_list_diklat']);
Route::get('/lihat_list_diklat/{id}', [App\Http\Controllers\Peserta\halamanListDiklatController::class, 'lihat_list_diklat']);


//daftar diklat
Route::get('/halaman_daftar_diklat', [App\Http\Controllers\Peserta\halamanDaftarDiklatController::class, 'halaman_daftar_diklat']);
Route::get('/lihat_daftar_diklat/{id}', [App\Http\Controllers\Peserta\halamanDaftarDiklatController::class, 'lihat_daftar_diklat']);
Route::get('/tambah_daftar_diklat', [App\Http\Controllers\Peserta\halamanDaftarDiklatController::class, 'tambah_daftar_diklat']);
Route::post('/simpan_daftar_diklat', [App\Http\Controllers\Peserta\halamanDaftarDiklatController::class, 'simpan_daftar_diklat']);
Route::post('/hapus_daftar_diklat/{id}', [App\Http\Controllers\Peserta\halamanDaftarDiklatController::class, 'hapus_daftar_diklat']);

//pengajuan Diklat
Route::get('/halaman_pengajuan_diklat', [App\Http\Controllers\Peserta\halamanAjuDiklatController::class, 'halaman_pengajuan_diklat']);
Route::get('/lihat_pengajuan_diklat/{id}', [App\Http\Controllers\Peserta\halamanAjuDiklatController::class, 'lihat_pengajuan_diklat']);
Route::get('/detail_pengajuan_diklat/{id}', [App\Http\Controllers\Peserta\halamanAjuDiklatController::class, 'detail_pengajuan_diklat']);
Route::get('/tambah_pengajuan_diklat', [App\Http\Controllers\Peserta\halamanAjuDiklatController::class, 'tambah_pengajuan_diklat']);
Route::post('/simpan_pengajuan_diklat', [App\Http\Controllers\Peserta\halamanAjuDiklatController::class, 'simpan_pengajuan_diklat']);
Route::post('/hapus_pengajuan_diklat/{id}', [App\Http\Controllers\Peserta\halamanAjuDiklatController::class, 'hapus_pengajuan_diklat']);

//profil
Route::get('/profil_saya', [App\Http\Controllers\Peserta\halamanProfilController::class, 'profil_saya']);
Route::get('/halaman_tambah_profil', [App\Http\Controllers\Peserta\halamanProfilController::class, 'halaman_tambah_profil']);
Route::post('/simpan_profil', [App\Http\Controllers\Peserta\halamanProfilController::class, 'simpan_profil']);
Route::get('/edit_profil/{email}', [App\Http\Controllers\Peserta\halamanProfilController::class, 'edit_profil']);
Route::post('/ubah_profil/{email}', [App\Http\Controllers\Peserta\halamanProfilController::class, 'ubah_profil']);
