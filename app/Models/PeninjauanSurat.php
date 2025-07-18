<?php

// app/Models/PeninjauanSurat.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeninjauanSurat extends Model
{
    protected $table = 'peninjauan_surat';
    protected $fillable = ['judul', 'file_tanpa_ttd', 'file_dengan_ttd'];
}
