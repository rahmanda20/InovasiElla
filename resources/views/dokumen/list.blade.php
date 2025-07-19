@extends('layouts.app')

@section('styles')
<style>
    .table th, .table td {
        vertical-align: middle;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.85rem;
    }

    .card-header-custom {
        background: linear-gradient(45deg, #007bff, #0056b3);
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
        border-top-left-radius: 0.75rem;
        border-top-right-radius: 0.75rem;
        padding: 1rem;
    }

    .badge-info-custom {
        background-color: #17a2b8;
        color: white;
        padding: 0.3em 0.7em;
        border-radius: 0.5rem;
        font-size: 0.8rem;
    }

    .modal-content {
        border-radius: 1rem;
    }

    .modal-header {
        background: linear-gradient(45deg, #007bff, #0056b3);
        color: white;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
    }

    .info-box {
        background-color: #f0f8ff;
        border-radius: 0.75rem;
        padding: 0.75rem;
        font-size: 0.9rem;
        color: #333;
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-envelope me-2"></i> Surat - <strong>{{ strtoupper($jenis_dokumen) }} / {{ strtoupper($jenis_surat) }}</strong>
            </div>
            <a href="{{ route('dokumen.jenis', $jenis_dokumen) }}" class="btn btn-light btn-sm">
                <i class="fas fa-chevron-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card-body">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <div>
                    <span class="badge-info-custom">Dokumen: <strong>{{ strtoupper($jenis_dokumen) }}</strong></span>
                    <span class="badge-info-custom ms-2">Jenis Surat: <strong>{{ strtoupper($jenis_surat) }}</strong></span>
                </div>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahSurat">
                    <i class="fas fa-plus-circle me-1"></i> Tambah Surat
                </button>
            </div>

            @if($listSurat->count())
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>Judul Surat</th>
                            <th>Tanggal</th>
                            <th>File Excel</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listSurat as $index => $surat)
                        <tr @if(session('highlight_id') == $surat->id) class="table-success" @endif>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $surat->judul_surat }}</td>
                            <td class="text-center">
                                {{ $surat->created_at ? $surat->created_at->format('d-m-Y') : '-' }}
                            </td>
                            <td class="text-center">
                                @if($surat->file_excel)
                                    <a href="{{ route('dokumen.exportExcel', $surat->id) }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-file-excel"></i> Download
                                    </a>
                                @else
                                    <span class="badge bg-secondary">Belum tersedia</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <form action="{{ route('dokumen.delete', $surat->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus surat ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <div class="alert alert-info">Belum ada surat yang dibuat untuk jenis ini.</div>
            @endif
        </div>
    </div>
</div>

{{-- Modal Tambah Surat --}}
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
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <div class="modal-body">
                    <div class="info-box mb-3">
                        Anda sedang membuat surat jenis <strong>{{ ucfirst($jenis_surat) }}</strong>
                        untuk dokumen <strong>{{ ucfirst($jenis_dokumen) }}</strong>.
                        Silakan lengkapi judul surat di bawah ini.
                    </div>

                    <div class="mb-3">
                        <label for="judul_surat" class="form-label">Judul Surat</label>
                        <input type="text" name="judul_surat" id="judul_surat" class="form-control" required placeholder="Contoh: Surat Permohonan Pengadaan...">
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        @if (session('success') || session('error'))
            Swal.fire({
                title: @json(session('success') ? 'Berhasil!' : 'Peringatan!'),
                text: @json(session('success') ?? session('error')),
                icon: @json(session('success') ? 'success' : 'warning'),
                confirmButtonText: 'Tutup'
            });
        @endif
    });
</script>
@endsection
