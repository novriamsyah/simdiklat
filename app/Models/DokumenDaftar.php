<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenDaftar extends Model
{
    use HasFactory;
    protected $table = 'dokumen';
    protected $fillable = [
        'dokumen',
        'id_daftar_diklat',
        'catatan',
        'cek',
        
    ];
}
