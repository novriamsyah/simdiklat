<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\PengajuanDiklat;
use App\Models\Diklat;
use App\Models\DokumenPengajuan;
use App\Models\JenisDiklat;

class halamanAjuDiklatController extends Controller
{
    public function halaman_pengajuan_diklat()
    {
        $cek_nip = session()->get('nip');
        $datas = DB::table('pengajuan_diklat')
            ->select('pengajuan_diklat.*')
            ->where('pengajuan_diklat.nip_peserta', $cek_nip)
            ->orderBy('pengajuan_diklat.created_at', 'DESC')
            ->get();

        
        if(!session()->has('nip')){
            return redirect()->route('login.peserta');
        } else {
            return view('peserta.pengajuan_diklat.halaman_pengajuan_diklat', ['datas'=>$datas]);
        }
        
    }

    public function lihat_pengajuan_diklat($id)
    {
        $data = PengajuanDiklat::find($id);
        return response()->json($data);
    }

    public function detail_pengajuan_diklat($id)
    {
        if(!session()->has('nip')){
            return redirect()->route('login.peserta');
        } else {
            $cek_nip = session()->get('nip');
            $datas2 = DB::table('peserta')
            ->where('nip', $cek_nip)
            ->first();

            $id_opd = $datas2->opd_id;
            $opd = DB::table('opd')
            ->where('id', $id_opd)
            ->first();

            $datas = DB::table('pengajuan_diklat')
            ->select('pengajuan_diklat.*')
            ->where('pengajuan_diklat.id', $id)
            ->first();

            $id_jenis_diklat = $datas->id_jenis_diklat;
            $jenis_diklat = DB::table('jenis_diklat')
            ->where('id', $id_jenis_diklat)
            ->first();

            // dd($datas);
            return view('peserta.pengajuan_diklat.lihat_pengajuan_diklat', ['cek_nip'=>$cek_nip, 'datas2'=>$datas2, 'opd'=>$opd, 'datas'=>$datas, 'jenis_diklat'=>$jenis_diklat]);
        }
    }

    public function tambah_pengajuan_diklat()
    {
        if(!session()->has('nip')){
            return redirect()->route('login.peserta');
        } else {
            $jenis_diklat = JenisDiklat::all();
            return view('peserta.pengajuan_diklat.tambah_pengajuan_diklat', ['jenis_diklat'=>$jenis_diklat]);
        }
    }

    public function simpan_pengajuan_diklat(Request $req)
    {
            $this->validate($req, [
                'sertifikat' => 'required|file|mimes:pdf,png,jpg,jpeg',
            ]);

            // dd($req->all());

            $cek_nip = session()->get('nip');
            $status_default = "0";

            $file_doc1 = $req->file('sertifikat');
            // dd($file_doc1);
            $file_doc1->storeAs('public/dokumen_pengajuan', $file_doc1->hashName());

            $dt_pengajuan_diklat = new PengajuanDiklat;
            $dt_pengajuan_diklat->nama_diklat = $req->nama_diklat;
            $dt_pengajuan_diklat->tempat_diklat = $req->tempat_diklat;
            $dt_pengajuan_diklat->jp = $req->jp;
            $dt_pengajuan_diklat->id_jenis_diklat = $req->id_jenis_diklat;
            $dt_pengajuan_diklat->angkatan = $req->angkatan;
            $dt_pengajuan_diklat->tahun = $req->tahun;
            $dt_pengajuan_diklat->nip_peserta = $cek_nip;
            $dt_pengajuan_diklat->status = $status_default;
            $dt_pengajuan_diklat->sertifikat = $file_doc1->hashName();
            $dt_pengajuan_diklat->tanggal_daftar = Carbon::createFromFormat('m/d/Y',$req->tanggal_daftar)->format('Y-m-d');
            $simpan = $dt_pengajuan_diklat->save();
            
            if($simpan) {
                Session::flash('berhasil', 'Anda berhasil mendaftarkan pengajuan diklat SIDEISEL');
                return redirect('/halaman_pengajuan_diklat');
            } else {
                Session::flash('gagal', 'pengajuan diklat anda gagal');
                return redirect()->back();
            }
    }

    public function edit_pengajuan_diklat_saya($id)
    {
        if(!session()->has('nip')){
            return redirect()->route('login.peserta');
        } else {
            $data = PengajuanDiklat::find($id);
            $jenis_diklat = JenisDiklat::all();
            return view('peserta.pengajuan_diklat.edit_pengajuan_diklat', ['jenis_diklat'=>$jenis_diklat, 'data'=>$data, 'id'=>$id]);
        }
    }

    public function ubah_pengajuan_diklat_saya(Request $req, $id)
    {
        $this->validate($req, [
            'sertifikat' => 'file|mimes:pdf,png,jpg,jpeg',
        ]);

        $dt_sertif = PengajuanDiklat::find($id);
        $cek_nip = session()->get('nip');
        $status_default = "0";

        if($req->file('sertifikat') == "")
        {
            $dt_sertif->update([
                'nama_diklat' => $req->nama_diklat,
                'tempat_diklat' => $req->tempat_diklat,
                'jp' => $req->jp,
                'id_jenis_diklat' => $req->id_jenis_diklat,
                'angkatan' => $req->angkatan,
                'tahun' => $req->tahun,
                'nip_peserta' => $cek_nip,
                'status' => $status_default,
                'tanggal_daftar' => Carbon::createFromFormat('m/d/Y',$req->tanggal_daftar)->format('Y-m-d'),
            ]);
        } else {
            Storage::disk('local')->delete('public/dokumen_pengajuan/'.$dt_sertif->sertifikat);

            $file_doc = $req->file('sertifikat');
            $file_doc->storeAs('public/dokumen_pengajuan', $file_doc->hashName());
            $dt_sertif->update([
                'nama_diklat' => $req->nama_diklat,
                'tempat_diklat' => $req->tempat_diklat,
                'jp' => $req->jp,
                'id_jenis_diklat' => $req->id_jenis_diklat,
                'angkatan' => $req->angkatan,
                'tahun' => $req->tahun,
                'nip_peserta' => $cek_nip,
                'status' => $status_default,
                'tanggal_daftar' => Carbon::createFromFormat('m/d/Y',$req->tanggal_daftar)->format('Y-m-d'),
                'sertifikat'  => $file_doc->hashName(),
            ]);
        }
            if($dt_sertif) {
                Session::flash('diubah', 'Data pengajuan diklat berhasil diubah');
                return redirect('/halaman_pengajuan_diklat');

            } else {
                Session::flash('gagal', 'Data pengajuan diklat gagal diubah');
                return redirect()->back();
            } 

        
    }

    public function upl_pengajuan_doc($id)
    {
        if(!session()->has('nip')){
            return redirect()->route('login.peserta');
        } else {
            $cek_nip = session()->get('nip');
            $datas2 = DB::table('peserta')
            ->where('nip', $cek_nip)
            ->first();

            $id_opd = $datas2->opd_id;
            $opd = DB::table('opd')
            ->where('id', $id_opd)
            ->first();

            $datas = DB::table('pengajuan_diklat')
            ->select('pengajuan_diklat.*')
            ->where('pengajuan_diklat.id', $id)
            ->first();

            $id_jenis_diklat = $datas->id_jenis_diklat;
            $jenis_diklat = DB::table('jenis_diklat')
            ->where('id', $id_jenis_diklat)
            ->first();

            // dd($datas);
            return view('peserta.pengajuan_diklat.dokumen_pengajuan_diklat', ['cek_nip'=>$cek_nip, 'datas2'=>$datas2, 'opd'=>$opd, 'datas'=>$datas, 'jenis_diklat'=>$jenis_diklat, 'id'=>$id]);
        }
    }

    public function proses_upl_pengajuan_doc(Request $req)
    {
        $this->validate($req, [
            'dokumen' => 'required|file|mimes:pdf',
        ]);

        $status_default = "0";

        $file_doc3 = $req->file('dokumen');
        $file_doc3->storeAs('public/dokumen_pengajuan', $file_doc3->hashName());

        $dt_doc_pengajuan_diklat = new DokumenPengajuan;
        $dt_doc_pengajuan_diklat->id_pengajuan =  $req->id_pengajuan;
        $dt_doc_pengajuan_diklat->cek = $status_default;
        $dt_doc_pengajuan_diklat->dokumen = $file_doc3->hashName();
        $simpan = $dt_doc_pengajuan_diklat->save();
        
        if($simpan) {
            Session::flash('berhasil', 'Anda berhasil menambahkan dokumen pengajuan diklat SIDEISEL');
            return redirect('/halaman_pengajuan_diklat');
        } else {
            Session::flash('gagal', 'Dokumen pengajuan diklat anda gagal');
            return redirect()->back();
        }
    }


    public function hapus_pengajuan_diklat($id)
    {
        $daftar_diklat = PengajuanDiklat::where('id', $id)->delete();
        
         if($daftar_diklat == 1) {
             $success = true;
             $message = "Pengajuan diklat anda berhasil dihapus !";
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