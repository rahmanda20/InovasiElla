@extends('layouts.app')

@section('content')
<div class="container">

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif



    <!-- Tombol Tambah Judul -->
    <div class="col-12 mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahJudul">
            + Tambah
        </button>
    </div>

    <!-- Form Download ZIP -->
    <div class="col-12 mb-3">
        <form id="formDownloadZip" action="{{ route('dokumen.download-zip') }}" method="POST">
            @csrf

            <!-- Pilih Judul Surat -->
            <div class="mb-3">
                <label for="judulSelect">Pilih Judul Surat:</label>
                <select id="judulSelect" name="judul_surat" class="form-select" required>
                    <option value="">-- Pilih Judul Surat --</option>
                    @foreach($surats->pluck('judul_surat')->unique() as $judul)
                        <option value="{{ $judul }}">{{ $judul }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Jenis Dokumen Hidden -->
            <input type="hidden" name="jenis_dokumen" value="{{ $jenis }}">

            <!-- Container Checkbox Jenis Surat -->
            <div id="jenisSuratCheckboxes" class="mb-3" style="display: none;">
                <label for="jenis_surat">Pilih dokumen untuk diunduh (ZIP PDF):</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="checkAllJenisSurat">
                    <label class="form-check-label fw-bold" for="checkAllJenisSurat">
                        Pilih Semua
                    </label>
                </div>
                <div id="checkboxList" class="mt-2"></div>
            </div>

            <!-- Tombol Download -->
            <button type="submit" class="btn btn-success" style="display: none;" id="btnDownloadZip">
                Download ZIP PDF
            </button>
        </form>
    </div>

    <!-- Modal Tambah Judul -->
    <div class="modal fade" id="modalTambahJudul" tabindex="-1" aria-labelledby="modalTambahJudulLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('surat.mass-create') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahJudulLabel">Tambah Judul Dokumen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul dokumen" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Section Daftar Dokumen -->
    <div class="row">
        <div class="col-12">
            <div class="box no-shadow mb-0 bg-transparent">
                <div class="box-header no-border px-0">
                    <h4 class="section-title">
                        Perencanaan - Dokumen Kontrak ({{ strtoupper(str_replace('_', ' ', $jenis)) }})
                    </h4>
                </div>
            </div>
        </div>

        <hr />

        {{-- Rancangan Kontrak --}}
        @if(isset($suratOptions) && count($suratOptions) > 0)
        <div class="col-12">
            <button class="dashboard-btn">Rancangan Kontrak</button>
        </div>
        @foreach($suratOptions as $index => $option)
        <div class="col-xl-4 col-md-6 col-12 mb-4">
            <a href="{{ $option['slug'] === 'hps'
                ? route('rab.index', ['jenis_dokumen' => $jenis])
                : route('dokumen.list', ['jenis_dokumen' => $jenis, 'jenis_surat' => $option['slug']]) }}">
                <div class="box bg-white pull-up animate__animated {{ $index % 2 == 0 ? 'animate__lightSpeedInLeft' : 'animate__lightSpeedInRight' }}"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body d-flex align-items-center">
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">{{ $option['nama'] }}</h6>
                            <p class="text-fade mb-0 fs-12">{{ $option['deskripsi'] }}</p>
                        </div>
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="{{ asset('images/svg-icon/color-svg/' . $option['ikon']) }}"
                                 alt="Icon" style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
        @endif

        {{-- Dokumen Kontrak Lainnya --}}
        @if(isset($dokumenLainnyaOptions) && count($dokumenLainnyaOptions) > 0)
        <div class="col-12 mt-4">
            <button class="knowledge-btn">Dokumen Kontrak Lainnya</button>
        </div>
        @foreach($dokumenLainnyaOptions as $index => $option)
        <div class="col-xl-4 col-md-6 col-12 mb-4">
            <a href="{{ route('dokumen.list', ['jenis_dokumen' => $jenis, 'jenis_surat' => $option['slug']]) }}">
                <div class="box bg-white pull-up animate__animated {{ $index % 2 == 0 ? 'animate__lightSpeedInLeft' : 'animate__lightSpeedInRight' }}"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body d-flex align-items-center">
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">{{ $option['nama'] }}</h6>
                            <p class="text-fade mb-0 fs-12">{{ $option['deskripsi'] }}</p>
                        </div>
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="{{ asset('images/svg-icon/color-svg/' . $option['ikon']) }}"
                                 alt="Icon" style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
        @endif
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxList = document.getElementById('checkboxList');
        const checkAll = document.getElementById('checkAllJenisSurat');
        const jenisSuratContainer = document.getElementById('jenisSuratCheckboxes');
        const btnDownloadZip = document.getElementById('btnDownloadZip');
        const judulSelect = document.getElementById('judulSelect');
        const jenisDokumen = "{{ $jenis }}";

        judulSelect.addEventListener('change', function () {
            const judul = this.value;

            // Sembunyikan komponen jika belum ada judul
            if (!judul) {
                jenisSuratContainer.style.display = 'none';
                btnDownloadZip.style.display = 'none';
                checkboxList.innerHTML = '';
                return;
            }

            // Fetch data
            fetch(`/get-jenis-surat?judul=${encodeURIComponent(judul)}&jenis_dokumen=${encodeURIComponent(jenisDokumen)}`)
                .then(response => response.json())
                .then(result => {
                    if (result.status !== 'success' || !Array.isArray(result.data)) {
                        checkboxList.innerHTML = `<div class="text-muted fst-italic">Data tidak ditemukan.</div>`;
                        jenisSuratContainer.style.display = 'none';
                        btnDownloadZip.style.display = 'none';
                        return;
                    }

                    // Tampilkan checkbox
                    checkboxList.innerHTML = '';
                    result.data.forEach(surat => {
                        checkboxList.innerHTML += `
                            <div class="form-check form-check-inline">
                                <input class="form-check-input item-checkbox" type="checkbox"
                                    name="jenis_surat[]" value="${surat.jenis_surat}"
                                    id="check_${surat.id}">
                                <label class="form-check-label" for="check_${surat.id}">
                                    ${surat.jenis_surat.toUpperCase()}
                                </label>
                            </div>
                        `;
                    });

                    jenisSuratContainer.style.display = 'block';
                    btnDownloadZip.style.display = 'inline-block';

                    // Reset checkAll
                    checkAll.checked = false;
                })
                .catch(error => {
                    console.error('Gagal memuat data jenis surat:', error);
                    checkboxList.innerHTML = `<div class="text-danger">Gagal memuat data.</div>`;
                    jenisSuratContainer.style.display = 'none';
                    btnDownloadZip.style.display = 'none';
                });
        });

        // Tombol "Check All"
        checkAll.addEventListener('change', function () {
            const allItems = document.querySelectorAll('.item-checkbox');
            allItems.forEach(checkbox => {
                checkbox.checked = checkAll.checked;
            });
        });
    });
</script>

@endsection
