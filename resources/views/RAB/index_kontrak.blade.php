@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Daftar Semua Rekapitulasi RAB</h4>
           
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($rabs->isEmpty())
                <div class="alert alert-warning">
                    Tidak ada data RAB yang tersedia. Silakan tambahkan data RAB terlebih dahulu.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="tbl">
                        <thead class="table-primary text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th width="25%">Judul Pekerjaan</th>
                                <th width="15%">Lokasi</th>
                                <th width="10%">Jenis Dokumen</th>
                                <th width="15%">Total (Rp)</th>
                                <th width="15%">Tanggal Dibuat</th>
                                <th width="10%">Pemasok (Non TTD)</th>
                                <th width="10%">Dokumen Kita (TTD)</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rabs as $index => $rab)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $rab->pekerjaan }}</td>
                                    <td>{{ $rab->lokasi ?? '-' }}</td>
                                    <td class="text-uppercase text-center">{{ $rab->jenis_dokumen }}</td>
                                    <td class="text-end">{{ number_format($rab->total_keseluruhan, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($rab->created_at)->translatedFormat('d F Y') }}</td>

                                    {{-- Kolom: Upload/Download File Non TTD --}}
                                    <td class="text-center">
                                        @if ($rab->file_kontrak_non_ttd)
                                            <div class="d-flex flex-column align-items-center">
                                                <a href="{{ Storage::url($rab->file_kontrak_non_ttd) }}" target="_blank" 
                                                   class="btn btn-sm btn-success mb-1 w-100">
                                                    <i class="fas fa-download"></i> Download
                                                </a>
                                                <small class="text-muted">
                                                    {{ \Carbon\Carbon::parse($rab->updated_at)->diffForHumans() }}
                                                </small>
                                            </div>
                                        @else
                                            <form action="{{ route('rab.uploadKontrakNonTTD', $rab->id) }}" method="POST" 
                                                  enctype="multipart/form-data" class="upload-form">
                                                @csrf
                                                <div class="input-group input-group-sm">
                                                    <input type="file" name="file_kontrak_non_ttd" 
                                                           class="form-control" accept="application/pdf" required>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-upload"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        @endif
                                    </td>

                                    {{-- Kolom: Upload/Download File TTD --}}
                                    <td class="text-center">
                                        @if ($rab->file_kontrak_ttd)
                                            <div class="d-flex flex-column align-items-center">
                                                <a href="{{ Storage::url($rab->file_kontrak_ttd) }}" target="_blank" 
                                                   class="btn btn-sm btn-success mb-1 w-100">
                                                    <i class="fas fa-download"></i> Download
                                                </a>
                                                <small class="text-muted">
                                                    {{ \Carbon\Carbon::parse($rab->updated_at)->diffForHumans() }}
                                                </small>
                                            </div>
                                        @else
                                            <form action="{{ route('rab.uploadKontrakTTD', $rab->id) }}" method="POST" 
                                                  enctype="multipart/form-data" class="upload-form">
                                                @csrf
                                                <div class="input-group input-group-sm">
                                                    <input type="file" name="file_kontrak_ttd" 
                                                           class="form-control" accept="application/pdf" required>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-upload"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        @endif
                                    </td>

                                    {{-- Kolom Aksi --}}
                                    <td class="text-center">
                                        <div class="d-flex flex-wrap justify-content-center gap-1">
                                            <a href="{{ route('rab.show', $rab->id) }}" class="btn btn-info btn-sm" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('rab.edit', $rab->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('rab.downloadPdf', $rab->id) }}" class="btn btn-danger btn-sm" title="PDF">
                                                <i class="fas fa-file-pdf"></i>
                                            </a>
                                            <form action="{{ route('rab.destroy', $rab->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus RAB ini?')" title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $rabs->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- DataTables dan SweetAlert -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        $('#tbl').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
            },
            paging: false,
            ordering: true,
            searching: true,
            info: false
        });

        // Handle form upload dengan AJAX
        $('.upload-form').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const formData = new FormData(this);
            
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message || 'File berhasil diupload',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: xhr.responseJSON.message || 'Terjadi kesalahan saat mengupload file'
                    });
                }
            });
        });
    });
</script>
@endsection