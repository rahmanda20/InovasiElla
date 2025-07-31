@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">

    <!-- Header Section -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <nav>
                    <h5>Template Rancangan Kontrak</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href=""><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item active">{{ strtoupper($label) }}</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="fas fa-plus"></i> Tambah Template
                </button>
            </div>
        </div>
    </div>

    <hr>

    <!-- Table Section -->
    <!-- Table Section -->
<div class="box">
    <div class="box-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Pembuat</th>
                        <th>Dibuat Pada</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($templates->count())
                        @foreach($templates as $i => $t)
                            @php
                                $namaFile = basename($t->file_path);
                                $judulAsli = preg_replace('/^\d+_/', '', $namaFile);
                            @endphp
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>{{ $judulAsli }}</td>
                                <td class="text-center">{{ $t->creator->name ?? '-' }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($t->created_at)->translatedFormat('d F Y') }}</td>
                                <td class="text-center">
                                    @if($t->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('template.download', $t->id) }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                    
                                

                                    <button class="btn btn-danger btn-sm" onclick="konf('delete', {{ $t->id }})">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>

                                        @if(!$t->is_active)
                                        <button class="btn btn-primary btn-sm" onclick="konf('activate', {{ $t->id }})">
                                            <i class="fas fa-check-circle"></i> Aktifkan
                                        </button>
                                    @endif

                                    <form id="frm-activate-{{ $t->id }}" action="{{ route('template.activate', $t->id) }}" method="GET">
                                        @csrf
                                    </form>
                                    <form id="frm-delete-{{ $t->id }}" action="{{ route('template.delete', $t->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data tersedia</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>


</div>

<!-- Modal Tambah Template -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <form action="{{ route('template.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="jenis_surat" value="{{ $jenis }}">

                <div class="modal-header bg-white border-bottom-0 rounded-top px-4 pt-4">
                    <h5 class="modal-title fw-semibold">
                        <i class="fas fa-file-excel me-2 text-success"></i> Upload Template Excel
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <div class="modal-body px-4 pt-0">
                    <div class="mb-3">
                        <label for="file" class="form-label fw-semibold mb-1">Pilih File Excel</label>
                        <input type="file" name="file" id="file" class="form-control form-control-lg" accept=".xls,.xlsx" required>
                        <div class="form-text mt-1">
                            Hanya format <strong>.xls</strong> dan <strong>.xlsx</strong> yang diperbolehkan.
                        </div>
                    </div>
                </div>

              <div class="modal-footer border-0 px-4 pb-4 d-flex justify-content-end">
    <button type="button" class="btn btn-outline-secondary btn-sm me-2" data-bs-dismiss="modal">
        <i class="fas fa-times me-1"></i> Batal
    </button>
    <button type="submit" class="btn btn-success btn-sm">
        <i class="fas fa-save me-1"></i> Simpan Template
    </button>
</div>

            </form>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script>
    function konf(type, id) {
        const title = type === 'activate' ? 'Aktifkan Template?' : 'Hapus Template?';
        const text = type === 'activate'
            ? 'Template ini akan menjadi aktif dan yang lainnya dinonaktifkan.'
            : 'Template akan dihapus permanen.';
        const confirmButton = type === 'activate' ? 'Ya, Aktifkan' : 'Ya, Hapus';

        Swal.fire({
            title: title,
            text: text,
            icon: type === 'delete' ? 'warning' : 'question',
            showCancelButton: true,
            confirmButtonText: confirmButton,
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`frm-${type}-${id}`).submit();
            }
        });
    }

    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: @json(session('success')),
            confirmButtonColor: '#3085d6'
        });
    @elseif (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: @json(session('error')),
            confirmButtonColor: '#d33'
        });
    @endif
</script>
@endsection
