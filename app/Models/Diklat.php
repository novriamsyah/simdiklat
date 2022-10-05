<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diklat extends Model
{
    use HasFactory;

    protected $table = 'diklat';
    protected $fillable = [
        'nama_diklat',
        'jp',
        'angkatan',
        'tahun',
        'tempat_diklat',
        'mulai_pendaftaran',
        'selesai_pendaftaran',
        'mulai_pelakasanaan',
        'selesai_pelakasanaan',
        'batas_upload',
        'id_jenis_diklat'
    ];
            
}
