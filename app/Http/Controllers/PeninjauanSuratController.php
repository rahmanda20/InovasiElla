<?php

// app/Http/Controllers/PeninjauanSuratController.php
namespace App\Http\Controllers;

use App\Models\PeninjauanSurat;
use Illuminate\Http\Request;

class PeninjauanSuratController extends Controller
{
    public function index()
    {
        $surats = PeninjauanSurat::latest()->get();
        return view('peninjauan.index', compact('surats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file_tanpa_ttd' => 'required|file|mimes:pdf,docx,xlsx',
            'file_dengan_ttd' => 'required|file|mimes:pdf,docx,xlsx',
        ]);

        $file1 = $request->file('file_tanpa_ttd');
        $file2 = $request->file('file_dengan_ttd');

        $judul = pathinfo($file1->getClientOriginalName(), PATHINFO_FILENAME);

        $path1 = $file1->store('surat/peninjauan', 'public');
        $path2 = $file2->store('surat/peninjauan', 'public');

        PeninjauanSurat::create([
            'judul' => $judul,
            'file_tanpa_ttd' => $path1,
            'file_dengan_ttd' => $path2,
        ]);

        return back()->with('success', 'Surat berhasil diunggah dan ditinjau.');
    }

    public function uploadTTD(Request $request, $id)
    {
        $request->validate([
            'file_dengan_ttd' => 'required|file|mimes:pdf,docx,xlsx',
        ]);

        $surat = PeninjauanSurat::findOrFail($id);
        $path = $request->file('file_dengan_ttd')->store('surat/peninjauan', 'public');

        $surat->update([
            'file_dengan_ttd' => $path,
        ]);

        return back()->with('success', 'File dengan tanda tangan berhasil diunggah ulang.');
    }
}
