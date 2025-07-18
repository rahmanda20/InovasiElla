@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center">
                <a href="{{ route('dokumen.index') }}" class="btn btn-sm btn-secondary me-2">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h3 class="mb-0">{{ $pengadaan['label'] }} - {{ $surat['label'] }}</h3>
            </div>
            <hr />
            @if($templateAktif)
            <div class="alert alert-info">
                Template aktif: <strong>{{ $templateAktif->judul_surat }}</strong>
            </div>
            @endif
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Dokumen</h5>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                </div>
                <div class="card-body">
                    @if($data->isEmpty())
                    <div class="text-center py-4">
                        <img src="/images/empty.svg" style="width: 200px;" class="mb-3">
                        <p class="text-muted">Belum ada dokumen</p>
                    </div>
                    @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Judul Dokumen</th>
                                    <th width="20%">File Tanpa TTD</th>
                                    <th width="20%">File Dengan TTD</th>
                                    <th width="15%">Dibuat</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->judul_surat }}</td>
                                    <td>
                                        @if($item->file_belum_ttd)
                                        <a href="{{ Storage::url($item->file_belum_ttd) }}" 
                                           class="btn btn-sm btn-success" download>
                                            <i class="fas fa-download"></i> Download
                                        </a>
                                        @else
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" 
                                                data-bs-target="#uploadModal" 
                                                data-id="{{ $item->id }}" data-type="belum_ttd">
                                            <i class="fas fa-upload"></i> Upload
                                        </button>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->file_sudah_ttd)
                                        <a href="{{ Storage::url($item->file_sudah_ttd) }}" 
                                           class="btn btn-sm btn-success" download>
                                            <i class="fas fa-download"></i> Download
                                        </a>
                                        @else
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" 
                                                data-bs-target="#uploadModal" 
                                                data-id="{{ $item->id }}" data-type="sudah_ttd">
                                            <i class="fas fa-upload"></i> Upload
                                        </button>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <form action="{{ route('dokumen.delete', $item->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Hapus dokumen ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('dokumen.store') }}" method="POST">
            @csrf
            <input type="hidden" name="jenis_pengadaan" value="{{ $pengadaanId }}">
            <input type="hidden" name="jenis_surat" value="{{ $suratId }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Dokumen Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul Dokumen</label>
                        <input type="text" name="judul_surat" class="form-control" required>
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

<!-- Modal Upload -->
<div class="modal fade" id="uploadModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="uploadForm" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="filetype" id="filetypeInput">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Pilih File</label>
                        <input type="file" name="file" class="form-control" required>
                        <small class="text-muted">Format: PDF, DOC, DOCX (Max: 2MB)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle upload modal
    $('#uploadModal').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget);
        const docId = button.data('id');
        const fileType = button.data('type');
        
        $('#filetypeInput').val(fileType);
        $('#uploadForm').attr('action', `/dokumen/upload/${docId}`);
    });
});
</script>
@endsection