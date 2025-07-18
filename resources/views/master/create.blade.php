@extends('layouts.app')
@section('content')

<body>
    <h1>Tambah Master Data</h1>

    @if (session('success'))
    <p style="color: green">{{ session('success') }}</p>
    @endif

    <form action="{{ route('master.store') }}" method="POST">
        @csrf

        <!-- Jenis Surat -->
        <div class="form-group">
            <label for="jenis_surat">Nama program</label>
            <select name="jenis_surat" id="jenissurat" class="form-control select2">
                <option value="" disabled>Pilih Jenis Surat</option>
                <option value="Pembangunan Bendungan" selected>Pembangunan Bendungan</option>
                <option value="Pembangunan Embung dan Penampung Air Lainnya">Pembangunan Embung dan Penampung Air Lainnya</option>
            </select>
        </div>

             <div class="form-group">
            <label for="jenis_surat">Nama kegiatan</label>
            <select name="jenis_surat" id="jenissurat" class="form-control select2">
                <option value="" disabled>Pilih Jenis Surat</option>
                <option value="Pembangunan Bendungan" selected>Pembangunan Bendungan</option>
                <option value="Pembangunan Embung dan Penampung Air Lainnya">Pembangunan Embung dan Penampung Air Lainnya</option>
            </select>
        </div>
              <div class="form-group">
            <label for="jenis_surat">Nama pekerjaan</label>
            <select name="jenis_surat" id="jenissurat" class="form-control select2">
                <option value="" disabled>Pilih Jenis Surat</option>
                <option value="Pembangunan Bendungan" selected>Pembangunan Bendungan</option>
                <option value="Pembangunan Embung dan Penampung Air Lainnya">Pembangunan Embung dan Penampung Air Lainnya</option>
            </select>
        </div>

        <!-- Keterangan A -->
        <div class="container mt-5">
            <div class="form-group">
                <label for="KeteranganA">Uraian</label>
                <div id="KeteranganA" class="keterangan-group">
                    <!-- Baris pertama dengan nilai default -->
                    <div class="row mb-2">
                        <div class="col-4">
                            <input type="text" name="uraian[]" class="form-control" placeholder="Keterangan A" value="Berita Acara Hasil Pemilihan">
                        </div>
                        <div class="col-4">
                            <input type="text" name="nomor_berita_acara[]" class="form-control" placeholder="Nomor Berita Acara" value="001/BAP/2023">
                        </div>
                        <div class="col-4">
                            <input type="date" name="tanggal[]" class="form-control" value="2023-01-01">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <input type="text" name="uraian[]" class="form-control" placeholder="Keterangan A" value="SPPBJ">
                        </div>
                        <div class="col-4">
                            <input type="text" name="nomor_berita_acara[]" class="form-control" placeholder="Nomor Berita Acara" value="002/SPPBJ/2023">
                        </div>
                        <div class="col-4">
                            <input type="date" name="tanggal[]" class="form-control" value="2023-02-01">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <input type="text" name="uraian[]" class="form-control" placeholder="Keterangan A" value="Surat Perjanjian">
                        </div>
                        <div class="col-4">
                            <input type="text" name="nomor_berita_acara[]" class="form-control" placeholder="Nomor Berita Acara" value="003/SP/2023">
                        </div>
                        <div class="col-4">
                            <input type="date" name="tanggal[]" class="form-control" value="2023-03-01">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <input type="text" name="uraian[]" class="form-control" placeholder="Keterangan A" value="Surat Mulai Kerja">
                        </div>
                        <div class="col-4">
                            <input type="text" name="nomor_berita_acara[]" class="form-control" placeholder="Nomor Berita Acara" value="003/SP/2023">
                        </div>
                        <div class="col-4">
                            <input type="date" name="tanggal[]" class="form-control" value="2023-03-01">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <input type="text" name="uraian[]" class="form-control" placeholder="Keterangan A" value="Berita Acara Serah Terima lapangan">
                        </div>
                        <div class="col-4">
                            <input type="text" name="nomor_berita_acara[]" class="form-control" placeholder="Nomor Berita Acara" value="003/SP/2023">
                        </div>
                        <div class="col-4">
                            <input type="date" name="tanggal[]" class="form-control" value="2023-03-01">
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary mt-2" onclick="addKeteranganA()">Tambah Keterangan Lainnya</button>
            </div>
        </div>

        <div class="container mt-5">
    <div class="form-group">
        <label for="KeteranganA">Data K/L P/D</label>
        <div id="ketenganE" class="keterangan-group">
            <!-- Baris pertama dengan nilai default -->
            <div class="row mb-2">
                <div class="col-4">
                    <input type="text" name="data_organisasi[]" class="form-control" value="K/L/PD">
                </div>
                <div class="col-4">
                    <input type="text" name="keterangan_organisasi[]" class="form-control" placeholder="Keterangan">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4">
                    <input type="text" name="data_organisasi[]" class="form-control" value="Instansi">
                </div>
                <div class="col-4">
                    <input type="text" name="keterangan_organisasi[]" class="form-control" placeholder="Keterangan">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4">
                    <input type="text" name="data_organisasi[]" class="form-control" value="Satker">
                </div>
                <div class="col-4">
                    <input type="text" name="keterangan_organisasi[]" class="form-control" placeholder="Keterangan">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4">
                    <input type="text" name="data_organisasi[]" class="form-control" value="Alamat">
                </div>
                <div class="col-4">
                    <input type="text" name="keterangan_organisasi[]" class="form-control" placeholder="Keterangan">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4">
                    <input type="text" name="data_organisasi[]" class="form-control" value="SK PA/KPA/PPK">
                </div>
                <div class="col-4">
                    <input type="text" name="keterangan_organisasi[]" class="form-control">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4">
                    <input type="text" name="data_organisasi[]" class="form-control" value="Sumber Dana">
                </div>
                <div class="col-4">
                    <input type="text" name="keterangan_organisasi[]" class="form-control">
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary mt-2" onclick="addKeteranganE()">Tambah Keterangan Lainnya</button>
    </div>
</div>

        <div class="container mt-5">
        <div class="form-group">
            <label for="KeteranganA">Data PAKET PEKERJAAN</label>
            
            <!-- Baris pertama dengan nilai default -->
            <div id="ketenganB" class="keterangan-group">
                <div class="row mb-2">
                    <div class="col-4">
                        <input type="text" name="data_paket[]" class="form-control" value="Kode RUP">
                    </div>
                    <div class="col-4">
                        <input type="text" name="keterangan_data_paket[]" class="form-control" placeholder="Keterangan">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4">
                        <input type="text" name="data_paket[]" class="form-control" value="Nama paket">
                    </div>
                    <div class="col-4">
                        <input type="text" name="keterangan_data_paket[]" class="form-control" placeholder="Keterangan">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4">
                        <input type="text" name="data_paket[]" class="form-control" value="Nilai HPS">
                    </div>
                    <div class="col-4">
                        <input type="text" name="keterangan_data_paket[]" class="form-control" placeholder="Keterangan">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4">
                        <input type="text" name="data_organisasi[]" class="form-control" value="Nilai Pagu">
                    </div>
                    <div class="col-4">
                        <input type="text" name="keterangan_organisasi[]" class="form-control" placeholder="Keterangan">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4">
                        <input type="text" name="data_organisasi[]" class="form-control" value="Tahun Anggaran">
                    </div>
                    <div class="col-4">
                        <input type="text" name="keterangan_organisasi[]" class="form-control" placeholder="Keterangan">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4">
                        <input type="text" name="data_organisasi[]" class="form-control" value="Sumber Dana">
                    </div>
                    <div class="col-4">
                        <input type="text" name="keterangan_organisasi[]" class="form-control" placeholder="Keterangan">
                    </div>
                </div>
            </div>
            
            <button type="button" class="btn btn-secondary mt-2" onclick="addKeteranganB()">Tambah Keterangan Lainnya</button>
        </div>
    </div>
    </div>
        <div class="container mt-5">
    <div class="form-group">
        <label for="ketenganC">Data PEJABAT PENGADAAN</label>
        <div id="ketenganC" class="keterangan-group">
            <!-- Baris pertama dengan nilai default -->
            <div class="row mb-2">
                <div class="col-4">
                    <input type="text" name="pejabat_pengadaan[]" class="form-control" value="Nama Jabatan">
                </div>
                <div class="col-4">
                    <input type="text" name="keterangan_pengadaan[]" class="form-control" placeholder="Keterangan" value="">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4">
                    <input type="text" name="pejabat_pengadaan[]" class="form-control" value="Nomor Surat Keputusan">
                </div>
                <div class="col-4">
                    <input type="text" name="keterangan_pengadaan[]" class="form-control" placeholder="Keterangan" value="">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4">
                    <input type="text" name="pejabat_pengadaan[]" class="form-control" value="Nama">
                </div>
                <div class="col-4">
                    <input type="text" name="keterangan_pengadaan[]" class="form-control" placeholder="Keterangan" value="">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4">
                    <input type="text" name="pejabat_pengadaan[]" class="form-control" value="Nip">
                </div>
                <div class="col-4">
                    <input type="text" name="keterangan_pengadaan[]" class="form-control" placeholder="Keterangan" value="">
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary mt-2" onclick="addKeteranganC()">Tambah Keterangan Lainnya</button>
    </div>
</div>


        <div class="container mt-5">
            <div class="form-group">
                <label for="KeteranganA">DATA CALON PENYEDIA</label>
                <div id="ketenganD" class="keterangan-group">
                    <!-- Baris pertama dengan nilai default -->
                    <div class="row mb-2">
                        <div class="col-4">
                            <input type="text" name="data_calon_penyedia[]" class="form-control" value="Nama Calon Penyedia">
                        </div>
                        <div class="col-4">
                            <input type="text" name="keterangan_penyedia[]" class="form-control" placeholder="Keterangan" value="">
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <input type="text" name="data_calon_penyedia[]" class="form-control" value="Nama Wakil Calon Penyedia">
                        </div>
                        <div class="col-4">
                            <input type="text" name="keterangan_penyedia[]" class="form-control" placeholder="Keterangan" value="">
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <input type="text" name="data_calon_penyedia[]" class="form-control" value="Jabatan">
                        </div>
                        <div class="col-4">
                            <input type="text" name="keterangan_penyedia[]" class="form-control" placeholder="Keterangan" value="">
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <input type="text" name="data_calon_penyedia[]" class="form-control" value="NPWP">
                        </div>
                        <div class="col-4">
                            <input type="text" name="keterangan_penyedia[]" class="form-control" placeholder="Keterangan" value="">
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <input type="text" name="data_calon_penyedia[]" class="form-control" value="Alamat">
                        </div>
                        <div class="col-4">
                            <input type="text" name="keterangan_penyedia[]" class="form-control" placeholder="Keterangan" value="">
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <input type="text" name="data_calon_penyedia[]" class="form-control" value="Nomor Telepon">
                        </div>
                        <div class="col-4">
                            <input type="text" name="keterangan_penyedia[]" class="form-control" placeholder="Keterangan" value="">
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <input type="text" name="data_calon_penyedia[]" class="form-control" value="Harga Penawaran">
                        </div>
                        <div class="col-4">
                            <input type="text" name="keterangan_penyedia[]" class="form-control" placeholder="Keterangan" value="">
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <input type="text" name="data_calon_penyedia[]" class="form-control" value="Nomor Akta Pendirian Perusahaan">
                        </div>
                        <div class="col-4">
                            <input type="text" name="keterangan_penyedia[]" class="form-control" placeholder="Keterangan" value="">
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <input type="text" name="data_calon_penyedia[]" class="form-control" value="Tangggal Akta Perusaan">
                        </div>
                        <div class="col-4">
                            <input type="text" name="keterangan_penyedia[]" class="form-control" placeholder="Keterangan" value="">
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <input type="text" name="data_calon_penyedia[]" class="form-control" value="Notaris">
                        </div>
                        <div class="col-4">
                            <input type="text" name="keterangan_penyedia[]" class="form-control" placeholder="Keterangan" value="">
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <input type="text" name="data_calon_penyedia[]" class="form-control" value="Nomor Akta Perusahaan Terakhir">
                        </div>
                        <div class="col-4">
                            <input type="text" name="keterangan_penyedia[]" class="form-control" placeholder="Keterangan" value="">
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <input type="text" name="data_calon_penyedia[]" class="form-control" value="Nomor Rekening">
                        </div>
                        <div class="col-4">
                            <input type="text" name="keterangan_penyedia[]" class="form-control" placeholder="Keterangan" value="">
                        </div>

                    </div>

                </div>
                <button type="button" class="btn btn-secondary mt-2" onclick="addKetenganD()">Tambah Keterangan Lainnya</button>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    <script>
        function addKeteranganA() {
            const groupContainer = document.getElementById("KeteranganA");

            // Buat baris baru
            const row = document.createElement("div");
            row.className = "row mb-2";

            // Input untuk uraian
            const uraianCol = document.createElement("div");
            uraianCol.className = "col-4";
            const uraianInput = document.createElement("input");
            uraianInput.type = "text";
            uraianInput.name = "uraian[]";
            uraianInput.className = "form-control";
            uraianInput.placeholder = "Keterangan A";
            uraianInput.value = "Default Uraian";
            uraianCol.appendChild(uraianInput);

            // Input untuk nomor_berita_acara
            const nomorCol = document.createElement("div");
            nomorCol.className = "col-4";
            const nomorInput = document.createElement("input");
            nomorInput.type = "text";
            nomorInput.name = "nomor_berita_acara[]";
            nomorInput.className = "form-control";
            nomorInput.placeholder = "Nomor Berita Acara";
            nomorInput.value = "Default Nomor";
            nomorCol.appendChild(nomorInput);

            // Input untuk tanggal
            const tanggalCol = document.createElement("div");
            tanggalCol.className = "col-4";
            const tanggalInput = document.createElement("input");
            tanggalInput.type = "date";
            tanggalInput.name = "tanggal[]";
            tanggalInput.className = "form-control";
            tanggalInput.value = "2023-01-01";
            tanggalCol.appendChild(tanggalInput);

            // Gabungkan kolom ke dalam baris
            row.appendChild(uraianCol);
            row.appendChild(nomorCol);
            row.appendChild(tanggalCol);

            // Tambahkan baris ke dalam kontainer
            groupContainer.appendChild(row);
        }
    </script>
    <script>
    function addKetenganD() {
        const container = document.getElementById("ketenganD");
        const row = document.createElement("div");
        row.className = "row mb-2";
        row.innerHTML = `
            <div class="col-4">
                <input type="text" name="data_calon_penyedia[]" class="form-control" placeholder="Data Calon Penyedia">
            </div>
            <div class="col-4">
                <input type="text" name="keterangan_penyedia[]" class="form-control" placeholder="Keterangan">
            </div>
        `;
        container.appendChild(row);
    }
</script>
<script>
    function addKeteranganC() {
        const container = document.getElementById("ketenganC");
        const row = document.createElement("div");
        row.className = "row mb-2";
        row.innerHTML = `
            <div class="col-4">
                <input type="text" name="pejabat_pengadaan[]" class="form-control" placeholder="Pejabat Pengadaan">
            </div>
            <div class="col-4">
                <input type="text" name="keterangan_pengadaan[]" class="form-control" placeholder="Keterangan">
            </div>
        `;
        container.appendChild(row);
    }
      
</script>

<script>
    function addKeteranganE() {
        const container = document.getElementById("ketenganE");
        const row = document.createElement("div");
        row.className = "row mb-2";
        row.innerHTML = `
            <div class="col-4">
                <input type="text" name="data_organisasi[]" class="form-control" placeholder="Data Keterangan">
            </div>
            <div class="col-4">
                <input type="text" name="keterangan_organisasi[]" class="form-control" placeholder="Keterangan">
            </div>
        `;
        container.append(row); 
    }
</script>
<script>
    function addKeteranganB() {
        const container = document.getElementById("ketenganB");
        const row = document.createElement("div");
        row.className = "row mb-2";
        row.innerHTML = `
            <div class="col-4">
                <input type="text" name="data_paket[]" class="form-control" placeholder="Data Keterangan">
            </div>
            <div class="col-4">
                <input type="text" name="keterangan_data_paket[]" class="form-control" placeholder="Keterangan">
            </div>
        `;
        container.append(row); 
    }
</script>

    @endsection