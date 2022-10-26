<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\DaftarDiklat;
use App\Models\Diklat;
use App\Models\Dokumen;
use App\Models\DokumenDaftar;


class HalamanDaftarDiklatController extends Controller
{
    public function halaman_daftar_diklat()
    {

        if(!session()->has('nip')){
            return redirect()->route('login.peserta');
        } else {
            $cek_nip = session()->get('nip');
            $datas = DB::table('daftar_diklat')
            ->select('daftar_diklat.*', 'diklat.nama_diklat')
            ->join('diklat', 'diklat.id', '=','daftar_diklat.id_diklat')
            ->where('daftar_diklat.nip_peserta', $cek_nip)
            ->orderBy('daftar_diklat.created_at', 'DESC')
            ->get();
            return view('peserta.daftar_diklat.halaman_daftar_diklat', ['datas'=>$datas]);
        }
        
    }

    public function lihat_daftar_diklat($id)
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

            $datas = DB::table('daftar_diklat')
            ->select('daftar_diklat.*', 'diklat.*')
            ->join('diklat', 'diklat.id', '=','daftar_diklat.id_diklat')
            ->where('daftar_diklat.id', $id)
            ->where('daftar_diklat.nip_peserta', $cek_nip)
            ->first();

            $id_jenis_diklat = $datas->id_jenis_diklat;
            $tgll = $datas->mulai_pendaftaran;
            $tgl = Carbon::createFromFormat('Y-m-d',$tgll)->format('d F Y');
            $jenis_diklat = DB::table('jenis_diklat')
            ->where('id', $id_jenis_diklat)
            ->first();

            $dkmn =  DB::table('dokumen')
            ->select('dokumen.*')
            ->where('id_daftar_diklat', $id)
            ->get();
        
            $ct_dkmn =  DB::table('dokumen')
            ->select('dokumen.*')
            ->where('id_daftar_diklat', $id)
            ->count();

            return view('peserta.daftar_diklat.lihat_daftar_diklat', ['cek_nip'=>$cek_nip, 'datas2'=>$datas2, 'opd'=>$opd, 'datas'=>$datas, 'jenis_diklat'=>$jenis_diklat, 'tgl'=>$tgl,'dkmn'=>$dkmn, 'ct_dkmn'=>$ct_dkmn]);
        }
    }

    public function tambah_daftar_diklat()
    {
        if(!session()->has('nip')){
            return redirect()->route('login.peserta');
        } else {
            $cek_nip = session()->get('nip');
            $datas = DB::table('peserta')
            ->where('nip', $cek_nip)
            ->first();

            $id_opd = $datas->opd_id;
            $opd = DB::table('opd')
            ->where('id', $id_opd)
            ->first();

            $diklat = Diklat::all();

            return view('peserta.daftar_diklat.tambah_daftar_diklat', ['cek_nip'=>$cek_nip, 'datas'=>$datas, 'opd'=>$opd, 'diklat'=>$diklat]);
        }
    }

    public function simpan_daftar_diklat(Request $req)
    {
        $cek_id_diklat = DaftarDiklat::where('id_diklat', '=', $req->id_diklat)->count();
        if($cek_id_diklat >= 1) {
            Session::flash('fail_daftar', 'diklat telah Teredaftar');
            return redirect('/tambah_daftar_diklat');
        } else {
            $tgl_now = Carbon::now();
            $cek_nip = session()->get('nip');
            $status_default = "0";

            $dt_daftar_diklat = new DaftarDiklat;
            $dt_daftar_diklat->id_diklat = $req->id_diklat;
            $dt_daftar_diklat->nip_peserta = $cek_nip;
            $dt_daftar_diklat->tanggal_daftar = $tgl_now ;
            $dt_daftar_diklat->status = $status_default;
            $simpan = $dt_daftar_diklat->save();
            
            if($simpan) {
                Session::flash('berhasil', 'Anda berhasil mendaftarkan diklat SIDEISEL');
                return redirect('/halaman_daftar_diklat');
            } else {
                Session::flash('gagal', 'Pendaftaran diklat anda gagal');
                return redirect()->back();
            }
        }
        
    }


    public function upload_dokumen_saya($id)
    {
        if(!session()->has('nip')){
            return redirect()->route('login.peserta');
        } else {

            // $dokumen = Dokumen::all();
            $dokumen = DB::table('master_dokumen')
                ->select('master_dokumen.*')
                ->orderBy('created_at', 'DESC')
                ->get();
            $status = "0";
            $id_daftar = $id;

            return view('peserta.daftar_diklat.tambah_dokumen_diklat', ['id'=>$id,'dokumen'=>$dokumen, 'status'=>$status, 'id_daftar'=>$id_daftar]);
        }
    }

    public function proses_upload_dokumen_saya(Request $request)
    {
        // dd($request->all());
        // $this->validate($request, [
        //     'dokumens.*' => 'required|mimes:pdf,jpg,jpeg,png'
        // ]);
        $validator = Validator::make($request->all(), [
            'dokumens'   => 'required',
            'dokumens.*' => 'required|mimes:pdf,jpg,jpeg,png',
        ]);

        $get_id = $request->get('id_daftars');
        $get_cek = $request->get('ceks');
        $nama_doc = $request->get('nm_dokumens');
        $tgl = Carbon::now();
        $tgl_in = $tgl->toDateTimeString();
        $files = [];

        if($request->hasfile('dokumens'))
        {
            foreach($request->file('dokumens') as $i => $file)
            {
                $name = time().rand(1,100).'.'.$file->extension();
                $file->storeAs('public/dokumen', $name);
                $files[] = array(
                    'dokumen' => $name,
                    'nm_dokumen'=>$nama_doc[$i],
                    'cek' => $get_cek[$i],
                    'id_daftar_diklat' => $get_id[$i],
                    'created_at'    => $tgl_in,
                ); 
            }
            // dd($files);
            $simpan = DB::table('dokumen')->insert($files);

            if($simpan) {
                Session::flash('berhasil', 'Anda berhasil menambahkan dokumen');
                return redirect('/halaman_daftar_diklat');
            } else {
                Session::flash('gagal', 'dokumen diklat anda gagal');
                return redirect()->back();
            }
        }     
        
    }

    public function edit_dokumen_daftar($id)
    {
        if(!session()->has('nip')){
            return redirect()->route('login.peserta');
        } else {

            // $dokumen = Dokumen::all();
            $dokumen = DB::table('dokumen')
                ->select('dokumen.*')
                ->where('id_daftar_diklat', $id)
                ->orderBy('created_at', 'DESC')
                ->get();
            // dd($dokumen);
            return view('peserta.daftar_diklat.edit_dokumen_diklat', ['id'=>$id,'dokumen'=>$dokumen]);
        }
    }

    public function get_upload_sertifikat($id)
    {
        // $datas = DaftarDiklat::find($id);
        $datas =  DB::table('daftar_diklat')
        ->select('daftar_diklat.*')
        ->where('id', $id)
        ->first();
        //return response
        return response()->json([
            'success' => true,
            'data'    => $datas  
        ]); 
    }

    public function upload_sertifikat(Request $request, $id)
    {
        // $validator = Validator::make($request->all(), [
        //     'status'     => 'required',
        // ]);
        $fileName = '';
        $datas = DaftarDiklat::find($id);

        if($request->hasFile('sertifikat')) 
        {
            $file = $request->file('sertifikat');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('public/sertifikat', $fileName);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data sertifikat gagal disimpan'
            ]);
        }

        //create post
        $datas->update([
            'sertifikat' => $fileName
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data sertifikat berhasil disimpan',
            'data'    => $datas,
            'fileName'   => $fileName
        ]);
    }

    public function lihat_sertifikat_daftar($id)
    {
        $data = DaftarDiklat::find($id);
        return response()->json($data);
    }

    public function lihat_catatan_daftar($id)
    {
        $data = DaftarDiklat::find($id);
        return response()->json($data);
    }

    public function get_ubah_dokumen_daftar($id)
    {
        // $datas = DaftarDiklat::find($id);
        $datas = DB::table('dokumen')
        ->select('dokumen.*')
        ->where('id', $id)
        ->first();
        //return response
        return response()->json([
            'success' => true,
            'data'    => $datas  
        ]); 
    }

    public function ubah_doc_daftar_peserta(Request $request, $id)
    {
        // $validator = Validator::make($request->all(), [
        //     'status'     => 'required',
        // ]);
        $fileName = '';
        $datas = DokumenDaftar::find($id);

        if($request->hasFile('dokumen')) 
        {
            Storage::disk('local')->delete('public/dokumen/'.$datas->dokumen);
            $file = $request->file('dokumen');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('public/dokumen', $fileName);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Edit data dokumen gagal disimpan'
            ]);
        }

        //create post
        DB::table('dokumen')->where('id', $id)->update([
            'dokumen' => $fileName
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Edit data dokumen berhasil disimpan',
            'data'    => $datas,
            'fileName'   => $fileName
        ]);
    }

    public function hapus_daftar_diklat($id)
    {
        $daftar_diklat = DaftarDiklat::where('id', $id)->delete();
        
         if($daftar_diklat == 1) {
             $success = true;
             $message = "Data diklat anda berhasil dihapus !";
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
