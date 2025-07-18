<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengawasanController extends Controller
{
    public function DokumenPengadaan()
    {
        return view('Pengawasan.DokumenPengadaan');
    }

    public function DokumenKontrak()
    {
        return view('Pengawasan.DokumenKontrak');
    }

    public function Rekapan()
    {
        return view('Pengawasan.Rekapan');
    }
}
