@extends('layouts.app')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" />
<style>
    .section-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 1rem;
    }

    .dashboard-btn,
    .knowledge-btn {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        font-weight: bold;
        border: none;
        border-radius: 0.375rem;
        background-color: #007bff;
        color: white;
        transition: all 0.3s ease;
    }

    .dashboard-btn:hover,
    .knowledge-btn:hover {
        background-color: #0056b3;
        transform: translateY(-3px);
    }

    .select2-container--default .select2-selection--single {
        height: 42px;
        padding: 6px 12px;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: all 0.3s ease;
    }

    .select2-selection__rendered {
        color: #495057;
    }

    .select2-container--default .select2-selection--single:focus,
    .select2-container--default .select2-selection--single:hover {
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        border-color: #80bdff;
    }

    .card {
        min-height: 160px;
        transition: all 0.3s ease;
        border-radius: 0.75rem;
        overflow: hidden;
        position: relative;
        z-index: 1;
    }

    .card:hover {
        transform: scale(1.03);
        z-index: 10;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    #btnDownloadZip {
        margin-top: 1rem;
    }

    @media (max-width: 768px) {
        .section-title {
            font-size: 1.25rem;
        }

        .dashboard-btn,
        .knowledge-btn {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }

        .card-body {
            flex-direction: column;
            text-align: center;
        }

        .card-body .w-75,
        .card-body .w-25 {
            width: 100% !important;
        }

        #btnDownloadZip {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="container animate__animated animate__fadeIn pt-5">
    {{-- Form Judul --}}
    <div class="card shadow p-4 mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
            <h4 class="section-title mb-0">Kelola Judul Dokumen</h4>
            <button class="btn btn-primary animate__animated animate__pulse" data-bs-toggle="modal" data-bs-target="#modalTambahJudul">
                + Tambah Judul
            </button>
        </div>

        <form id="formDownloadZip" action="{{ route('dokumen.download-zip') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="judulSelect" class="form-label">Pilih Judul Surat:</label>
                <select id="judulSelect" name="judul_surat" class="form-select select2" required>
                    <option value="">-- Pilih Judul Surat --</option>
                    @foreach($surats->pluck('judul_surat')->unique() as $judul)
                        <option value="{{ $judul }}">{{ $judul }}</option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="jenis_dokumen" value="{{ $jenis }}">

            <div id="jenisSuratCheckboxes" class="mb-3" style="display: none;">
                <label for="jenis_surat" class="form-label">Pilih dokumen untuk diunduh (ZIP PDF):</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="checkAllJenisSurat">
                    <label class="form-check-label fw-bold" for="checkAllJenisSurat">
                        Pilih Semua
                    </label>
                </div>
                <div id="checkboxList" class="mt-2"></div>
            </div>

            <button type="submit" class="btn btn-success" style="display: none;" id="btnDownloadZip">
                <i class="fas fa-file-archive"></i> Download ZIP PDF
            </button>
        </form>
    </div>

    {{-- Modal Tambah Judul --}}
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

    {{-- Section Daftar Dokumen --}}
    <div class="card shadow p-4 mt-4">
        <div class="row">
            <div class="col-12">
                <h4 class="section-title">Perencanaan - Dokumen Kontrak ({{ strtoupper(str_replace('_', ' ', $jenis)) }})</h4>
            </div>

            @if(isset($suratOptions) && count($suratOptions) > 0)
                <div class="col-12">
                    <button class="dashboard-btn mb-3">Rancangan Kontrak</button>
                </div>
                @foreach($suratOptions as $index => $option)
                <div class="col-xl-4 col-md-6 col-12 mb-4">
                    <a href="{{ $option['slug'] === 'hps'
                        ? route('rab.index', ['jenis_dokumen' => $jenis])
                        : route('dokumen.list', ['jenis_dokumen' => $jenis, 'jenis_surat' => $option['slug']]) }}">
                        <div class="card shadow animate__animated animate__fadeInUp">
                            <div class="card-body d-flex align-items-center">
                                <div class="w-75">
                                    <h6 class="fw-bold">{{ $option['nama'] }}</h6>
                                    <p class="text-muted small">{{ $option['deskripsi'] }}</p>
                                </div>
                                <div class="w-25 text-end">
                                    <img src="{{ asset('images/svg-icon/color-svg/' . $option['ikon']) }}" alt="Icon" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            @endif

            @if(isset($dokumenLainnyaOptions) && count($dokumenLainnyaOptions) > 0)
                <div class="col-12 mt-4">
                    <button class="knowledge-btn mb-3">Dokumen Kontrak Lainnya</button>
                </div>
                @foreach($dokumenLainnyaOptions as $index => $option)
                <div class="col-xl-4 col-md-6 col-12 mb-4">
                    <a href="{{ route('dokumen.list', ['jenis_dokumen' => $jenis, 'jenis_surat' => $option['slug']]) }}">
                        <div class="card shadow animate__animated animate__fadeInUp">
                            <div class="card-body d-flex align-items-center">
                                <div class="w-75">
                                    <h6 class="fw-bold">{{ $option['nama'] }}</h6>
                                    <p class="text-muted small">{{ $option['deskripsi'] }}</p>
                                </div>
                                <div class="w-25 text-end">
                                    <img src="{{ asset('images/svg-icon/color-svg/' . $option['ikon']) }}" alt="Icon" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#judulSelect').select2({
            placeholder: 'Pilih Judul Surat',
            allowClear: true,
            width: '100%',
        }).on('select2:open', function () {
            $('.select2-dropdown').addClass('animate__animated animate__fadeInDown');
        });

        @if(session('success'))
            Swal.fire({ icon: 'success', title: 'Berhasil', html: `{!! session('success') !!}`, confirmButtonColor: '#3085d6' });
        @endif
        @if(session('error'))
            Swal.fire({ icon: 'error', title: 'Gagal', html: `{!! session('error') !!}`, confirmButtonColor: '#d33' });
        @endif

        const checkboxList = $('#checkboxList');
        const checkAll = $('#checkAllJenisSurat');
        const jenisSuratContainer = $('#jenisSuratCheckboxes');
        const btnDownloadZip = $('#btnDownloadZip');
        const jenisDokumen = "{{ $jenis }}";

        $('#judulSelect').on('change', function () {
            const judul = $(this).val();
            if (!judul) {
                jenisSuratContainer.hide();
                btnDownloadZip.hide();
                checkboxList.empty();
                return;
            }
            fetch(`/get-jenis-surat?judul=${encodeURIComponent(judul)}&jenis_dokumen=${encodeURIComponent(jenisDokumen)}`)
                .then(response => response.json())
                .then(result => {
                    checkboxList.empty();
                    if (result.status !== 'success' || !Array.isArray(result.data)) {
                        checkboxList.html(`<div class="text-muted fst-italic">Data tidak ditemukan.</div>`);
                        jenisSuratContainer.hide();
                        btnDownloadZip.hide();
                        return;
                    }
                    result.data.forEach(surat => {
                        checkboxList.append(`
                            <div class="form-check form-check-inline">
                                <input class="form-check-input item-checkbox" type="checkbox" name="jenis_surat[]" value="${surat.jenis_surat}" id="check_${surat.id}">
                                <label class="form-check-label" for="check_${surat.id}">${surat.jenis_surat.toUpperCase()}</label>
                            </div>
                        `);
                    });
                    jenisSuratContainer.show();
                    btnDownloadZip.show();
                    checkAll.prop('checked', false);
                })
                .catch(error => {
                    checkboxList.html(`<div class="text-danger">Gagal memuat data.</div>`);
                    jenisSuratContainer.hide();
                    btnDownloadZip.hide();
                });
        });

        checkAll.on('change', function () {
            $('.item-checkbox').prop('checked', $(this).is(':checked'));
        });
    });
</script>
@endsection
