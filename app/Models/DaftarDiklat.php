<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarDiklat extends Model
{
    use HasFactory;
    protected $table = 'daftar_diklat';
    protected $fillable = [
        'id_diklat',
        'nip_peserta',
        'tanggal_daftar',
        'status',
        'sertifikat',
        'catatan'
    ];
}
