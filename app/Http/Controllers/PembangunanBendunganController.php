<?php

namespace App\Http\Controllers;

use App\Models\Master;
use Illuminate\Http\Request;

class PembangunanBendunganController extends Controller
{
    // Menampilkan form untuk input
    public function create()
    {
        return view('SumberDayaAir.PembangunanBendungan.Create');
    }

    // Menyimpan data ke database
    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required|string',
            // Tambahkan validasi lain jika diperlukan
        ]);

        Master::create($request->all());

        return redirect()->route('pembangunan-bendungan.index')->with('success', 'Data berhasil disimpan');
    }

    // Menampilkan semua data
    public function index()
    {
        // Ambil data dengan kondisi jenis_surat = 'PembangunanBendungan'
        $data = Master::where('jenis_surat', 'Pembangunan Bendungan')->get();
        
    
        return view('SumberDayaAir.PembangunanBendungan.index', compact('data'));
    }
    

    // Menampilkan form edit untuk uraian tertentu
    public function edit($id, $key)
    {
        $data = Master::findOrFail($id);

        // Gunakan default null jika key tidak ditemukan
        $uraian = $data->uraian[$key] ?? null;
        $nomor_berita_acara = $data->nomor_berita_acara[$key] ?? null;
        $tanggal = $data->tanggal[$key] ?? null;
        $jenis_surat = $data->jenis_surat ?? null;

        $data_paket = $data->data_paket[$key] ?? null;
        $keterangan_data_paket = $data->keterangan_data_paket[$key] ?? null;
        $data_organisasi = $data->data_organisasi[$key] ?? null;
        $keterangan_organisasi = $data->keterangan_organisasi[$key] ?? null;
        $pejabat_pengadaan = $data->pejabat_pengadaan[$key] ?? null;
        $keterangan_pengadaan = $data->keterangan_pengadaan[$key] ?? null;

        $pejabat_pembuat_komitmen = $data->pejabat_pembuat_komitmen[$key] ?? null;
        $keterangan_komitmen = $data->keterangan_komitmen[$key] ?? null;
        $data_calon_penyedia = $data->data_calon_penyedia[$key] ?? null;
        $keterangan_penyedia = $data->keterangan_penyedia[$key] ?? null;

        return view('SumberDayaAir.PembangunanBendungan.edit', compact(
            'data', 'key', 'uraian', 'nomor_berita_acara', 'tanggal', 'jenis_surat',
            'data_paket', 'keterangan_data_paket', 'data_organisasi', 'keterangan_organisasi', 'pejabat_pengadaan', 'keterangan_pengadaan',
            'pejabat_pembuat_komitmen', 'keterangan_komitmen', 'data_calon_penyedia', 'keterangan_penyedia'
        ));
    }

    public function update(Request $request, $id, $key)
    {
        $data = Master::findOrFail($id);

        $request->validate([
            'jenis_surat' => 'required|string',
            // Tambahkan validasi lain jika diperlukan
        ]);

        // Daftar field yang akan diupdate
        $fields = [
            'uraian', 'nomor_berita_acara', 'tanggal', 'data_paket', 'keterangan_data_paket',
            'data_organisasi', 'keterangan_organisasi', 'pejabat_pengadaan', 'keterangan_pengadaan',
            'pejabat_pembuat_komitmen', 'keterangan_komitmen', 'data_calon_penyedia', 'keterangan_penyedia'
        ];

        foreach ($fields as $field) {
            $arrayData = is_array($data->$field) ? $data->$field : [];
            $arrayData[$key] = $request->input($field, null);
            $data->$field = $arrayData;
        }

        // Update jenis_surat secara langsung
        $data->jenis_surat = $request->input('jenis_surat');

        $data->save();

        return redirect()->route('pembangunan-bendungan.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(Request $request, $id)
    {
        $data = Master::findOrFail($id);

        $fields = [
            'uraian', 'nomor_berita_acara', 'tanggal', 'data_paket', 'keterangan_data_paket',
            'data_organisasi', 'keterangan_organisasi', 'pejabat_pengadaan', 'keterangan_pengadaan',
            'pejabat_pembuat_komitmen', 'keterangan_komitmen', 'data_calon_penyedia', 'keterangan_penyedia'
        ];

        foreach ($fields as $field) {
            $arrayData = $data->$field ?? [];

            if (is_array($arrayData) && isset($arrayData[$request->key])) {
                unset($arrayData[$request->key]);
                $data->$field = array_values($arrayData); // Reset indeks array
            }
        }

        $data->updated_at = now();
        $data->save();

        return redirect()->route('pembangunan-bendungan.index')->with('success', 'Data berhasil dihapus');
    }
}
