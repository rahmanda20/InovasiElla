<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemplateSurat;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;



class TemplateSuratController extends Controller
{
    protected $cards = [
    'sppbj' => [
        'label' => 'Surat Penunjukan Penyedia Barang Jasa (SPPBJ)',
        'icon' => 'Pipe9.svg',
        'desc' => 'Dokumen penunjukan penyedia barang/jasa.',
    ],
    'spk' => [
        'label' => 'Surat Perjanjian Kerja (SPK)/Surat Perjanjian (SP)',
        'icon' => 'Pipe10.svg',
        'desc' => 'Perjanjian kerja antara pihak terkait.',
    ],
    'spmk' => [
        'label' => 'Surat Perintah Mulai Kerja (SPMK)',
        'icon' => 'Pipe11.svg',
        'desc' => 'Perintah resmi untuk memulai pekerjaan.',
    ],
    'bapl' => [
        'label' => 'Berita Acara Penyerahan Lapangan (BAPL)',
        'icon' => 'Pipe12.svg',
        'desc' => 'Dokumen serah terima lapangan kerja.',
    ],
    'hps' => [
        'label' => 'Harga Perkiraan Sendiri (HPS)',
        'icon' => 'Pipe13.svg',
        'desc' => 'Perkiraan harga dari penyelenggara.',
    ],
    'time' => [
        'label' => 'Rencana Time Schedule',
        'icon' => 'Pipe13.svg',
        'desc' => 'Jadwal pelaksanaan pekerjaan.',
    ],
    'kak' => [
        'label' => 'Kerangka Acuan Kerja (KAK)/Term Of Reference (TOR)',
        'icon' => 'Pipe18.svg',
        'desc' => 'Gambaran umum ruang lingkup kerja.',
    ],
    'sskk' => [
        'label' => 'Syarat-Syarat Khusus Kontrak (SSKK)',
        'icon' => 'Pipe20.svg',
        'desc' => 'Ketentuan khusus dalam kontrak.',
    ],
    'ssuk' => [
        'label' => 'Syarat-Syarat Umum Kontrak (SSUK)',
        'icon' => 'Pipe19.svg',
        'desc' => 'Ketentuan umum dalam kontrak.',
    ],
    'uraian' => [
        'label' => 'Uraian Singkat Pekerjaan',
        'icon' => 'Pipe40.svg',
        'desc' => 'Ringkasan pekerjaan yang dilakukan.',
    ],
];

    /**
     * Halaman dashboard semua jenis template
     */
    public function dashboard()
    {
        return view('template.dashboard', ['cards' => $this->cards]);
    }

    /**
     * Menampilkan daftar template berdasarkan jenis
     */
   public function index($jenis)
{
    if (!array_key_exists($jenis, $this->cards)) {
        abort(404, 'Jenis template tidak ditemukan.');
    }

    // Ambil template berdasarkan jenis, sekaligus relasi ke user
    $templates = TemplateSurat::with('creator')
        ->where('jenis_surat', $jenis)
        ->orderByDesc('created_at')
        ->get();

    return view('template.index', [
        'jenis' => $jenis,
        'label' => $this->cards[$jenis]['label'],
        'templates' => $templates,
    ]);
}


    /**
     * Menyimpan template baru
     */
  public function store(Request $r)
{
    // Validasi input
    $r->validate([
        'jenis_surat' => 'required|string',
        'file' => 'required|file|mimes:pdf,docx,xlsx|max:2048'
    ]);

    try {
        $originalName = $r->file('file')->getClientOriginalName();
        $cleanName = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', pathinfo($originalName, PATHINFO_FILENAME));
        $extension = $r->file('file')->getClientOriginalExtension();
        $filename = time() . '_' . $cleanName . '.' . $extension;

        // Cek apakah template dengan judul dan jenis_surat sudah ada
        $isDuplicate = TemplateSurat::where('jenis_surat', $r->jenis_surat)
            ->where('judul_surat', $originalName)
            ->exists();

        if ($isDuplicate) {
            return redirect()->route('template.index', ['jenis' => $r->jenis_surat])
                ->with('error', 'Template dengan nama yang sama sudah pernah diunggah.');
        }

        // Simpan file ke storage
        $path = $r->file('file')->storeAs('templates/' . $r->jenis_surat, $filename, 'public');

        // Simpan ke database
        $template = TemplateSurat::create([
            'jenis_surat' => $r->jenis_surat,
            'judul_surat' => $originalName,
            'file_path' => $path,
            'is_active' => false,
            'created_by' => auth()->id() // Tambahkan ini
        ]);

        return redirect()->route('template.index', ['jenis' => $r->jenis_surat])
            ->with('success', 'Template berhasil ditambahkan.')
            ->with('highlight_id', $template->id);

    } catch (\Exception $e) {
        return redirect()->route('template.index', ['jenis' => $r->jenis_surat])
            ->with('error', 'Terjadi kesalahan saat menyimpan template: ' . $e->getMessage());
    }
}


    /**
     * Mengaktifkan salah satu template dan menonaktifkan yang lainnya
     */
    public function activate($id)
    {
        $t = TemplateSurat::findOrFail($id);

        // Nonaktifkan semua template jenis yang sama
        TemplateSurat::where('jenis_surat', $t->jenis_surat)
            ->update(['is_active' => false]);

        // Aktifkan template ini
        $t->update(['is_active' => true]);

        return redirect()->route('template.index', ['jenis' => $t->jenis_surat])
            ->with('success', 'Template berhasil diaktifkan.');
    }

    /**
     * Download file template
     */
public function download($id)
{
    $t = TemplateSurat::findOrFail($id);

    $path = storage_path('app/public/' . $t->file_path);

    if (!file_exists($path)) {
        return back()->with('error', 'File tidak ditemukan di server.');
    }

    // Pastikan header dan isi sesuai
    return Response::make(file_get_contents($path), 200, [
        'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'Content-Disposition' => 'attachment; filename="' . basename($path) . '"',
    ]);
}
    /**
     * Menghapus template
     */
    public function delete($id)
    {
        $t = TemplateSurat::findOrFail($id);
        $jenis = $t->jenis_surat;

        // Hapus file jika ada
        if (Storage::disk('public')->exists($t->file_path)) {
            Storage::disk('public')->delete($t->file_path);
        }

        $t->delete();

        return redirect()->route('template.index', ['jenis' => $jenis])
            ->with('success', 'Template berhasil dihapus.');
    }
}
