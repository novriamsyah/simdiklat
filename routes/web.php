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
    
    Route::get('/halaman_user', [App\Http\Controllers\HalamanUserController::class, 'halaman_user']);
    Route::get('/halaman_tambah_user', [App\Http\Controllers\HalamanUserController::class, 'halaman_tambah_user']);
    Route::post('/simpan_user', [App\Http\Controllers\HalamanUserController::class, 'simpan_user']);
    Route::get('/edit_user/{id}', [App\Http\Controllers\HalamanUserController::class, 'edit_user']);
    Route::post('/ubah_user/{id}', [App\Http\Controllers\HalamanUserController::class, 'ubah_user']);
    Route::post('/hapus_user/{id}', [App\Http\Controllers\HalamanUserController::class, 'hapus_user']);

});

Route::group(['middleware' => ['auth', 'cekrole:Admin,Operator,Peserta']], function(){

    //index
    Route::get('/admin', [App\Http\Controllers\HalamanAdminController::class, 'admin']);
    Route::post('/pdf_laporan_diklat', [App\Http\Controllers\HalamanAdminController::class, 'pdf_laporan_diklat']);
    //kelola profil
    Route::get('/kelola_profil', [App\Http\Controllers\HalamanUserController::class, 'kelola_profil']);
    Route::post('/update_profil', [App\Http\Controllers\HalamanUserController::class, 'update_profil']);
    Route::post('/ubah_password/{id}', [App\Http\Controllers\HalamanUserController::class, 'ubah_password']);

    //master opd
    Route::get('/halaman_opd', [App\Http\Controllers\HalamanOpdController::class, 'halaman_opd']);
    Route::get('/halaman_tambah_opd', [App\Http\Controllers\HalamanOpdController::class, 'halaman_tambah_opd']);
    Route::post('/simpan_opd', [App\Http\Controllers\HalamanOpdController::class, 'simpan_opd']);
    Route::get('/edit_opd/{id}', [App\Http\Controllers\HalamanOpdController::class, 'edit_opd']);
    Route::post('/ubah_opd/{id}', [App\Http\Controllers\HalamanOpdController::class, 'ubah_opd']);
    Route::post('/hapus_opd/{id}', [App\Http\Controllers\HalamanOpdController::class, 'hapus_opd']);

    //master dokumen
    Route::get('/halaman_dokumen', [App\Http\Controllers\HalamanDokumenController::class, 'halaman_dokumen']);
    Route::get('/lihat_dokumen/{id}', [App\Http\Controllers\HalamanDokumenController::class, 'lihat_dokumen']);
    Route::get('/unduh_dokumen/{id}', [App\Http\Controllers\HalamanDokumenController::class, 'unduh_dokumen']);
    Route::get('/halaman_tambah_dokumen', [App\Http\Controllers\HalamanDokumenController::class, 'halaman_tambah_dokumen']);
    Route::post('/simpan_dokumen', [App\Http\Controllers\HalamanDokumenController::class, 'simpan_dokumen']);
    Route::get('/edit_dokumen/{id}', [App\Http\Controllers\HalamanDokumenController::class, 'edit_dokumen']);
    Route::post('/ubah_dokumen/{id}', [App\Http\Controllers\HalamanDokumenController::class, 'ubah_dokumen']);
    Route::post('/hapus_dokumen/{id}', [App\Http\Controllers\HalamanDokumenController::class, 'hapus_dokumen']);

    //master jenis diklat
    Route::get('/halaman_jenis_diklat', [App\Http\Controllers\HalamanJenisDiklatController::class, 'halaman_jenis_diklat']);
    Route::get('/halaman_tambah_jenis_diklat', [App\Http\Controllers\HalamanJenisDiklatController::class, 'halaman_tambah_jenis_diklat']);
    Route::post('/simpan_jenis_diklat', [App\Http\Controllers\HalamanJenisDiklatController::class, 'simpan_jenis_diklat']);
    Route::get('/edit_jenis_diklat/{id}', [App\Http\Controllers\HalamanJenisDiklatController::class, 'edit_jenis_diklat']);
    Route::post('/ubah_jenis_diklat/{id}', [App\Http\Controllers\HalamanJenisDiklatController::class, 'ubah_jenis_diklat']);
    Route::post('/hapus_jenis_diklat/{id}', [App\Http\Controllers\HalamanJenisDiklatController::class, 'hapus_jenis_diklat']);

    //master diklat
    Route::get('/halaman_diklat', [App\Http\Controllers\HalamanDiklatController::class, 'halaman_diklat']);
    Route::get('/lihat_diklat/{id}', [App\Http\Controllers\HalamanDiklatController::class, 'lihat_diklat']);
    Route::get('/halaman_tambah_diklat', [App\Http\Controllers\HalamanDiklatController::class, 'halaman_tambah_diklat']);
    Route::post('/simpan_diklat', [App\Http\Controllers\HalamanDiklatController::class, 'simpan_diklat']);
    Route::get('/edit_diklat/{id}', [App\Http\Controllers\HalamanDiklatController::class, 'edit_diklat']);
    Route::post('/ubah_diklat/{id}', [App\Http\Controllers\HalamanDiklatController::class, 'ubah_diklat']);
    Route::post('/hapus_diklat/{id}', [App\Http\Controllers\HalamanDiklatController::class, 'hapus_diklat']);

    //diklat riwayat
    Route::get('/halaman_riwayat_diklat', [App\Http\Controllers\HalamanRiwayatDiklatController::class, 'halaman_riwayat_diklat']);
    Route::get('/lihat_sertifikat_rwyt/{id}', [App\Http\Controllers\HalamanRiwayatDiklatController::class, 'lihat_sertifikat_rwyt']);
    Route::get('/detail_pendaftaran_diklat_peserta/{id}', [App\Http\Controllers\HalamanRiwayatDiklatController::class, 'detail_pendaftaran_diklat_peserta']);
    Route::get('/lihat_verifikasi_diklat/{id}', [App\Http\Controllers\HalamanRiwayatDiklatController::class, 'lihat_verifikasi_diklat'])->name('ver_diklat');
    Route::get('/get_edit_daftar/{id}', [App\Http\Controllers\HalamanRiwayatDiklatController::class, 'get_edit_daftar']);
    Route::post('/proses_validasi_daftar/{id}', [App\Http\Controllers\HalamanRiwayatDiklatController::class, 'proses_validasi_daftar']);
    Route::post('/hapus_diklat_riwayatt/{id}', [App\Http\Controllers\HalamanRiwayatDiklatController::class, 'hapus_diklat']);

    //diklat pengajuan
    Route::get('/pengajuan_diklat_peserta', [App\Http\Controllers\HalamanPengajuanDiklatController::class, 'halaman_pengajuan_diklat']);
    Route::get('/lihat_pengajuan_peserta/{id}', [App\Http\Controllers\HalamanPengajuanDiklatController::class, 'lihat_pengajuan_peserta']);
    Route::get('/peserta_doc_pengajuan/{id}', [App\Http\Controllers\HalamanPengajuanDiklatController::class, 'peserta_doc_pengajuan']);
    Route::get('/get_edit_pengajuan/{id}', [App\Http\Controllers\HalamanPengajuanDiklatController::class, 'get_edit_pengajuan']);
    Route::get('/get_dokumen_pengajuan/{id}', [App\Http\Controllers\HalamanPengajuanDiklatController::class, 'get_dokumen_pengajuan']);
    Route::get('/lihat_verifikasi_pengajuan/{id}', [App\Http\Controllers\HalamanPengajuanDiklatController::class, 'lihat_verifikasi_pengajuan'])->name('ver_pengajuan');
    Route::get('/detail_pengajuan_diklat_peserta/{id}', [App\Http\Controllers\HalamanPengajuanDiklatController::class, 'detail_pengajuan_diklat_peserta']);
    Route::post('/proses_validasi_pengajuan/{id}', [App\Http\Controllers\HalamanPengajuanDiklatController::class, 'proses_validasi_pengajuan']);
    Route::post('/proses_validasi_dokumen_peserta/{id}', [App\Http\Controllers\HalamanPengajuanDiklatController::class, 'proses_validasi_dokumen_peserta']);
    Route::post('/validasi_pengajuan_diklat', [App\Http\Controllers\HalamanPengajuanDiklatController::class, 'validasi_pengajuan_diklat']);
    Route::post('/hapus_diklat_pengajuann/{id}', [App\Http\Controllers\HalamanPengajuanDiklatController::class, 'hapus_diklat']);

    //kelola peserta
    Route::get('/halaman_kelola_peserta', [App\Http\Controllers\HalamanPesertaController::class, 'halaman_peserta']);
    Route::get('/halaman_tambah_peserta', [App\Http\Controllers\HalamanPesertaController::class, 'halaman_tambah_user']);
    Route::post('/simpan_peserta', [App\Http\Controllers\HalamanPesertaController::class, 'simpan_peserta']);
    Route::get('/edit_peserta/{id}', [App\Http\Controllers\HalamanPesertaController::class, 'edit_peserta']);
    Route::get('/lihat_peserta/{id}', [App\Http\Controllers\HalamanPesertaController::class, 'lihat_peserta']);
    Route::post('/ubah_data_peserta/{id}', [App\Http\Controllers\HalamanPesertaController::class, 'ubah_peserta']);
    Route::get('/ubah_password_peserta/{nip}', [App\Http\Controllers\HalamanPesertaController::class, 'ubah_password']);
    Route::post('/hapus_peserta/{id}', [App\Http\Controllers\HalamanPesertaController::class, 'hapus_peserta']);
});


//Route untuk peserta

//sistem register dan login
Route::get('/register', [App\Http\Controllers\SistemLoginPesertaController::class, 'register_akun'])->name('register.akun');
Route::post('/proses_register', [App\Http\Controllers\SistemLoginPesertaController::class, 'proses_register'])->name('proses.register');
Route::get('/login', [App\Http\Controllers\SistemLoginPesertaController::class, 'halaman_login'])->name('login.peserta');
Route::post('/verifikasilogin', [App\Http\Controllers\SistemLoginPesertaController::class, 'loginVerifikasi'])->name('verifikasi.login');
Route::get('/log_out', [App\Http\Controllers\SistemLoginPesertaController::class, 'log_out'])->name('logout.peserta');

//forgot password
Route::get('/forget-password-peserta', [App\Http\Controllers\Peserta\ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.peserta');
Route::post('/proses-forget-password-peserta', [App\Http\Controllers\Peserta\ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post.peserta'); 
Route::get('/reset-password-peserta/{token}', [App\Http\Controllers\Peserta\ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.peserta');
Route::post('/reset-password-peserta', [App\Http\Controllers\Peserta\ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post.peserta');

//dashboard
Route::get('/', [App\Http\Controllers\HalamanDashboardController::class, 'index'])->name('dash.peserta');
Route::get('/dashboard_list_diklat/{id}', [App\Http\Controllers\HalamanDashboardController::class, 'dashboard_list_diklat']);
Route::get('/tambah_diklat_baru/{id}', [App\Http\Controllers\HalamanDashboardController::class, 'tambah_diklat_baru']);

//list Diklat
Route::get('/halaman_list_diklat', [App\Http\Controllers\Peserta\HalamanListDiklatController::class, 'halaman_list_diklat']);
Route::get('/lihat_list_diklat/{id}', [App\Http\Controllers\Peserta\HalamanListDiklatController::class, 'lihat_list_diklat']);


//daftar diklat
Route::get('/halaman_daftar_diklat', [App\Http\Controllers\Peserta\HalamanDaftarDiklatController::class, 'halaman_daftar_diklat']);
Route::get('/lihat_daftar_diklat/{id}', [App\Http\Controllers\Peserta\HalamanDaftarDiklatController::class, 'lihat_daftar_diklat']);
Route::get('/tambah_daftar_diklat', [App\Http\Controllers\Peserta\HalamanDaftarDiklatController::class, 'tambah_daftar_diklat']);
Route::post('/simpan_daftar_diklat', [App\Http\Controllers\Peserta\HalamanDaftarDiklatController::class, 'simpan_daftar_diklat']);
Route::get('/upload_dokumen_saya/{id}', [App\Http\Controllers\Peserta\HalamanDaftarDiklatController::class, 'upload_dokumen_saya']);
Route::post('/proses/upload_dokumen_saya', [App\Http\Controllers\Peserta\HalamanDaftarDiklatController::class, 'proses_upload_dokumen_saya'])->name('proses_dokumen_saya');
Route::get('/edit_dokumen_daftar/{id}', [App\Http\Controllers\Peserta\HalamanDaftarDiklatController::class, 'edit_dokumen_daftar']);
Route::post('/proses/edit_dokumen_daftar/{id}', [App\Http\Controllers\Peserta\HalamanDaftarDiklatController::class, 'proses_edit_dokumen_daftar'])->name('proses_edit_dokumen_daftar');
Route::get('/get_upload_sertifikat/{id}', [App\Http\Controllers\Peserta\HalamanDaftarDiklatController::class, 'get_upload_sertifikat']);
Route::post('/upload_sertifikat/{id}', [App\Http\Controllers\Peserta\HalamanDaftarDiklatController::class, 'upload_sertifikat']);
Route::get('/lihat_sertifikat_daftar/{id}', [App\Http\Controllers\Peserta\HalamanDaftarDiklatController::class, 'lihat_sertifikat_daftar']);
Route::get('/lihat_catatan_daftar/{id}', [App\Http\Controllers\Peserta\HalamanDaftarDiklatController::class, 'lihat_catatan_daftar']);
Route::get('/get_ubah_dokumen_daftar/{id}', [App\Http\Controllers\Peserta\HalamanDaftarDiklatController::class, 'get_ubah_dokumen_daftar']);
Route::post('/ubah_doc_daftar_peserta/{id}', [App\Http\Controllers\Peserta\HalamanDaftarDiklatController::class, 'ubah_doc_daftar_peserta']);
Route::post('/hapus_daftar_diklat/{id}', [App\Http\Controllers\Peserta\HalamanDaftarDiklatController::class, 'hapus_daftar_diklat']);

//pengajuan Diklat
Route::get('/halaman_pengajuan_diklat', [App\Http\Controllers\Peserta\HalamanAjuDiklatController::class, 'halaman_pengajuan_diklat']);
Route::get('/lihat_pengajuan_diklat/{id}', [App\Http\Controllers\Peserta\HalamanAjuDiklatController::class, 'lihat_pengajuan_diklat']);
Route::get('/detail_pengajuan_diklat/{id}', [App\Http\Controllers\Peserta\HalamanAjuDiklatController::class, 'detail_pengajuan_diklat']);
Route::get('/tambah_pengajuan_diklat', [App\Http\Controllers\Peserta\HalamanAjuDiklatController::class, 'tambah_pengajuan_diklat']);
Route::post('/simpan_pengajuan_diklat', [App\Http\Controllers\Peserta\HalamanAjuDiklatController::class, 'simpan_pengajuan_diklat']);
Route::get('/edit_pengajuan_diklat_saya/{id}', [App\Http\Controllers\Peserta\HalamanAjuDiklatController::class, 'edit_pengajuan_diklat_saya']);
Route::post('/ubah_pengajuan_diklat_saya/{id}', [App\Http\Controllers\Peserta\HalamanAjuDiklatController::class, 'ubah_pengajuan_diklat_saya']);
Route::get('/get_sertifikat_ajuan/{id}', [App\Http\Controllers\Peserta\HalamanAjuDiklatController::class, 'get_upload_sertifikat']);
Route::post('/upload_sertifikat_ajuan/{id}', [App\Http\Controllers\Peserta\HalamanAjuDiklatController::class, 'upload_sertifikat']);
Route::get('/upl_pengajuan_doc/{id}', [App\Http\Controllers\Peserta\HalamanAjuDiklatController::class, 'upl_pengajuan_doc']);
Route::post('/proses/upl_pengajuan_doc/', [App\Http\Controllers\Peserta\HalamanAjuDiklatController::class, 'proses_upl_pengajuan_doc'])->name('upl_pengajuan_doc');
Route::get('/lihat_catatan_pengajuan/{id}', [App\Http\Controllers\Peserta\HalamanAjuDiklatController::class, 'lihat_catatan_pengajuan']);
Route::get('/edit_dokumen_pengajuan/{id}', [App\Http\Controllers\Peserta\HalamanAjuDiklatController::class, 'edit_dokumen_pengajuan']);
Route::get('/get_ubah_dokumen_pengajuan/{id}', [App\Http\Controllers\Peserta\HalamanAjuDiklatController::class, 'get_ubah_dokumen_pengajuan']);
Route::post('/ubah_doc_pengajuan_peserta/{id}', [App\Http\Controllers\Peserta\HalamanAjuDiklatController::class, 'ubah_doc_pengajuan_peserta']);
Route::post('/hapus_pengajuan_diklat/{id}', [App\Http\Controllers\Peserta\HalamanAjuDiklatController::class, 'hapus_pengajuan_diklat']);

//profil
Route::get('/profil_saya', [App\Http\Controllers\Peserta\HalamanProfilController::class, 'profil_saya']);
Route::get('/halaman_tambah_profil', [App\Http\Controllers\Peserta\HalamanProfilController::class, 'halaman_tambah_profil']);
Route::post('/simpan_profil', [App\Http\Controllers\Peserta\HalamanProfilController::class, 'simpan_profil']);
Route::get('/edit_profil/{email}', [App\Http\Controllers\Peserta\HalamanProfilController::class, 'edit_profil']);
Route::post('/ubah_profil/{email}', [App\Http\Controllers\Peserta\HalamanProfilController::class, 'ubah_profil']);
Route::get('/peserta/kelola_profil/', [App\Http\Controllers\Peserta\HalamanProfilController::class, 'kelola_profil']);
Route::post('/ubah_password_peserta/{email}', [App\Http\Controllers\Peserta\HalamanProfilController::class, 'ubah_password']);
