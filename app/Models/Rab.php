<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rab extends Model
{
    protected $casts = [
        'uraian_kegiatan_biaya_langsung_personal' => 'array',
        'uraian_kegiatan_biaya_langsung_non_personal' => 'array',
    ];

    protected $fillable = [
        'pekerjaan',
        'lokasi',
        'masa_pelaksanaan',
        'sumber_dana',
        'uraian_kegiatan_biaya_langsung_personal',
        'uraian_kegiatan_biaya_langsung_non_personal',
        'jumlah_biaya_langsung_personal',
        'jumlah_biaya_langsung_non_personal',
        'nama_penyedia',
        'nama_perusahaan_penyedia',
        'jabatan_penyedia',
        'nama_pejabat_penandatangan_kontrak',
        'jabatan_pejabat',
        'nip_pejabat'
    ];
}