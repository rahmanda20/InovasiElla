<?php

namespace App\Http\Controllers;

use App\Models\Rab;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class RabController extends Controller
{
    public function index()
    {
        $rabs = Rab::all();
        return view('rab.index', compact('rabs'));
    }

    public function create()
    {
        return view('rab.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pekerjaan' => 'required|string',
            'lokasi' => 'required|string',
            'masa_pelaksanaan' => 'required|string',
            'sumber_dana' => 'required|string',
            // Validasi untuk data personal
            'biaya_langsung_personil_profesional_staf.*.uraian' => 'required|string',
            'biaya_langsung_personil_profesional_staf.*.volume' => 'required|numeric',
            'biaya_langsung_personil_profesional_staf.*.satuan' => 'required|string',
            'biaya_langsung_personil_profesional_staf.*.harga_satuan' => 'required|numeric',
            // Validasi untuk data non personal
            'biaya_langsung_non_personil_biaya_operasional_kantor.*.uraian' => 'required|string',
            'biaya_langsung_non_personil_biaya_operasional_kantor.*.jumlah' => 'required|numeric',
            'biaya_langsung_non_personil_biaya_operasional_kantor.*.satuan' => 'required|string',
            'biaya_langsung_non_personil_biaya_operasional_kantor.*.harga_satuan' => 'required|numeric',
            // Data penyedia dan pejabat
            'nama_penyedia' => 'required|string',
            'nama_perusahaan_penyedia' => 'required|string',
            'jabatan_penyedia' => 'required|string',
            'nama_pejabat_penandatangan_kontrak' => 'required|string',
            'jabatan_pejabat' => 'required|string',
            'nip_pejabat' => 'required|string',
        ]);

        // Proses data personal
        $profesionalStaf = $this->processProfesionalStaf($request->biaya_langsung_personil_profesional_staf);
        $tenagaAhliSub = $this->processTenagaAhliSub($request->biaya_langsung_personil_tenaga_ahli_sub_profesional);
        $tenagaPendukung = $this->processTenagaPendukung($request->biaya_langsung_personil_tenaga_pendukung);

        // Proses data non personal
        $operasionalKantor = $this->processOperasionalKantor($request->biaya_langsung_non_personil_biaya_operasional_kantor);
        $perjalananDinas = $this->processNonPersonil($request->biaya_perjalanan_dinas, 'biaya_perjalanan_dinas');
        $depresiasi = $this->processNonPersonil($request->depresiasi, 'depresiasi');
        $biayaPelaporan = $this->processNonPersonil($request->biaya_pelaporan, 'biaya_pelaporan');

        // Hitung total
        $totalProfesional = collect($profesionalStaf)->sum('jumlah_harga');
        $totalTenagaAhli = collect($tenagaAhliSub)->sum('jumlah_biaya');
        $totalTenagaPendukung = collect($tenagaPendukung)->sum('jumlah_biaya');
        $totalOperasional = collect($operasionalKantor)->sum('jumlah_biaya');
        $totalPerjalanan = collect($perjalananDinas)->sum('jumlah_biaya');
        $totalDepresiasi = collect($depresiasi)->sum('jumlah_biaya');
        $totalPelaporan = collect($biayaPelaporan)->sum('jumlah_biaya');

        $totalPersonal = $totalProfesional + $totalTenagaAhli + $totalTenagaPendukung;
        $totalNonPersonal = $totalOperasional + $totalPerjalanan + $totalDepresiasi + $totalPelaporan;
        $jumlahAB = $totalPersonal + $totalNonPersonal;
        $ppn = $jumlahAB * 0.11;
        $totalAll = $jumlahAB + $ppn;

        // Format uraian kegiatan untuk disimpan di database
        $uraianPersonal = [
            ['uraian' => 'Profesional Staf', 'jumlah' => $totalProfesional],
            ['uraian' => 'Tenaga Ahli Sub Profesional', 'jumlah' => $totalTenagaAhli],
            ['uraian' => 'Tenaga Pendukung', 'jumlah' => $totalTenagaPendukung]
        ];

        $uraianNonPersonal = [
            ['uraian' => 'Biaya Operasional Kantor', 'jumlah' => $totalOperasional],
            ['uraian' => 'Biaya Dinas Allowance', 'jumlah' => $totalPerjalanan],
            ['uraian' => 'Depresiasi Perlengkapan', 'jumlah' => $totalDepresiasi],
            ['uraian' => 'Biaya Pelaporan', 'jumlah' => $totalPelaporan]
        ];

        // Simpan ke database
        Rab::create([
            'pekerjaan' => $request->pekerjaan,
            'lokasi' => $request->lokasi,
            'masa_pelaksanaan' => $request->masa_pelaksanaan,
            'sumber_dana' => $request->sumber_dana,
            'uraian_kegiatan_biaya_langsung_personal' => $uraianPersonal,
            'uraian_kegiatan_biaya_langsung_non_personal' => $uraianNonPersonal,
            'biaya_langsung_personil_profesional_staf' => $profesionalStaf,
            'biaya_langsung_personil_tenaga_ahli_sub_profesional' => $tenagaAhliSub,
            'biaya_langsung_personil_tenaga_pendukung' => $tenagaPendukung,
            'biaya_langsung_non_personil_biaya_operasional_kantor' => $operasionalKantor,
            'biaya_perjalanan_dinas' => $perjalananDinas,
            'depresiasi' => $depresiasi,
            'biaya_pelaporan' => $biayaPelaporan,
            'jumlah_biaya_langsung_personil_profesional_staf' => $totalProfesional,
            'jumlah_biaya_langsung_personil_tenaga_ahli_sub_profesional' => $totalTenagaAhli,
            'jumlah_biaya_langsung_personil_tenaga_pendukung' => $totalTenagaPendukung,
            'jumlah_biaya_langsung_non_personil_biaya_operasional_kantor' => $totalOperasional,
            'jumlah_biaya_perjalanan_dinas' => $totalPerjalanan,
            'jumlah_depresiasi' => $totalDepresiasi,
            'jumlah_biaya_pelaporan' => $totalPelaporan,
            'jumlah_biaya_langsung_personal' => $totalPersonal,
            'jumlah_biaya_langsung_non_personal' => $totalNonPersonal,
            'total_keseluruhan' => $totalAll,
            'ppn' => $ppn,
            'nama_penyedia' => $request->nama_penyedia,
            'nama_perusahaan_penyedia' => $request->nama_perusahaan_penyedia,
            'jabatan_penyedia' => $request->jabatan_penyedia,
            'nama_pejabat_penandatangan_kontrak' => $request->nama_pejabat_penandatangan_kontrak,
            'jabatan_pejabat' => $request->jabatan_pejabat,
            'nip_pejabat' => $request->nip_pejabat,
            'terbilang' => $this->terbilang($totalAll) . ' Rupiah'
        ]);

        return redirect()->route('rab.index')->with('success', 'RAB berhasil disimpan');
    }

    // Method untuk memproses data profesional staf
    private function processProfesionalStaf($items)
    {
        return collect($items)->map(function($item) {
            return [
                'uraian' => $item['uraian'],
                'volume' => (float)$item['volume'],
                'satuan' => $item['satuan'],
                'harga_satuan' => (float)$item['harga_satuan'],
                'jumlah_harga' => (float)$item['volume'] * (float)$item['harga_satuan'],
                'sub_items' => isset($item['sub_items']) ? $this->processSubItems($item['sub_items']) : []
            ];
        })->toArray();
    }

    // Method untuk memproses data tenaga ahli
    private function processTenagaAhliSub($items)
    {
        return collect($items)->map(function($item) {
            return [
                'personil' => $item['personil'],
                'jumlah' => (float)$item['jumlah'],
                'satuan' => $item['satuan'],
                'harga_satuan' => (float)$item['harga_satuan'],
                'jumlah_biaya' => (float)$item['jumlah'] * (float)$item['harga_satuan'],
                'sub_items' => isset($item['sub_items']) ? $this->processSubItems($item['sub_items']) : []
            ];
        })->toArray();
    }

    // Method untuk memproses data tenaga pendukung
    private function processTenagaPendukung($items)
    {
        return collect($items)->map(function($item) {
            return [
                'personil' => $item['personil'],
                'jumlah' => (float)$item['jumlah'],
                'satuan' => $item['satuan'],
                'harga_satuan' => (float)$item['harga_satuan'],
                'jumlah_biaya' => (float)$item['jumlah'] * (float)$item['harga_satuan'],
                'sub_items' => isset($item['sub_items']) ? $this->processSubItems($item['sub_items']) : []
            ];
        })->toArray();
    }

    // Method untuk memproses data operasional kantor
    private function processOperasionalKantor($items)
    {
        return collect($items)->map(function($item) {
            return [
                'uraian' => $item['uraian'],
                'jumlah' => (float)$item['jumlah'],
                'satuan' => $item['satuan'],
                'harga_satuan' => (float)$item['harga_satuan'],
                'jumlah_biaya' => (float)$item['jumlah'] * (float)$item['harga_satuan'],
                'sub_items' => isset($item['sub_items']) ? $this->processSubItems($item['sub_items']) : []
            ];
        })->toArray();
    }

    // Method untuk memproses data non personil lainnya
    private function processNonPersonil($items, $jenis)
    {
        return collect($items)->map(function($item) use ($jenis) {
            return [
                'uraian' => $item['uraian'],
                'jumlah' => (float)$item['jumlah'],
                'satuan' => $item['satuan'],
                'harga_satuan' => (float)$item['harga_satuan'],
                'jumlah_biaya' => (float)$item['jumlah'] * (float)$item['harga_satuan'],
                'jenis' => $jenis,
                'sub_items' => isset($item['sub_items']) ? $this->processSubItems($item['sub_items']) : []
            ];
        })->toArray();
    }

    // Method untuk memproses sub items
    private function processSubItems($subItems)
    {
        return collect($subItems)->map(function($subItem) {
            return [
                'uraian' => $subItem['uraian'],
                'jumlah' => (float)$subItem['jumlah'],
                'satuan' => $subItem['satuan'],
                'harga_satuan' => (float)$subItem['harga_satuan'],
                'jumlah_biaya' => (float)$subItem['jumlah_biaya']
            ];
        })->toArray();
    }

    public function show(Rab $rab)
    {
        $jumlahAB = $rab->jumlah_biaya_langsung_personal + $rab->jumlah_biaya_langsung_non_personal;
        $ppn = $jumlahAB * 0.11;
        $total = $jumlahAB + $ppn;
        $terbilangText = $rab->terbilang ?? $this->terbilang($total);

        return view('rab.show', compact('rab', 'jumlahAB', 'ppn', 'total', 'terbilangText'));
    }

    public function destroy(Rab $rab)
    {
        $rab->delete();
        return redirect()->route('rab.index')->with('success', 'RAB berhasil dihapus.');
    }

    public function downloadExcel(Rab $rab)
    {
        // ... (implementasi download Excel)
    }

    public function downloadPdf(Rab $rab)
    {
        $jumlahAB = $rab->jumlah_biaya_langsung_personal + $rab->jumlah_biaya_langsung_non_personal;
        $ppn = $jumlahAB * 0.11;
        $total = $jumlahAB + $ppn;

        $pdf = Pdf::loadView('rab.pdf', [
            'rab' => $rab,
            'jumlahAB' => $jumlahAB,
            'ppn' => $ppn,
            'total' => $total,
            'terbilang' => $rab->terbilang ?? $this->terbilang($total),
            'profesionalStaf' => $rab->biaya_langsung_personil_profesional_staf ?? [],
            'tenagaAhliSub' => $rab->biaya_langsung_personil_tenaga_ahli_sub_profesional ?? [],
            'tenagaPendukung' => $rab->biaya_langsung_personil_tenaga_pendukung ?? [],
            'operasionalKantor' => $rab->biaya_langsung_non_personil_biaya_operasional_kantor ?? [],
            'perjalananDinas' => $rab->biaya_perjalanan_dinas ?? [],
            'depresiasi' => $rab->depresiasi ?? [],
            'biayaPelaporan' => $rab->biaya_pelaporan ?? []
        ]);

        return $pdf->setPaper('a4', 'portrait')
                   ->setOption('isRemoteEnabled', true)
                   ->download('RAB_' . str_replace(' ', '_', $rab->pekerjaan) . '.pdf');
    }

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