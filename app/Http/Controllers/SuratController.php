<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\TemplateSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SuratController extends Controller
{
    // Menampilkan daftar semua surat
    public function index()
    {
        $surats = Surat::latest()->get();
        return view('dokumen.index', compact('surats'));
    }

    // Menampilkan pilihan jenis surat
  public function pilihJenis($jenis)
{
    $suratOptions = [
        ['slug' => 'sppbj', 'nama' => 'Surat Penunjukan Penyedia Barang Jasa (SPPBJ)', 'deskripsi' => 'Menampilkan diagram .', 'ikon' => 'Pipe9.svg'],
        ['slug' => 'spk', 'nama' => 'Surat Perjanjian Kerja (SPK)/ Surat Perjanjian (SP)', 'deskripsi' => 'Menampilkan data pekerja.', 'ikon' => 'Pipe10.svg'],
        ['slug' => 'spmk', 'nama' => 'Surat Perintah Mulai Kerja (SPMK)', 'deskripsi' => 'Informasi Memantau status kontrak perusahaan.', 'ikon' => 'Pipe11.svg'],
        ['slug' => 'bapl', 'nama' => 'Berita Acara Penyerahan Lapangan (BAPL)', 'deskripsi' => 'Menampilkan kalender acara penting organisasi.', 'ikon' => 'Pipe12.svg'],
        ['slug' => 'hps', 'nama' => 'Harga Perkiraan Sendiri (HPS)', 'deskripsi' => 'Informasi Isu utama yang perlu perhatian.', 'ikon' => 'Pipe13.svg'],
        ['slug' => 'timeschedule', 'nama' => 'Rencana Time Schedule', 'deskripsi' => 'Informasi Isu utama yang perlu perhatian.', 'ikon' => 'Pipe13.svg'],
    ];

    $dokumenLainnyaOptions = [
        ['slug' => 'kak', 'nama' => 'Kerangka Acuan Kerja (KAK)/Term Of Reference (TOR)', 'deskripsi' => 'Menampilkan kalender acara penting organisasi.', 'ikon' => 'Pipe18.svg'],
        ['slug' => 'sskk', 'nama' => 'Syarat-Syarat Khusus Kontrak (SSKK)', 'deskripsi' => 'Informasi Isu utama yang perlu perhatian.', 'ikon' => 'Pipe20.svg'],
        ['slug' => 'ssuk', 'nama' => 'Syarat-Syarat Umum Kontrak (SSUK)', 'deskripsi' => 'Informasi Isu utama yang perlu perhatian', 'ikon' => 'Pipe19.svg'],
        ['slug' => 'uraian', 'nama' => 'Uraian singkat Pekerjaan', 'deskripsi' => 'Menampilkan kalender acara penting organisasi.', 'ikon' => 'Pipe40.svg'],
    ];

    return view('dokumen.jenis', compact('jenis', 'suratOptions', 'dokumenLainnyaOptions'));
}

    // Menampilkan daftar surat berdasarkan jenis
    public function list($jenis_dokumen, $jenis_surat)
    {
        $listSurat = Surat::where('jenis_dokumen', $jenis_dokumen)
            ->where('jenis_surat', $jenis_surat)
            ->latest()
            ->get();

        return view('dokumen.list', compact('jenis_dokumen', 'jenis_surat', 'listSurat'));
    }

    // Menyimpan surat baru
public function store(Request $request)
{
    $request->validate([
        'judul_surat' => 'required|string|max:255',
        'jenis_dokumen' => 'required|string',
        'jenis_surat' => 'required|string',
    ]);

    // Cek duplicate
    $exists = Surat::where('jenis_dokumen', $request->jenis_dokumen)
        ->where('jenis_surat', $request->jenis_surat)
        ->where('judul_surat', $request->judul_surat)
        ->exists();

    if ($exists) {
        return redirect()->back()->with('error', 'Surat dengan kombinasi judul, jenis dokumen, dan jenis surat yang sama sudah ada!');
    }

    // Ambil template Excel aktif
    $template = TemplateSurat::where('jenis_surat', $request->jenis_surat)
        ->where('is_active', true)
        ->where('file_path', 'like', '%.xlsx')
        ->first();

    if (!$template) {
        return redirect()->back()->with('error', 'Template Excel aktif tidak ditemukan!');
    }

    // Buat record surat baru
    $surat = Surat::create([
        'judul_surat' => $request->judul_surat,
        'jenis_dokumen' => $request->jenis_dokumen,
        'jenis_surat' => $request->jenis_surat,
    ]);

    try {
        $this->generateExcelFromTemplate($surat, $template);
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal membuat file surat: ' . $e->getMessage());
    }

    return redirect()
        ->route('dokumen.list', [$surat->jenis_dokumen, $surat->jenis_surat])
        ->with('success', 'Surat berhasil dibuat dan file Excel telah digenerate.')
        ->with('highlight_id', $surat->id);
}


    // Generate file Excel dari template
    protected function generateExcelFromTemplate($surat, $template)
    {
        $templatePath = storage_path('app/public/' . $template->file_path);

        if (!file_exists($templatePath)) {
            throw new \Exception("File template tidak ditemukan!");
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        $this->replacePlaceholders($sheet, $surat);

        Storage::disk('public')->makeDirectory('surat/excel');

        $outputName = 'surat_' . $surat->id . '.xlsx';
        $outputPath = storage_path('app/public/surat/excel/' . $outputName);

        $writer = new Xlsx($spreadsheet);
        $writer->save($outputPath);

        $surat->update([
            'file_excel' => 'surat/excel/' . $outputName
        ]);
    }

    // Mengganti placeholder di Excel
    protected function replacePlaceholders($sheet, $surat)
    {
        $placeholders = [
            '{{judul_surat}}'     => $surat->judul_surat,
            '{{jenis_surat}}'     => $surat->jenis_surat,
            '{{jenis_dokumen}}'   => $surat->jenis_dokumen,
            '{{tanggal}}'         => now()->format('d-m-Y'),
        ];

        foreach ($sheet->getRowIterator() as $row) {
            foreach ($row->getCellIterator() as $cell) {
                $value = $cell->getValue();
                if (is_string($value) && strpos($value, '{{') !== false) {
                    foreach ($placeholders as $key => $replacement) {
                        $value = str_replace($key, $replacement, $value);
                    }
                    $cell->setValue($value);
                }
            }
        }
    }

    // Export file Template Excel
    public function exportExcel($id)
    {
        $surat = Surat::findOrFail($id);

        if (!$surat->file_excel) {
            return back()->with('error', 'File Excel belum tersedia untuk surat ini!');
        }

        $filePath = storage_path('app/public/' . $surat->file_excel);

        if (!file_exists($filePath)) {
            return back()->with('error', 'File Excel tidak ditemukan di server!');
        }

        $fileName = 'Template_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', $surat->judul_surat) . '.xlsx';

        return response()->download($filePath, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    // Export file Draft Excel
    public function exportDraft($id)
    {
        $surat = Surat::findOrFail($id);

        if (!$surat->file_belum_ttd) {
            return back()->with('error', 'File Draft belum tersedia untuk surat ini!');
        }

        $filePath = storage_path('app/public/' . $surat->file_belum_ttd);

        if (!file_exists($filePath)) {
            return back()->with('error', 'File Draft tidak ditemukan di server!');
        }

        $fileName = 'Draft_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', $surat->judul_surat) . '.xlsx';

        return response()->download($filePath, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    // Export file Final Excel
    public function exportFinal($id)
    {
        $surat = Surat::findOrFail($id);

        if (!$surat->file_sudah_ttd) {
            return back()->with('error', 'File Final belum tersedia untuk surat ini!');
        }

        $filePath = storage_path('app/public/' . $surat->file_sudah_ttd);

        if (!file_exists($filePath)) {
            return back()->with('error', 'File Final tidak ditemukan di server!');
        }

        $fileName = 'Final_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', $surat->judul_surat) . '.xlsx';

        return response()->download($filePath, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    // Menghapus surat
    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);

        // Hapus semua file terkait
        $filesToDelete = [
            $surat->file_excel,
            $surat->file_belum_ttd,
            $surat->file_sudah_ttd
        ];

        foreach ($filesToDelete as $file) {
            if ($file && Storage::disk('public')->exists($file)) {
                Storage::disk('public')->delete($file);
            }
        }

        $surat->delete();

        return back()->with('success', 'Surat berhasil dihapus!');
    }

    // Upload file Draft Excel (Belum TTD)
    public function uploadBelumTTD(Request $request, $id)
    {
        $request->validate([
            'file_belum_ttd' => 'required|file|mimes:xlsx,xls|max:5120',
        ]);

        $surat = Surat::findOrFail($id);

        // Hapus file lama jika ada
        if ($surat->file_belum_ttd && Storage::disk('public')->exists($surat->file_belum_ttd)) {
            Storage::disk('public')->delete($surat->file_belum_ttd);
        }

        // Simpan file baru
        $path = $request->file('file_belum_ttd')->store('surat/draft', 'public');

        $surat->update([
            'file_belum_ttd' => $path,
        ]);

        return back()->with('success', 'File draft berhasil diupload.');
    }

    // Upload file Final Excel (Sudah TTD)
    public function uploadTTD(Request $request, $id)
    {
        $request->validate([
            'file_sudah_ttd' => 'required|file|mimes:xlsx,xls|max:5120',
        ]);

        $surat = Surat::findOrFail($id);

        // Hapus file lama jika ada
        if ($surat->file_sudah_ttd && Storage::disk('public')->exists($surat->file_sudah_ttd)) {
            Storage::disk('public')->delete($surat->file_sudah_ttd);
        }

        // Simpan file baru
        $path = $request->file('file_sudah_ttd')->store('surat/final', 'public');

        $surat->update([
            'file_sudah_ttd' => $path,
        ]);

        return back()->with('success', 'File final berhasil diupload.');
    }
}