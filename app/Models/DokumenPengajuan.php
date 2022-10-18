<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPengajuan extends Model
{
    use HasFactory;
    protected $table = 'dokumen_pengajuan';
    protected $fillable = [
        'dokumen',
        'id_pengajuan',
        'catatan',
        'cek',
        
    ];
}
