@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">

    <!-- Header Section -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <nav>
                    <h5>Dokumen Pengadaan</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href=""><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dokumen.jenis', $jenis_dokumen) }}">Dokumen</a></li>
                        <li class="breadcrumb-item active">{{ strtoupper($jenis_dokumen) }} - {{ strtoupper($jenis_surat) }}</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTambahSurat">
                    <i class="fas fa-plus"></i> Tambah Surat
                </button>
            </div>
        </div>
    </div>

    <hr />

    <!-- Table Section -->
   <div class="box">
    <div class="box-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Surat</th>
                        <th>Judul Surat</th>
                        <th>Tanggal Dibuat</th>
                        <th>Pembuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($listSurat->count())
                        @foreach($listSurat as $index => $surat)
                            <tr @if(session('highlight_id') == $surat->id) class="table-success" @endif>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $surat->nomor_surat ?? '-' }}</td>
                                <td>{{ $surat->judul_surat }}</td>
                                <td class="text-center">{{ $surat->created_at ? $surat->created_at->format('d-m-Y') : '-' }}</td>
                                <td class="text-center">{{ $surat->creator->name ?? '-' }}</td>
                                <td class="text-center">
                                    @if($surat->file_excel)
                                        <a href="{{ route('dokumen.exportExcel', $surat->id) }}" class="btn btn-success btn-sm mb-1">
                                            <i class="fas fa-file-excel"></i> Download
                                        </a>
                                    @endif

                                    <form action="{{ route('dokumen.delete', $surat->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-button">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">No data available</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal Tambah Surat -->
<div class="modal fade" id="modalTambahSurat" tabindex="-1" aria-labelledby="modalTambahSuratLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">
            <form action="{{ route('dokumen.store') }}" method="POST">
                @csrf
                <input type="hidden" name="jenis_dokumen" value="{{ $jenis_dokumen }}">
                <input type="hidden" name="jenis_surat" value="{{ $jenis_surat }}">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-plus-circle me-2"></i> Tambah Surat
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul_surat" class="form-label">Judul Surat</label>
                        <input type="text" name="judul_surat" id="judul_surat" class="form-control" required placeholder="Contoh: Surat Permohonan Pengadaan...">
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('.delete-button').forEach(button => {
        button.addEventListener('click', event => {
            event.preventDefault();
            const form = button.closest('form');
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: "Apakah Anda yakin ingin menghapus surat ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

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
