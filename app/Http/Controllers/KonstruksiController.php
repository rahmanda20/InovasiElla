<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KonstruksiController extends Controller
{
    public function DokumenPengadaan()
    {
        return view('Konstruksi.DokumenPengadaan');
    }

    public function DokumenKontrak()
    {
        return view('Konstruksi.DokumenKontrak');
    }

    public function Rekapan()
    {
        return view('Konstruksi.Rekapan');
    }
}
