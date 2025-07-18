<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\TemplateSurat;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;
use ZipArchive;

class PengadaanController extends Controller
{
    protected $jenisMap = [
        'spbj' => 'Pengadaan Langsung',
        'sppbj' => 'Penunjukan Langsung',
        'spmk' => 'Tender',
        'seleksi' => 'Seleksi',
        'barang' => 'Barang',
    ];

    public function index()
    {
        $jenisList = array_keys($this->jenisMap);
        $suratList = Surat::orderBy('created_at', 'desc')->get();

        return view('Perencanaan.Pengadaan.index', compact('jenisList', 'suratList'));
    }

    public function byJenis($jenis)
    {
        if (!array_key_exists($jenis, $this->jenisMap)) {
            abort(404, 'Jenis surat tidak dikenali.');
        }

        $label = $this->jenisMap[$jenis];
        $listSurat = Surat::where('jenis_surat', $jenis)->latest()->get();

        return view('Perencanaan.Pengadaan.list', compact('jenis', 'label', 'listSurat'));
    }

  public function store(Request $request)
{
    $request->validate([
        'judul_surat' => 'required|string',
        'jenis_surat' => 'required|string',
    ]);

    $judul = strtolower(trim($request->judul_surat));
    $jenis = strtolower(trim($request->jenis_surat));

    $existing = Surat::where('jenis_surat', $jenis)
        ->get()
        ->first(function ($item) use ($judul) {
            return strtolower($item->judul_surat) === $judul;
        });

    if ($existing) {
        return redirect()->route('surat.byJenis', $jenis)
            ->with('warning', 'Surat sudah diajukan sebelumnya.')
            ->with('highlight_id', $existing->id);
    }

    $surat = Surat::create([
        'judul_surat' => $request->judul_surat,
        'jenis_surat' => $jenis,
    ]);

    return redirect()->route('surat.byJenis', $jenis)
        ->with('success', 'Surat berhasil ditambahkan.');
}


    public function export($id)
    {
        $surat = Surat::findOrFail($id);
        return $this->generateExcel($surat);
    }

    public function exportAll()
    {
        $surats = Surat::all();
        $template = TemplateSurat::where('is_active', true)->first();

        if (!$template) {
            return back()->with('error', 'Template belum diaktifkan.');
        }

        $filePath = storage_path('app/public/' . $template->file_path);
        if (!file_exists($filePath)) {
            return back()->with('error', 'File template tidak ditemukan.');
        }

        $zip = new ZipArchive();
        $zipFileName = tempnam(sys_get_temp_dir(), 'surats') . '.zip';
        $zip->open($zipFileName, ZipArchive::CREATE);

        foreach ($surats as $surat) {
            $spreadsheet = IOFactory::load($filePath);

            foreach ($spreadsheet->getAllSheets() as $sheet) {
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                for ($row = 1; $row <= $highestRow; $row++) {
                    for ($col = 'A'; $col <= $highestColumn; $col++) {
                        $cell = $sheet->getCell($col . $row);
                        $val = $cell->getValue();
                        if (is_string($val)) {
                            $val = str_replace('{{judul_surat}}', $surat->judul_surat, $val);
                            $val = str_replace('{{tanggal}}', $surat->created_at->format('d-m-Y'), $val);
                            $cell->setValue($val);
                        }
                    }
                }
            }

            $tempFile = tempnam(sys_get_temp_dir(), 'surat') . '.xlsx';
            $writer = new Xlsx($spreadsheet);
            $writer->save($tempFile);
            $zip->addFile($tempFile, $surat->judul_surat . '.xlsx');
        }

        $zip->close();

        return response()->download($zipFileName, 'semua_surat_' . time() . '.zip')->deleteFileAfterSend(true);
    }

    private function generateExcel(Surat $surat)
    {
        $template = TemplateSurat::where('is_active', true)->first();

        if (!$template) {
            return back()->with('error', 'Template belum diaktifkan.');
        }

        $filePath = storage_path('app/public/' . $template->file_path);
        if (!file_exists($filePath)) {
            return back()->with('error', 'File template tidak ditemukan.');
        }

        $spreadsheet = IOFactory::load($filePath);

        foreach ($spreadsheet->getAllSheets() as $sheet) {
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            for ($row = 1; $row <= $highestRow; $row++) {
                for ($col = 'A'; $col <= $highestColumn; $col++) {
                    $cell = $sheet->getCell($col . $row);
                    $val = $cell->getValue();

                    if (is_string($val)) {
                        $val = str_replace('{{judul_surat}}', $surat->judul_surat, $val);
                        $val = str_replace('{{tanggal}}', $surat->created_at->format('d-m-Y'), $val);
                        $cell->setValue($val);
                    }
                }
            }
        }

        $fileName = 'surat-' . $surat->jenis_surat . '-' . time() . '.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), 'excel');
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
}