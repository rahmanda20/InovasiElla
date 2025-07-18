<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateSurat extends Model {
    protected $fillable = ['jenis_surat', 'file_path', 'is_active'];
}

