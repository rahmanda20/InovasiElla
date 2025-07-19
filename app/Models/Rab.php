<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rab extends Model
{
    protected $casts = [
        'uraian_kegiatan_biaya_langsung_personal' => 'array',
        'uraian_kegiatan_biaya_langsung_non_personal' => 'array',
        'biaya_langsung_personil_profesional_staf' => 'array',
        'biaya_langsung_personil_tenaga_ahli_sub_profesional' => 'array',
        'biaya_langsung_personil_tenaga_pendukung' => 'array',
        'biaya_langsung_non_personil_biaya_operasional_kantor' => 'array',
        'biaya_perjalanan_dinas' => 'array',
        'depresiasi' => 'array',
        'biaya_pelaporan' => 'array'
    ];

    protected $fillable = [
        'pekerjaan',
        'lokasi',
        'masa_pelaksanaan',
        'sumber_dana',
        'uraian_kegiatan_biaya_langsung_personal',
        'uraian_kegiatan_biaya_langsung_non_personal',
        'biaya_langsung_personil_profesional_staf',
        'biaya_langsung_personil_tenaga_ahli_sub_profesional',
        'biaya_langsung_personil_tenaga_pendukung',
        'biaya_langsung_non_personil_biaya_operasional_kantor',
        'biaya_perjalanan_dinas',
        'depresiasi',
        'biaya_pelaporan',
        'jumlah_biaya_langsung_personil_profesional_staf',
        'jumlah_biaya_langsung_personil_tenaga_ahli_sub_profesional',
        'jumlah_biaya_langsung_personil_tenaga_pendukung',
        'jumlah_biaya_langsung_non_personil_biaya_operasional_kantor',
        'jumlah_biaya_perjalanan_dinas',
        'jumlah_depresiasi',
        'jumlah_biaya_pelaporan',
        'jumlah_biaya_langsung_personal',
        'jumlah_biaya_langsung_non_personal',
        'total_keseluruhan',
        'ppn',
        'nama_penyedia',
        'nama_perusahaan_penyedia',
        'jabatan_penyedia',
        'nama_pejabat_penandatangan_kontrak',
        'jabatan_pejabat',
        'nip_pejabat',
        'terbilang'
    ];
}