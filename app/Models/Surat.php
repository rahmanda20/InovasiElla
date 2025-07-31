<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_surat',
        'jenis_dokumen',
        'jenis_surat',
        'file_belum_ttd',
        'file_sudah_ttd',
        'file_excel',
        'file_world',
        'file_csv',
        'nomor_surat',
        'created_by',
    ];

    // Opsional jika ingin relasi ke model User
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
