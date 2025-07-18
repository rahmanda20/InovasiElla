@extends('layouts.app')

@section('styles')
    <style>
        .form-control-sm {
            font-size: 0.85rem;
        }

        .modal-backdrop {
            display: none;
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

        .modal-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .badge-info-custom {
            background-color: #17a2b8;
            color: #fff;
            padding: 0.4em 0.75em;
            border-radius: 0.5rem;
            font-size: 0.85rem;
        }

        .card-header-custom {
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: #fff;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            padding: 1rem 1.25rem;
            font-size: 1.1rem;
            font-weight: 600;
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
{{-- Modal Tambah Surat --}}
<div class="modal fade show" id="modalTambahSurat" tabindex="-1" style="display: block;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <form action="{{ route('dokumen.store') }}" method="POST">
                @csrf
                <input type="hidden" name="jenis_dokumen" value="{{ $jenis_dokumen }}">
                <input type="hidden" name="jenis_surat" value="{{ $jenis_surat }}">

             <div class="modal-header bg-primary text-white rounded-top">
    <h5 class="modal-title">
        <i class="fas fa-plus-circle me-2"></i> Tambah Surat
    </h5>
    <a href="{{ url()->current() }}" class="btn-close btn-close-white" aria-label="Close"></a>
</div>


             

                <div class="modal-body">
                    <div class="mb-3 text-center">
                        <span class="badge-info-custom">Dokumen: <strong>{{ strtoupper($jenis_dokumen) }}</strong></span>
                        <span class="badge-info-custom ms-2">Jenis Surat: <strong>{{ strtoupper($jenis_surat) }}</strong></span>
                    </div>

                    <div class="info-box mb-3">
                        Anda sedang membuat surat jenis <strong>{{ ucfirst($jenis_surat) }}</strong>
                        untuk keperluan dokumen <strong>{{ ucfirst($jenis_dokumen) }}</strong>.
                        Silakan lengkapi judul surat di bawah ini untuk memulai proses pembuatan dokumen resmi.
                    </div>

                    <div class="mb-3">
                        <label for="judul_surat" class="form-label">Judul Surat</label>
                        <input type="text" name="judul_surat" id="judul_surat" class="form-control" required autofocus placeholder="Contoh: Surat Permohonan Pengadaan...">
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                  <a href="{{ url('dokumen/pengadaan_langsung') }}" class="btn btn-secondary">
    <i class="fas fa-times me-1"></i> Batal
</a>

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
