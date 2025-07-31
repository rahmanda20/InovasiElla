@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="page-header-title mb-3" style="font-weight: 600;  font-size: 1.2rem;">
                    Dokumen Pengadaan
                </h5>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2" style="--bs-breadcrumb-divider: '>'; font-size: 0.95rem; background: none; box-shadow: none; padding: 0;">
                        <li class="breadcrumb-item">
                            <a href="/" style="text-decoration: none; ">
                                <i class="mdi mdi-home-outline me-1"></i>Dokumen Pengadaan
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/dokumen" style="text-decoration: none; ">
                                Perencanaan
                            </a>
                        </li>
                        <li class="breadcrumb-item active" style="" aria-current="page">
                            {{ strtoupper(str_replace('_', ' ', $jenis)) }}
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="col-auto">
                <div class="btn-group" role="group">
                    <button class="btn btn-info animate__animated animate__pulse" data-bs-toggle="modal" data-bs-target="#modalTambahJudul">
                        + Tambah Judul
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container animate__animated animate__fadeIn pt-5">
        {{-- Form Judul --}}
        <div class="card shadow p-4 mb-4">
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
                    <label for="jenis_surat" class="form-label">Pilih dokumen untuk diunduh:</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkAllJenisSurat">
                        <label class="form-check-label fw-bold" for="checkAllJenisSurat">
                            Pilih Semua
                        </label>
                    </div>
                    <div id="checkboxList" class="mt-2"></div>
                </div>

                <button type="submit" class="btn btn-success" style="display: none;" id="btnDownloadZip">
                    <i class="fas fa-file-archive"></i> Download 
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
                </div>

                @if(isset($suratOptions) && count($suratOptions) > 0)
                    <div class="col-12">
                        <button class="dashboard-btn mb-3">Rancangan Kontrak</button>
                    </div>
                    <div class="row">
                        @foreach($suratOptions as $index => $option)
                        <div class="col-xl-4 col-md-6 col-12 mb-4">
                            <a href="{{ $option['slug'] === 'hps'
                                ? route('rab.index', ['jenis_dokumen' => $jenis])
                                : route('dokumen.list', ['jenis_dokumen' => $jenis, 'jenis_surat' => $option['slug']]) }}">
                                <div class="box bg-white pull-up animate__animated animate__lightSpeedInLeft" style="border-bottom: 5px solid #3AA4F2;">
                                    <div class="box-body" style="display: flex; align-items: center;">
                                        <div style="flex: 0 0 60%; padding-right: 15px;">
                                            <h6 class="mt-25 mb-5" style="color: #3498db;">{{ $option['nama'] }}</h6>
                                            <p class="text-fade mb-0 fs-12" style="color: #3498db;">{{ $option['deskripsi'] }}</p>
                                        </div>
                                        <div style="flex: 0 0 40%; padding-left: 15px;">
                                            <img src="{{ asset('images/svg-icon/color-svg/' . $option['ikon']) }}" alt="Icon" style="width: 100%; height: 100px; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                @endif

                @if(isset($dokumenLainnyaOptions) && count($dokumenLainnyaOptions) > 0)
                    <div class="col-12 mt-4">
                        <button class="knowledge-btn mb-3">Dokumen Kontrak Lainnya</button>
                    </div>
                    <div class="row">
                        @foreach($dokumenLainnyaOptions as $index => $option)
                        <div class="col-xl-4 col-md-6 col-12 mb-4">
                            <a href="{{ route('dokumen.list', ['jenis_dokumen' => $jenis, 'jenis_surat' => $option['slug']]) }}">
                                <div class="box bg-white pull-up animate__animated animate__lightSpeedInRight" style="border-bottom: 5px solid #3AA4F2;">
                                    <div class="box-body" style="display: flex; align-items: center;">
                                        <div style="flex: 0 0 60%; padding-right: 15px;">
                                            <h6 class="mt-25 mb-5" style="color: #3498db;">{{ $option['nama'] }}</h6>
                                            <p class="text-fade mb-0 fs-12" style="color: #3498db;">{{ $option['deskripsi'] }}</p>
                                        </div>
                                        <div style="flex: 0 0 40%; padding-left: 15px;">
                                            <img src="{{ asset('images/svg-icon/color-svg/' . $option['ikon']) }}" alt="Icon" style="width: 100%; height: 100px; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
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