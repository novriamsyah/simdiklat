<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanDiklat extends Model
{
    use HasFactory;
    protected $table = 'pengajuan_diklat';
    protected $fillable = [
        'nama_diklat',
        'jp',
        'angkatan',
        'tahun',
        'tempat_diklat',
        'sertifikat',
        'catatan',
        'status',
        'tanggal_daftar',
        'id_jenis_diklat',
        'nip_peserta',
    ];
}
