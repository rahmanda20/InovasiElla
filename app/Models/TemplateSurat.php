<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateSurat extends Model
{
    use HasFactory;

    protected $table = 'template_surats'; // pastikan sesuai dengan nama tabel di database

    protected $fillable = [
    'jenis_surat',
    'judul_surat',
    'file_path',
    'is_active',
    'created_by',
];
public function creator()
{
    return $this->belongsTo(User::class, 'created_by');
}

}
