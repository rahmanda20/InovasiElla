@extends('layouts.app')

@section('styles')
<style>
    .blink-highlight {
        animation: blink 1s ease-in-out infinite alternate;
        background-color: #fff3cd !important;
    }
    @keyframes blink {
        from { background-color: #fff3cd; }
        to { background-color: #ffeeba; }
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    <div class="card shadow rounded-3">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">
                <i class="fas fa-envelope-open-text me-2"></i>
                Daftar Surat - {{ strtoupper($jenis_surat) }}
            </h5>
          
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Jenis Dokumen</th>
                            <th>Tanggal</th>
                            <th>Excel</th>
                            <th>Draft</th>
                            <th>Final</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($listSurat as $index => $surat)
                        <tr @if(session('highlight_id') == $surat->id) class="blink-highlight" @endif>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $surat->judul_surat }}</td>
                            <td>{{ strtoupper($surat->jenis_dokumen) }}</td>
                            <td>{{ $surat->created_at->format('d-m-Y H:i') }}</td>
                            <td class="text-center">
                                @if($surat->file_excel)
                                    <a href="{{ route('perencanaan.exportExcel', $surat->id) }}" class="btn btn-sm btn-success"><i class="fas fa-file-excel"></i></a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($surat->file_belum_ttd)
                                    <a href="{{ route('perencanaan.exportDraft', $surat->id) }}" class="btn btn-sm btn-secondary">Download</a>
                                @else
                                    <form action="{{ route('perencanaan.uploadBelumTTD', $surat->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="file_belum_ttd" class="form-control form-control-sm" required>
                                        <button class="btn btn-sm btn-secondary mt-1">Upload</button>
                                    </form>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($surat->file_sudah_ttd)
                                    <a href="{{ route('perencanaan.exportFinal', $surat->id) }}" class="btn btn-sm btn-success">Download</a>
                                @else
                                    <form action="{{ route('perencanaan.uploadTTD', $surat->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="file_sudah_ttd" class="form-control form-control-sm" required>
                                        <button class="btn btn-sm btn-success mt-1">Upload</button>
                                    </form>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('perencanaan.destroy', $surat->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="8" class="text-center text-muted">Belum ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Surat -->
<div class="modal fade" id="modalTambahSurat" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" action="{{ route('perencanaan.store') }}" method="POST">
            @csrf
            <input type="hidden" name="jenis_surat" value="{{ $jenis_surat }}">
            <input type="hidden" name="jenis_dokumen" value="{{ request()->segment(3) }}">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Tambah Surat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Judul Surat</label>
                    <input type="text" name="judul_surat" class="form-control" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
        Swal.fire('Sukses!', '{{ session('success') }}', 'success');
    @elseif(session('error'))
        Swal.fire('Gagal!', '{{ session('error') }}', 'error');
    @endif

    document.querySelectorAll('.btn-hapus').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin?',
                text: 'Data yang dihapus tidak bisa dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!'
            }).then(result => {
                if (result.isConfirmed) {
                    this.closest('form').submit();
                }
            });
        });
    });
</script>
@endsection
