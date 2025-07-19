@extends('layouts.app')
@section('content')
<h2>Tambah RAB</h2>

<form action="{{ route('rab.store') }}" method="POST">
    @csrf
    <div>
        <label>Pekerjaan</label>
        <input name="pekerjaan" required>
    </div>
    <div>
        <label>Lokasi</label>
        <input name="lokasi" required>
    </div>
    <div>
        <label>Masa Pelaksanaan</label>
        <input name="masa_pelaksanaan" required>
    </div>
    <div>
        <label>Sumber Dana</label>
        <input name="sumber_dana" required>
    </div>

    <hr>
    <h4>Biaya Personal</h4>
    <table id="tblPersonal">
        <tr>
            <th>Uraian</th><th>Jumlah</th><th></th>
        </tr>
    </table>
    <button type="button" onclick="addPersonal()">+ Tambah Personal</button>

    <hr>
    <h4>Biaya Non Personal</h4>
    <table id="tblNon">
        <tr>
            <th>Uraian</th><th>Jumlah</th><th></th>
        </tr>
    </table>
    <button type="button" onclick="addNon()">+ Tambah Non Personal</button>

    <hr>
    <h4>Penyedia & Pejabat</h4>
    <div><label>Nama Penyedia</label><input name="nama_penyedia" required></div>
    <div><label>Nama Perusahaan Penyedia</label><input name="nama_perusahaan_penyedia" required></div>
    <div><label>Jabatan Penyedia</label><input name="jabatan_penyedia" required></div>
    <div><label>Nama Pejabat TTD</label><input name="nama_pejabat_penandatangan_kontrak" required></div>
    <div><label>Jabatan Pejabat</label><input name="jabatan_pejabat" required></div>
    <div><label>NIP Pejabat</label><input name="nip_pejabat" required></div>

    <button type="submit">Simpan</button>
</form>

<script>
    let personalCount = 0; // Menggunakan variabel yang lebih deskriptif
    let nonPersonalCount = 0;

    function addPersonal(uraian = '', jumlah = '') {
        const table = document.getElementById('tblPersonal');
        const newRow = table.insertRow(-1); // Insert at the end

        const cell1 = newRow.insertCell(0);
        const cell2 = newRow.insertCell(1);
        const cell3 = newRow.insertCell(2);

        // **PERBAIKAN NAMA INPUT DI SINI**
        // Untuk mengirim data sebagai array of objects ke controller,
        // format name harus seperti 'nama_array[][key]'
        cell1.innerHTML = `<input type="text" name="uraian_kegiatan_biaya_langsung_personal[${personalCount}][uraian]" value="${uraian}" required>`;
        cell2.innerHTML = `<input type="number" step="0.01" name="uraian_kegiatan_biaya_langsung_personal[${personalCount}][jumlah]" value="${jumlah}" required>`;
        cell3.innerHTML = `<button type="button" onclick="this.closest('tr').remove()">×</button>`;
        
        personalCount++;
    }

    function addNon(uraian = '', jumlah = '') {
        const table = document.getElementById('tblNon');
        const newRow = table.insertRow(-1); // Insert at the end

        const cell1 = newRow.insertCell(0);
        const cell2 = newRow.insertCell(1);
        const cell3 = newRow.insertCell(2);

        // **PERBAIKAN NAMA INPUT DI SINI**
        cell1.innerHTML = `<input type="text" name="uraian_kegiatan_biaya_langsung_non_personal[${nonPersonalCount}][uraian]" value="${uraian}" required>`;
        cell2.innerHTML = `<input type="number" step="0.01" name="uraian_kegiatan_biaya_langsung_non_personal[${nonPersonalCount}][jumlah]" value="${jumlah}" required>`;
        cell3.innerHTML = `<button type="button" onclick="this.closest('tr').remove()">×</button>`;
        
        nonPersonalCount++;
    }

    // prefill default rows:
    ['Profesional Staf', 'Tenaga Ahli Sub Profesional', 'Tenaga Pendukung'].forEach(d => addPersonal(d, ''));
    ['Biaya Operasional Kantor', 'Biaya Dinas Allowance', 'Depresiasi Perlengkapan', 'Biaya Pelaporan'].forEach(d => addNon(d, ''));
</script>
@endsection