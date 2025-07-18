<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $fillable = [
        'judul_surat', 'jenis_dokumen', 'jenis_surat', 'file_belum_ttd', 'file_sudah_ttd','file_excel','file_world','file_csv'
    ];
}
