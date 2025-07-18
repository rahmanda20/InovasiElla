@extends('layouts.app')

@section('content')
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1>Edit Uraian</h1>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <p style="color: green">{{ session('success') }}</p>
                        @endif

                        <form action="{{ route('master.update', ['id' => $data->id, 'key' => $key]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Jenis Surat -->
                            <div class="form-group">
                                <label for="jenis_surat">Jenis Surat</label>
                                <select name="jenis_surat" id="jenissurat" class="form-control">
                                    <option value="" disabled>Pilih Jenis Surat</option>
                                    <option value="Pembangunan Bendungan" {{ old('jenis_surat', $jenis_surat) == 'Pembangunan Bendungan' ? 'selected' : '' }}>Pembangunan Bendungan</option>
                                    <option value="Pembangunan Embung dan Penampung Air Lainnya" {{ old('jenis_surat', $jenis_surat) == 'Pembangunan Embung dan Penampung Air Lainnya' ? 'selected' : '' }}>Pembangunan Embung dan Penampung Air Lainnya</option>
                                </select>
                            </div>

                            <!-- Uraian -->
                            <div class="form-group">
                                <label for="uraian">Uraian</label>
                                <input 
                                    type="text" 
                                    name="uraian" 
                                    class="form-control" 
                                    value="{{ old('uraian', $uraian) }}"
                                >
                            </div>

                            <!-- Nomor Berita Acara -->
                            <div class="form-group">
                                <label for="nomor_berita_acara">Nomor Berita Acara</label>
                                <input 
                                    type="text" 
                                    name="nomor_berita_acara" 
                                    class="form-control" 
                                    value="{{ old('nomor_berita_acara', $nomor_berita_acara) }}"
                                >
                            </div>

                            <!-- Tanggal -->
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input 
                                    type="text" 
                                    name="tanggal" 
                                    class="form-control" 
                                    value="{{ old('tanggal', $tanggal) }}"
                                >
                            </div>

                            <!-- Data Paket -->
                            <div class="form-group">
                                <label for="data_paket">Data Paket</label>
                                <input 
                                    type="text" 
                                    name="data_paket" 
                                    class="form-control" 
                                    value="{{ old('data_paket', $data_paket) }}"
                                >
                            </div>

                            <!-- Keterangan Data Paket -->
                            <div class="form-group">
                                <label for="keterangan_data_paket">Keterangan Data Paket</label>
                                <input 
                                    type="text" 
                                    name="keterangan_data_paket" 
                                    class="form-control" 
                                    value="{{ old('keterangan_data_paket', $keterangan_data_paket) }}"
                                >
                            </div>

                            <!-- Data Organisasi -->
                            <div class="form-group">
                                <label for="data_organisasi">Data Organisasi</label>
                                <input 
                                    type="text" 
                                    name="data_organisasi" 
                                    class="form-control" 
                                    value="{{ old('data_organisasi', $data_organisasi) }}"
                                >
                            </div>

                            <!-- Keterangan Organisasi -->
                            <div class="form-group">
                                <label for="keterangan_organisasi">Keterangan Organisasi</label>
                                <input 
                                    type="text" 
                                    name="keterangan_organisasi" 
                                    class="form-control" 
                                    value="{{ old('keterangan_organisasi', $keterangan_organisasi) }}"
                                >
                            </div>

                            <!-- Pejabat Pengadaan -->
                            <div class="form-group">
                                <label for="pejabat_pengadaan">Pejabat Pengadaan</label>
                                <input 
                                    type="text" 
                                    name="pejabat_pengadaan" 
                                    class="form-control" 
                                    value="{{ old('pejabat_pengadaan', $pejabat_pengadaan) }}"
                                >
                            </div>

                            <!-- Keterangan Pengadaan -->
                            <div class="form-group">
                                <label for="keterangan_pengadaan">Keterangan Pengadaan</label>
                                <input 
                                    type="text" 
                                    name="keterangan_pengadaan" 
                                    class="form-control" 
                                    value="{{ old('keterangan_pengadaan', $keterangan_pengadaan) }}"
                                >
                            </div>

                            <!-- Pejabat Pembuat Komitmen -->
                            <div class="form-group">
                                <label for="pejabat_pembuat_komitmen">Pejabat Pembuat Komitmen</label>
                                <input 
                                    type="text" 
                                    name="pejabat_pembuat_komitmen" 
                                    class="form-control" 
                                    value="{{ old('pejabat_pembuat_komitmen', $pejabat_pembuat_komitmen) }}"
                                >
                            </div>

                            <!-- Keterangan Komitmen -->
                            <div class="form-group">
                                <label for="keterangan_komitmen">Keterangan Komitmen</label>
                                <input 
                                    type="text" 
                                    name="keterangan_komitmen" 
                                    class="form-control" 
                                    value="{{ old('keterangan_komitmen', $keterangan_komitmen) }}"
                                >
                            </div>

                            <!-- Data Calon Penyedia -->
                            <div class="form-group">
                                <label for="data_calon_penyedia">Data Calon Penyedia</label>
                                <input 
                                    type="text" 
                                    name="data_calon_penyedia" 
                                    class="form-control" 
                                    value="{{ old('data_calon_penyedia', $data_calon_penyedia) }}"
                                >
                            </div>

                            <!-- Keterangan Penyedia -->
                            <div class="form-group">
                                <label for="keterangan_penyedia">Keterangan Penyedia</label>
                                <input 
                                    type="text" 
                                    name="keterangan_penyedia" 
                                    class="form-control" 
                                    value="{{ old('keterangan_penyedia', $keterangan_penyedia) }}"
                                >
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('master.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
