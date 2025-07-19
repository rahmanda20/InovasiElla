<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rab;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Barryvdh\DomPDF\Facade\Pdf;

class RabController extends Controller
{
    // Method untuk menampilkan daftar RAB
    public function index()
    {
        $rabs = Rab::all();
        return view('RAB.index', compact('rabs'));
    }

    // Method untuk menampilkan form create RAB
    public function create()
    {
        return view('RAB.create');
    }

    // Method untuk menampilkan detail RAB
    public function show(Rab $rab)
    {
        $jumlahAB = $rab->jumlah_biaya_langsung_personal + $rab->jumlah_biaya_langsung_non_personal;
        $ppn = $jumlahAB * 0.11;
        $total = $jumlahAB + $ppn;

        // Panggil method terbilang dari instance controller
        $terbilangText = $this->terbilang($total);

        return view('RAB.show', compact('rab', 'jumlahAB', 'ppn', 'total', 'terbilangText'));
    }

    // Method untuk menyimpan RAB baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pekerjaan' => 'required|string',
            'lokasi' => 'required|string',
            'masa_pelaksanaan' => 'required|string',
            'sumber_dana' => 'required|string',
            'uraian_kegiatan_biaya_langsung_personal.*.uraian' => 'nullable|string',
            'uraian_kegiatan_biaya_langsung_personal.*.jumlah' => 'nullable|numeric',
            'uraian_kegiatan_biaya_langsung_non_personal.*.uraian' => 'nullable|string',
            'uraian_kegiatan_biaya_langsung_non_personal.*.jumlah' => 'nullable|numeric',
            'nama_penyedia' => 'required|string',
            'nama_perusahaan_penyedia' => 'required|string',
            'jabatan_penyedia' => 'required|string',
            'nama_pejabat_penandatangan_kontrak' => 'required|string',
            'jabatan_pejabat' => 'required|string',
            'nip_pejabat' => 'required|string',
        ]);

        // Filter data personal dan non-personal
        $personalItems = $this->filterItems($request->input('uraian_kegiatan_biaya_langsung_personal', []));
        $nonPersonalItems = $this->filterItems($request->input('uraian_kegiatan_biaya_langsung_non_personal', []));

        // Hitung total
        $totalPersonal = collect($personalItems)->sum('jumlah');
        $totalNonPersonal = collect($nonPersonalItems)->sum('jumlah');

        // Simpan data RAB
        Rab::create([
            'pekerjaan' => $request->pekerjaan,
            'lokasi' => $request->lokasi,
            'masa_pelaksanaan' => $request->masa_pelaksanaan,
            'sumber_dana' => $request->sumber_dana,
            'uraian_kegiatan_biaya_langsung_personal' => $personalItems,
            'uraian_kegiatan_biaya_langsung_non_personal' => $nonPersonalItems,
            'jumlah_biaya_langsung_personal' => $totalPersonal,
            'jumlah_biaya_langsung_non_personal' => $totalNonPersonal,
            'nama_penyedia' => $request->nama_penyedia,
            'nama_perusahaan_penyedia' => $request->nama_perusahaan_penyedia,
            'jabatan_penyedia' => $request->jabatan_penyedia,
            'nama_pejabat_penandatangan_kontrak' => $request->nama_pejabat_penandatangan_kontrak,
            'jabatan_pejabat' => $request->jabatan_pejabat,
            'nip_pejabat' => $request->nip_pejabat,
        ]);

        return redirect()->route('rab.index')->with('success', 'RAB berhasil disimpan');
    }

    // Method untuk menghapus RAB
    public function destroy(Rab $rab)
    {
        $rab->delete();
        return redirect()->route('rab.index')->with('success', 'RAB berhasil dihapus.');
    }

    // Method untuk download Excel
    public function downloadExcel(Rab $rab)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Detail RAB');

        // Hitung total dan PPN
        $jumlahAB = $rab->jumlah_biaya_langsung_personal + $rab->jumlah_biaya_langsung_non_personal;
        $ppn = $jumlahAB * 0.11;
        $total = $jumlahAB + $ppn;

        // --- KOP SURAT ---
        $sheet->mergeCells('A1:C1');
        $sheet->setCellValue('A1', 'PEMERINTAH PROVINSI PAPUA');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('A2:C2');
        $sheet->setCellValue('A2', 'DINAS PEKERJAAN UMUM, PENATAAN RUANG, PERUMAHAN DAN KAWASAN PERMUKIMAN');
        $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('A3:C3');
        $sheet->setCellValue('A3', 'Alamat : Jl. Sumatera No.15 Dok IV, Jayapura - Papua - Indonesia');
        $sheet->getStyle('A3')->getFont()->setSize(10);
        $sheet->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('A4:C4');
        $sheet->setCellValue('A4', 'Telepon : (0967) 532497, 533219, Email : pu@papua.net, laman : http://pu.papua.go.id/');
        $sheet->getStyle('A4')->getFont()->setSize(10);
        $sheet->getStyle('A4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // --- JUDUL RAB ---
        $sheet->mergeCells('A6:C6');
        $sheet->setCellValue('A6', 'REKAPITULASI RENCANA ANGGARAN BIAYA');
        $sheet->getStyle('A6')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A6')->getFont()->setUnderline(true);

        // --- INFORMASI RAB ---
        $sheet->setCellValue('A8', 'Pekerjaan');
        $sheet->setCellValue('B8', ': ' . $rab->pekerjaan);
        $sheet->setCellValue('A9', 'Lokasi');
        $sheet->setCellValue('B9', ': ' . $rab->lokasi);
        $sheet->setCellValue('A10', 'Masa Pelaksanaan');
        $sheet->setCellValue('B10', ': ' . $rab->masa_pelaksanaan);
        $sheet->setCellValue('A11', 'Sumber Dana');
        $sheet->setCellValue('B11', ': ' . $rab->sumber_dana);

        // --- HEADER TABEL ---
        $sheet->setCellValue('A13', 'NO.');
        $sheet->setCellValue('B13', 'URAIAN KEGIATAN');
        $sheet->setCellValue('C13', 'JUMLAH BIAYA (Rp)');
        
        // Style header tabel
        $headerStyle = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFF2F2F2'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ];
        $sheet->getStyle('A13:C13')->applyFromArray($headerStyle);

        // --- BIAYA LANGSUNG PERSONAL ---
        $currentRow = 14;
        $sheet->mergeCells("A{$currentRow}:C{$currentRow}");
        $sheet->setCellValue("A{$currentRow}", 'A. BIAYA LANGSUNG PERSONAL');
        $sheet->getStyle("A{$currentRow}")->getFont()->setBold(true);
        $currentRow++;

        $personalIndex = 1;
        if (is_array($rab->uraian_kegiatan_biaya_langsung_personal)) {
            foreach ($rab->uraian_kegiatan_biaya_langsung_personal as $item) {
                $sheet->setCellValue("A{$currentRow}", 'A.' . $personalIndex++);
                $sheet->setCellValue("B{$currentRow}", $item['uraian'] ?? '-');
                $sheet->setCellValue("C{$currentRow}", $item['jumlah'] ?? 0);
                $sheet->getStyle("C{$currentRow}")->getNumberFormat()->setFormatCode('#,##0.00');
                $currentRow++;
            }
        }

        // Total Personal
        $sheet->setCellValue("B{$currentRow}", 'JUMLAH (A)');
        $sheet->setCellValue("C{$currentRow}", $rab->jumlah_biaya_langsung_personal);
        $sheet->getStyle("B{$currentRow}:C{$currentRow}")->getFont()->setBold(true);
        $sheet->getStyle("C{$currentRow}")->getNumberFormat()->setFormatCode('#,##0.00');
        $currentRow += 2;

        // --- BIAYA LANGSUNG NON PERSONAL ---
        $sheet->mergeCells("A{$currentRow}:C{$currentRow}");
        $sheet->setCellValue("A{$currentRow}", 'B. BIAYA LANGSUNG NON PERSONAL');
        $sheet->getStyle("A{$currentRow}")->getFont()->setBold(true);
        $currentRow++;

        $nonPersonalIndex = 1;
        if (is_array($rab->uraian_kegiatan_biaya_langsung_non_personal)) {
            foreach ($rab->uraian_kegiatan_biaya_langsung_non_personal as $item) {
                $sheet->setCellValue("A{$currentRow}", 'B.' . $nonPersonalIndex++);
                $sheet->setCellValue("B{$currentRow}", $item['uraian'] ?? '-');
                $sheet->setCellValue("C{$currentRow}", $item['jumlah'] ?? 0);
                $sheet->getStyle("C{$currentRow}")->getNumberFormat()->setFormatCode('#,##0.00');
                $currentRow++;
            }
        }

        // Total Non Personal
        $sheet->setCellValue("B{$currentRow}", 'JUMLAH (B)');
        $sheet->setCellValue("C{$currentRow}", $rab->jumlah_biaya_langsung_non_personal);
        $sheet->getStyle("B{$currentRow}:C{$currentRow}")->getFont()->setBold(true);
        $sheet->getStyle("C{$currentRow}")->getNumberFormat()->setFormatCode('#,##0.00');
        $currentRow += 1;

        // --- TOTAL, PPN, GRAND TOTAL ---
        $sheet->setCellValue("B{$currentRow}", 'JUMLAH (A + B)');
        $sheet->setCellValue("C{$currentRow}", $jumlahAB);
        $sheet->getStyle("B{$currentRow}:C{$currentRow}")->getFont()->setBold(true);
        $sheet->getStyle("C{$currentRow}")->getNumberFormat()->setFormatCode('#,##0.00');
        $currentRow++;

        $sheet->setCellValue("B{$currentRow}", 'PPN 11%');
        $sheet->setCellValue("C{$currentRow}", $ppn);
        $sheet->getStyle("B{$currentRow}:C{$currentRow}")->getFont()->setBold(true);
        $sheet->getStyle("C{$currentRow}")->getNumberFormat()->setFormatCode('#,##0.00');
        $currentRow++;

        $sheet->setCellValue("B{$currentRow}", 'TOTAL');
        $sheet->setCellValue("C{$currentRow}", $total);
        $sheet->getStyle("B{$currentRow}:C{$currentRow}")->getFont()->setBold(true);
        $sheet->getStyle("C{$currentRow}")->getNumberFormat()->setFormatCode('#,##0.00');
        $currentRow += 2;

        // --- TERBILANG ---
        $sheet->mergeCells("A{$currentRow}:C{$currentRow}");
        $sheet->setCellValue("A{$currentRow}", 'Terbilang: ' . $this->terbilang($total) . ' Rupiah');
        $sheet->getStyle("A{$currentRow}")->getFont()->setItalic(true);
        $currentRow += 2;

        // --- TANDA TANGAN ---
        $sheet->setCellValue("A{$currentRow}", 'Jayapura, ' . \Carbon\Carbon::parse($rab->created_at)->format('d F Y'));
        $sheet->setCellValue("C{$currentRow}", 'Jayapura, ' . \Carbon\Carbon::parse($rab->created_at)->format('d F Y'));
        $currentRow++;

        $sheet->setCellValue("A{$currentRow}", 'Untuk dan atas nama');
        $sheet->setCellValue("C{$currentRow}", 'Untuk dan atas nama');
        $currentRow++;

        $sheet->setCellValue("A{$currentRow}", 'PENYEDIA');
        $sheet->setCellValue("C{$currentRow}", 'Pemerintah Provinsi Papua');
        $currentRow++;

        $sheet->setCellValue("A{$currentRow}", $rab->nama_perusahaan_penyedia);
        $sheet->setCellValue("C{$currentRow}", 'PEJABAT PENANDATANGAN KONTRAK');
        $currentRow++;

        $sheet->setCellValue("C{$currentRow}", 'Dinas PUPR Papua');
        $currentRow += 3; // Spasi untuk tanda tangan

        $sheet->setCellValue("A{$currentRow}", $rab->nama_penyedia);
        $sheet->setCellValue("C{$currentRow}", $rab->nama_pejabat_penandatangan_kontrak);
        $currentRow++;

        $sheet->setCellValue("A{$currentRow}", $rab->jabatan_penyedia);
        $sheet->setCellValue("C{$currentRow}", $rab->jabatan_pejabat);
        $currentRow++;

        $sheet->setCellValue("C{$currentRow}", 'NIP. ' . $rab->nip_pejabat);

        // Set lebar kolom
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(60);
        $sheet->getColumnDimension('C')->setWidth(25);

        // Style border untuk tabel utama
        $tableStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ];
        $sheet->getStyle('A13:C' . ($currentRow - 1))->applyFromArray($tableStyle);

        // --- PROSES DOWNLOAD ---
        $writer = new Xlsx($spreadsheet);
        $fileName = 'RAB_' . str_replace(' ', '_', $rab->pekerjaan) . '_' . Carbon::now()->format('YmdHis') . '.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), 'RAB_');

        $writer->save($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }

    // Method untuk download PDF
public function downloadPdf(Rab $rab)
{
    // Hitung total
    $jumlahAB = $rab->jumlah_biaya_langsung_personal + $rab->jumlah_biaya_langsung_non_personal;
    $ppn = $jumlahAB * 0.11;
    $total = $jumlahAB + $ppn;

    // Filter dan format items
    $personalItems = $this->filterItems($rab->uraian_kegiatan_biaya_langsung_personal ?? []);
    $nonPersonalItems = $this->filterItems($rab->uraian_kegiatan_biaya_langsung_non_personal ?? []);

    // Terbilang
    $terbilang = $this->terbilang($total);

    return Pdf::loadView('RAB.pdf', [
        'rab' => $rab,
        'jumlahAB' => $jumlahAB,
        'ppn' => $ppn,
        'total' => $total,
        'terbilang' => $terbilang,
        'personalItems' => $personalItems,
        'nonPersonalItems' => $nonPersonalItems,
    ])->setPaper('a4', 'portrait')
      ->setOption('isRemoteEnabled', true)
      ->download('RAB_' . str_replace(' ', '_', $rab->pekerjaan) . '.pdf');
}

public static function terbilangHelper($angka)
{
    return (new self)->terbilang($angka);
}
    // Helper method untuk filter items
private function filterItems($items)
{
    return collect($items)->filter(function($item) {
        return !empty($item['uraian']) || (isset($item['jumlah']) && $item['jumlah'] !== null && $item['jumlah'] !== '');
    })->map(function($item) {
        return [
            'uraian' => $item['uraian'] ?? '',
            'jumlah' => (float)($item['jumlah'] ?? 0),
        ];
    })->values()->all();
}

// Method untuk konversi angka ke terbilang
public function terbilang($angka)
{
    $angka = floatval($angka);
    $bilangan = [
        '',
        'satu',
        'dua',
        'tiga',
        'empat',
        'lima',
        'enam',
        'tujuh',
        'delapan',
        'sembilan',
        'sepuluh',
        'sebelas'
    ];

    if ($angka < 12) {
        return $bilangan[$angka];
    } elseif ($angka < 20) {
        return $bilangan[$angka - 10] . ' belas';
    } elseif ($angka < 100) {
        $hasil_bagi = (int)($angka / 10);
        $hasil_mod = $angka % 10;
        return trim(sprintf('%s puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
    } elseif ($angka < 200) {
        return sprintf('seratus %s', $this->terbilang($angka - 100));
    } elseif ($angka < 1000) {
        $hasil_bagi = (int)($angka / 100);
        $hasil_mod = $angka % 100;
        return trim(sprintf('%s ratus %s', $bilangan[$hasil_bagi], $this->terbilang($hasil_mod)));
    } elseif ($angka < 2000) {
        return trim(sprintf('seribu %s', $this->terbilang($angka - 1000)));
    } elseif ($angka < 1000000) {
        $hasil_bagi = (int)($angka / 1000);
        $hasil_mod = $angka % 1000;
        return sprintf('%s ribu %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod));
    } elseif ($angka < 1000000000) {
        $hasil_bagi = (int)($angka / 1000000);
        $hasil_mod = $angka % 1000000;
        return trim(sprintf('%s juta %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
    }

    return 'Angka terlalu besar';
}
}