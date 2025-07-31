<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\TemplateSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PerencanaanController extends Controller
{
    // Menampilkan pilihan jenis dokumen pengadaan
    public function DokumenPengadaan()
    {
        $jenis = 'pengadaan';
        
        $jenisSuratOptions = [
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

 
return view('Perencanaan.DokumenKontrak', compact('jenis', 'jenisSuratOptions', 'dokumenLainnyaOptions'));
    }



public function DokumenKontrak()
{
    $jenis = 'kontrak';
   
    $jenisSuratOptions = [
        ['slug' => 'sppbj', 'nama' => 'Surat Penunjukan Penyedia Barang Jasa (SPPBJ)', 'deskripsi' => 'Menampilkan diagram .', 'ikon' => 'Pipe9.svg'],
        ['slug' => 'spk', 'nama' => 'Surat Perjanjian Kerja (SPK)/ Surat Perjanjian (SP)', 'deskripsi' => 'Menampilkan data pekerja.', 'ikon' => 'Pipe10.svg'],
        ['slug' => 'spmk', 'nama' => 'Surat Perintah Mulai Kerja (SPMK)', 'deskripsi' => 'Informasi Memantau status kontrak perusahaan.', 'ikon' => 'Pipe11.svg'],
        ['slug' => 'bapl', 'nama' => 'Berita Acara Penyerahan Lapangan (BAPL)', 'deskripsi' => 'Menampilkan kalender acara penting organisasi.', 'ikon' => 'Pipe12.svg'],
        ['slug' => 'hps', 'nama' => 'Harga Perkiraan Sendiri (HPS)', 'deskripsi' => 'Informasi Isu utama yang perlu perhatian.', 'ikon' => 'Pipe13.svg', 'route' => 'rab.indexkontrak'],
        ['slug' => 'timeschedule', 'nama' => 'Rencana Time Schedule', 'deskripsi' => 'Informasi Isu utama yang perlu perhatian.', 'ikon' => 'Pipe13.svg'],
    ];

    $dokumenLainnyaOptions = [
        ['slug' => 'kak', 'nama' => 'Kerangka Acuan Kerja (KAK)/Term Of Reference (TOR)', 'deskripsi' => 'Menampilkan kalender acara penting organisasi.', 'ikon' => 'Pipe18.svg'],
        ['slug' => 'sskk', 'nama' => 'Syarat-Syarat Khusus Kontrak (SSKK)', 'deskripsi' => 'Informasi Isu utama yang perlu perhatian.', 'ikon' => 'Pipe20.svg'],
        ['slug' => 'ssuk', 'nama' => 'Syarat-Syarat Umum Kontrak (SSUK)', 'deskripsi' => 'Informasi Isu utama yang perlu perhatian', 'ikon' => 'Pipe19.svg'],
        ['slug' => 'uraian', 'nama' => 'Uraian singkat Pekerjaan', 'deskripsi' => 'Menampilkan kalender acara penting organisasi.', 'ikon' => 'Pipe40.svg'],
    ];

   return view('Perencanaan.DokumenKontrak', compact('jenis', 'jenisSuratOptions', 'dokumenLainnyaOptions'));
}

    // Menampilkan daftar surat berdasarkan jenis_surat
    public function list($jenis_dokumen, $jenis_surat)
    {
        $listSurat = Surat::where('jenis_surat', $jenis_surat)
            ->latest()
            ->get();

        return view('Perencanaan.ListSurat', compact('jenis_dokumen', 'jenis_surat', 'listSurat'));
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
            return redirect()->back()->with('error', 'Surat dengan kombinasi ini sudah ada!');
        }

        // Buat record surat baru
        $surat = Surat::create([
            'judul_surat' => $request->judul_surat,
            'jenis_dokumen' => $request->jenis_dokumen,
            'jenis_surat' => $request->jenis_surat,
        ]);

        // Generate file Excel jika ada template
        $template = TemplateSurat::where('jenis_surat', $request->jenis_surat)
            ->where('is_active', true)
            ->first();

        if ($template) {
            try {
                $this->generateExcelFromTemplate($surat, $template);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Gagal membuat file template: ' . $e->getMessage());
            }
        }

        return redirect()
            ->route('perencanaan.list', [$request->jenis_dokumen, $request->jenis_surat])
            ->with('success', 'Surat berhasil dibuat!')
            ->with('highlight_id', $surat->id);
    }

    // Generate file Excel dari template
 protected function generateExcelFromTemplate($surat, $template)
{
    $templatePath = storage_path('app/public/' . $template->file_path);
    if (!file_exists($templatePath)) {
        throw new \Exception("File template tidak ditemukan");
    }

    $spreadsheet = IOFactory::load($templatePath);
    $sheet = $spreadsheet->getActiveSheet();

    // Replace placeholder
    $placeholders = [
        '{{judul_surat}}'    => $surat->judul_surat,
        '{{jenis_surat}}'    => $surat->jenis_surat,
        '{{jenis_dokumen}}'  => $surat->jenis_dokumen,
        '{{nomor_surat}}'    => $surat->nomor_surat, // tambahkan ini
        '{{tanggal}}'        => now()->format('d-m-Y'),
    ];

    foreach ($sheet->getRowIterator() as $row) {
        foreach ($row->getCellIterator() as $cell) {
            $value = $cell->getValue();
            if (is_string($value)) {
                foreach ($placeholders as $key => $replacement) {
                    $value = str_replace($key, $replacement, $value);
                }
                $cell->setValue($value);
            }
        }
    }

    // Simpan file
    $directory = 'surat/excel';
    Storage::disk('public')->makeDirectory($directory);
    
    $fileName = 'surat_' . $surat->id . '.xlsx';
    $filePath = $directory . '/' . $fileName;

    $writer = new Xlsx($spreadsheet);
    $writer->save(storage_path('app/public/' . $filePath));

    $surat->update(['file_excel' => $filePath]);
}


    // Export file
    public function exportExcel($id)
    {
        return $this->exportFile($id, 'file_excel', 'Template_');
    }

    public function exportDraft($id)
    {
        return $this->exportFile($id, 'file_belum_ttd', 'Draft_');
    }

    public function exportFinal($id)
    {
        return $this->exportFile($id, 'file_sudah_ttd', 'Final_');
    }

    protected function exportFile($id, $field, $prefix)
    {
        $surat = Surat::findOrFail($id);
        
        if (!$surat->$field) {
            return back()->with('error', 'File tidak tersedia!');
        }

        $filePath = storage_path('app/public/' . $surat->$field);
        if (!file_exists($filePath)) {
            return back()->with('error', 'File tidak ditemukan!');
        }

        $fileName = $prefix . preg_replace('/[^a-zA-Z0-9_-]/', '_', $surat->judul_surat) . '.xlsx';
        
        return response()->download($filePath, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    // Upload file
    public function uploadBelumTTD(Request $request, $id)
    {
        return $this->uploadFile($request, $id, 'file_belum_ttd', 'draft', 'Draft berhasil diupload!');
    }

    public function uploadTTD(Request $request, $id)
    {
        return $this->uploadFile($request, $id, 'file_sudah_ttd', 'final', 'File final berhasil diupload!');
    }

    protected function uploadFile($request, $id, $field, $folder, $successMsg)
    {
        $request->validate([
            $field => 'required|file|mimes:xlsx,xls|max:5120',
        ]);

        $surat = Surat::findOrFail($id);
        
        // Hapus file lama jika ada
        if ($surat->$field) {
            Storage::disk('public')->delete($surat->$field);
        }

        // Upload file baru
        $path = $request->file($field)->store('surat/' . $folder, 'public');
        $surat->update([$field => $path]);

        return back()->with('success', $successMsg);
    }

    // Hapus surat
    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        
        // Hapus file terkait
        $files = ['file_excel', 'file_belum_ttd', 'file_sudah_ttd'];
        foreach ($files as $file) {
            if ($surat->$file) {
                Storage::disk('public')->delete($surat->$file);
            }
        }
        
        $surat->delete();
        return back()->with('success', 'Surat berhasil dihapus!');
    }
}