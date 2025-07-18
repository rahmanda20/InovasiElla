@extends('layouts.app')
@section('content')

{{-- SweetAlert & jQuery --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Peninjauan Surat</h4>
            <button class="btn btn-light text-primary fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambahSurat">
                <i class="fas fa-plus-circle"></i> Tambah Peninjauan
            </button>
        </div>
        <div class="card-body">

            {{-- Tabel Surat --}}
            <h5 class="mb-3">Daftar Surat Ditinjau</h5>
            <div class="table-responsive">
                <table id="tableSurat" class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tanpa TTD</th>
                            <th>Dengan TTD</th>
                            <th>Reupload TTD</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($surats as $i => $surat)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $surat->judul }}</td>
                            <td>
                                <a href="{{ asset('storage/' . $surat->file_tanpa_ttd) }}" target="_blank" class="btn btn-sm btn-info">
                                    Download
                                </a>
                            </td>
                            <td>
                                @if($surat->file_dengan_ttd)
                                    <a href="{{ asset('storage/' . $surat->file_dengan_ttd) }}" target="_blank" class="btn btn-sm btn-info">
                                        Download
                                    </a>
                                @else
                                    <span class="text-muted">Belum Ada</span>
                                @endif
                            </td>
                            <td>
                                <form class="form-reupload-ttd" method="POST" action="{{ route('peninjauan.uploadTTD', $surat->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group">
                                        <input type="file" name="file_dengan_ttd" class="form-control" required>
                                        <button type="submit" class="btn btn-warning btn-sm">Upload Ulang</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

{{-- Modal Tambah Surat --}}
<div class="modal fade" id="modalTambahSurat" tabindex="-1" aria-labelledby="modalTambahSuratLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">
            <form method="POST" action="{{ route('peninjauan.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalTambahSuratLabel">Tambah Peninjauan Surat</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Judul tidak perlu diinput manual --}}
                    <div class="mb-3">
                        <label class="form-label">Upload Surat Tanpa TTD</label>
                        <input type="file" name="file_tanpa_ttd" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Upload Surat Dengan TTD</label>
                        <input type="file" name="file_dengan_ttd" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- SweetAlert Notifikasi --}}
@if (session('success') || session('error'))
<script>
    document.addEventListener("DOMContentLoaded", function () {
        Swal.fire({
            title: @json(session('success') ? 'Berhasil!' : 'Gagal!'),
            text: @json(session('success') ?? session('error')),
            icon: @json(session('success') ? 'success' : 'error'),
            confirmButtonText: 'Tutup'
        });
    });
</script>
@endif

{{-- SweetAlert Konfirmasi Upload Ulang --}}
<script>
    $(document).ready(function () {
        $('.form-reupload-ttd').on('submit', function (e) {
            e.preventDefault();
            const form = this;
            Swal.fire({
                title: 'Upload Ulang TTD?',
                text: "File sebelumnya akan diganti!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Ya, Upload!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

{{-- DataTables --}}
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#tableSurat').DataTable({
            responsive: true,
            autoWidth: false,
            ordering: false,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
            }
        });
    });
</script>
@endpush

@endsection
