<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database.
     *
     * @var string
     */
    protected $table = 'master';

    /**
     * Kolom yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'uraian',
        'nomor_berita_acara',
        'tanggal',
        'data_organisasi',
        'keterangan_organisasi',
        'data_paket',
        'keterangan_data_paket',
        'pejabat_pengadaan',
        'keterangan_pengadaan',
        'pejabat_pembuat_komitmen',
        'keterangan_komitmen',
        'data_calon_penyedia',
        'keterangan_penyedia',
        'jenis_surat',
    ];

    /**
     * Kolom yang di-cast sebagai tipe data tertentu.
     *
     * @var array
     */
    protected $casts = [
        'uraian' => 'array',
        'nomor_berita_acara' => 'array',
        'tanggal' => 'array',
        'data_organisasi' => 'array',
        'keterangan_organisasi' => 'array',
        'data_paket' => 'array',
        'keterangan_data_paket' => 'array',
        'pejabat_pengadaan' => 'array',
        'keterangan_pengadaan' => 'array',
        'pejabat_pembuat_komitmen' => 'array',
        'keterangan_komitmen' => 'array',
        'data_calon_penyedia' => 'array',
        'keterangan_penyedia' => 'array',
        
    ];
}
