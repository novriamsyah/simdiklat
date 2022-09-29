<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;
    protected $table = 'master_dokumen';
    protected $fillable = [
        'master_dokumen',
        'file_dokumen',
    ];
}
