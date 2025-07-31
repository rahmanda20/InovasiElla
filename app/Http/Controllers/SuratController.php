<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\TemplateSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use ZipArchive;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



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
        ['slug' => 'spk', 'nama' => 'Surat Perjanjian Kerja (SPK)/Surat Perjanjian (SP)', 'deskripsi' => 'Menampilkan data pekerja.', 'ikon' => 'Pipe10.svg'],
        ['slug' => 'spmk', 'nama' => 'Surat Perintah Mulai Kerja (SPMK)', 'deskripsi' => 'Memantau status kontrak perusahaan.', 'ikon' => 'Pipe11.svg'],
        ['slug' => 'bapl', 'nama' => 'Berita Acara Penyerahan Lapangan (BAPL)', 'deskripsi' => 'Menampilkan kalender acara penting.', 'ikon' => 'Pipe12.svg'],
        ['slug' => 'hps', 'nama' => 'Harga Perkiraan Sendiri (HPS)', 'deskripsi' => 'Informasi anggaran utama.', 'ikon' => 'Pipe13.svg'],
        ['slug' => 'timeschedule', 'nama' => 'Rencana Time Schedule', 'deskripsi' => 'Informasi jadwal pelaksanaan.', 'ikon' => 'Pipe13.svg'],
    ];

    $dokumenLainnyaOptions = [
        ['slug' => 'kak', 'nama' => 'Kerangka Acuan Kerja (KAK)/TOR', 'deskripsi' => 'Ruang lingkup pekerjaan.', 'ikon' => 'Pipe18.svg'],
        ['slug' => 'sskk', 'nama' => 'Syarat-Syarat Khusus Kontrak (SSKK)', 'deskripsi' => 'Syarat kontrak khusus.', 'ikon' => 'Pipe20.svg'],
        ['slug' => 'ssuk', 'nama' => 'Syarat-Syarat Umum Kontrak (SSUK)', 'deskripsi' => 'Syarat umum kontrak.', 'ikon' => 'Pipe19.svg'],
        ['slug' => 'uraian', 'nama' => 'Uraian Singkat Pekerjaan', 'deskripsi' => 'Ringkasan pekerjaan.', 'ikon' => 'Pipe40.svg'],
    ];

     $surats = Surat::where('jenis_dokumen', $jenis)->latest()->get();

    return view('dokumen.jenis', compact('jenis', 'suratOptions', 'dokumenLainnyaOptions', 'surats'));
}
public function getJenisSurat(Request $request)
{
    // Ambil data dari query string
    $judul = $request->query('judul');
    $jenisDokumen = $request->query('jenis_dokumen');

    // Validasi manual karena GET tidak pakai ->validate()
    if (!$judul || !$jenisDokumen) {
        return response()->json([
            'status' => 'error',
            'message' => 'Parameter judul dan jenis_dokumen wajib diisi.',
        ], 400);
    }

    // Ambil data dari database
    $surats = Surat::where('judul_surat', $judul)
        ->where('jenis_dokumen', $jenisDokumen)
        ->get(['id', 'jenis_surat']);

    // Jika tidak ada data ditemukan
    if ($surats->isEmpty()) {
        return response()->json([
            'status' => 'empty',
            'message' => 'Tidak ada data jenis surat ditemukan.',
            'data' => [],
        ], 200);
    }

    // Jika data ditemukan
    return response()->json([
        'status' => 'success',
        'message' => 'Data jenis surat berhasil diambil.',
        'data' => $surats,
    ], 200);
}




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
        'judul_surat'    => 'required|string|max:255',
        'jenis_dokumen'  => 'required|string',
        'jenis_surat'    => 'required|string',
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

    // Ambil bulan dan tahun sekarang
    $now = Carbon::now();
    $bulanRomawi = [
        1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV',
        5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII',
        9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
    ];

    $bulan = $bulanRomawi[$now->month];
    $tahun = $now->year;

    // Hitung jumlah surat sebelumnya untuk jenis_surat tersebut bulan ini
    $countThisMonth = Surat::where('jenis_surat', $request->jenis_surat)
        ->whereMonth('created_at', $now->month)
        ->whereYear('created_at', $now->year)
        ->count();

    // Nomor surat dalam 3 digit
    $urut = str_pad($countThisMonth + 1, 3, '0', STR_PAD_LEFT);

    // Format nomor surat: 001/ND/MPS/VII/2025
    $kodeSurat = strtoupper($request->jenis_surat); // Misal: 'nd'
    $nomorSuratFormatted = "$urut/$kodeSurat/PUPR/$bulan/$tahun";

    // Buat record surat
    $surat = Surat::create([
        'judul_surat'    => $request->judul_surat,
        'jenis_dokumen'  => $request->jenis_dokumen,
        'jenis_surat'    => $request->jenis_surat,
        'nomor_surat'    => $nomorSuratFormatted,
        'created_by'     => Auth::id(),
    ]);

    // Generate file dari template
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
        '{{nomor_surat}}'     => $surat->nomor_surat, // ✅ Tambahkan ini
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






public function massCreate(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
    ]);

    $judul = $request->judul;
    $jenisDokumen = 'pengadaan_langsung';
    $user = Auth::user(); // pastikan middleware 'auth' aktif
    $userId = Auth::id();

    // Penomoran surat berdasarkan bulan dan tahun
    $now = Carbon::now();
    $bulanRomawi = [1=>'I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'];
    $bulan = $bulanRomawi[$now->month];
    $tahun = $now->year;

    // Hitung jumlah surat bulan ini
    $countThisMonth = Surat::whereMonth('created_at', $now->month)
        ->whereYear('created_at', $now->year)
        ->count();

    // Nomor surat format 001/SPPK/MPS/VII/2025
    $urut = str_pad($countThisMonth + 1, 3, '0', STR_PAD_LEFT);
    $nomorSuratFormatted = "$urut/ALL/MPS/$bulan/$tahun";

    $suratOptions = [
        'sppbj', 'spk', 'spmk', 'bapl', 'hps', 'timeschedule',
        'kak', 'sskk', 'ssuk', 'uraian'
    ];

    $created = [];
    $skippedNoTemplate = [];
    $skippedAlreadyExists = [];

    foreach ($suratOptions as $jenisSurat) {
        $template = TemplateSurat::where('jenis_surat', $jenisSurat)
            ->where('is_active', true)
            ->where('file_path', 'like', '%.xlsx')
            ->first();

        if (!$template) {
            $skippedNoTemplate[] = strtoupper($jenisSurat);
            continue;
        }

        $exists = Surat::where('judul_surat', $judul)
            ->where('jenis_dokumen', $jenisDokumen)
            ->where('jenis_surat', $jenisSurat)
            ->exists();

        if ($exists) {
            $skippedAlreadyExists[] = strtoupper($jenisSurat);
            continue;
        }

        $surat = Surat::create([
            'judul_surat'   => $judul,
            'jenis_dokumen' => $jenisDokumen,
            'jenis_surat'   => $jenisSurat,
            'nomor_surat'   => $nomorSuratFormatted,
            'created_by'      => $userId,
        ]);

        try {
            $this->generateExcelFromTemplate($surat, $template);
            $created[] = strtoupper($jenisSurat);
        } catch (\Exception $e) {
            // Gagal generate, abaikan atau log jika perlu
        }
    }

    // Compose success message
    $successMessage = '';
    if (count($created) > 0) {
        $successMessage .= count($created) . ' template berhasil dibuat:<br><b>' . implode(', ', $created) . '</b><br><br>';
    }
    if (count($skippedNoTemplate) > 0) {
        $successMessage .= 'Template belum aktif untuk:<br><b>' . implode(', ', $skippedNoTemplate) . '</b>';
    }

    if (!empty($successMessage)) {
        session()->flash('success', $successMessage);
    }

    // Compose error message (duplikat)
    if (count($skippedAlreadyExists) > 0) {
        session()->flash('error', 'Template sudah pernah dibuat sebelumnya:<br><b>' . implode(', ', $skippedAlreadyExists) . '</b>');
    }

    return redirect()->back();
}




public function downloadZip(Request $request)
{
    $request->validate([
        'judul_surat'   => 'required|string',
        'jenis_surat'   => 'required|array',
        'jenis_dokumen' => 'required|string',
    ]);

    $files = [];

    foreach ($request->jenis_surat as $jenis) {
        $surat = Surat::where('judul_surat', $request->judul_surat)
            ->where('jenis_surat', $jenis)
            ->where('jenis_dokumen', $request->jenis_dokumen)
            ->first();

        if ($surat && $surat->file_excel && Storage::disk('public')->exists($surat->file_excel)) {
            $fullPath = Storage::disk('public')->path($surat->file_excel);

            // Buat nama baru berdasarkan format
            $newFileName = $request->judul_surat . '_' . $request->jenis_dokumen . '_' . $jenis . '.' . pathinfo($fullPath, PATHINFO_EXTENSION);

            $files[] = [
                'path' => $fullPath,
                'name' => $newFileName,
            ];
        }
    }

    if (empty($files)) {
        return back()->with('error', 'Tidak ada file yang ditemukan.');
    }

    $tempDir = storage_path("app/temp");
    if (!file_exists($tempDir)) {
        mkdir($tempDir, 0755, true);
    }

    $zipFileName = $request->judul_surat . '_' . $request->jenis_dokumen . '.zip';
    $zipFilePath = $tempDir . '/' . $zipFileName;

    $zip = new \ZipArchive;

    if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
        foreach ($files as $file) {
            $zip->addFile($file['path'], $file['name']);
        }
        $zip->close();
    } else {
        return back()->with('error', 'Gagal membuat file ZIP.');
    }

    return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);
}




    // Export file Template Excel
    public function exportExcel($id)
    {
        $surat = Surat::findOrFail($id);
        dd($surat);

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