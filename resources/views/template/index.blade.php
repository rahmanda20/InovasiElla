@extends('layouts.app')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container">
    <div class="card mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4>Template: {{ $label }}</h4>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalTambah">+ Tambah</button>
        </div>
        <div class="card-body">
            <table class="table" id="tbl">
                <thead>
                    <tr>
                        <th>No</th><th>Judul</th><th>Tanggal</th><th>Status</th><th>Download</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
@foreach($templates as $i => $t)
@php
    $namaFile = basename($t->file_path); // ambil Nama file dari path
    $judulAsli = preg_replace('/^\d+_/', '', $namaFile); // hilangkan timestamp di depan
@endphp
<tr>
    <td>{{ $i + 1 }}</td>
    <td>{{ $judulAsli }}</td>
    <td>{{ $t->created_at->format('Y-m-d H:i') }}</td>
    <td>{!! $t->is_active ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-secondary">Tidak Aktif</span>' !!}</td>
    <td><a href="{{ route('template.download', $t->id) }}" class="btn btn-info btn-sm">Download</a></td>
    <td>
        @if(!$t->is_active)
        <button class="btn btn-success btn-sm" onclick="konf('activate', {{ $t->id }})">Aktifkan</button>
        @endif
        <button class="btn btn-danger btn-sm" onclick="konf('delete', {{ $t->id }})">Hapus</button>
    </td>

    <form id="frm-activate-{{ $t->id }}" action="{{ route('template.activate', $t->id) }}" method="GET">@csrf</form>
    <form id="frm-delete-{{ $t->id }}" action="{{ route('template.delete', $t->id) }}" method="POST">@csrf @method('DELETE')</form>
</tr>
@endforeach
</tbody>

            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('template.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="jenis_surat" value="{{ $jenis }}">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Template</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="file">File (.pdf/.docx/.xlsx)</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function konf(type, id) {
        let title = type == 'activate' ? 'Aktifkan Template?' : 'Hapus Template?';
        let text = type == 'activate' ? 'Template lain akan dinonaktifkan.' : 'Template akan dihapus permanen.';
        Swal.fire({
            title, text, icon: type == 'delete' ? 'warning' : 'question',
            showCancelButton: true,
            confirmButtonText: type == 'delete' ? 'Ya, hapus' : 'Ya, aktifkan'
        }).then(r => {
            if (r.isConfirmed)
                document.getElementById('frm-' + type + '-' + id).submit();
        });
    }

    document.addEventListener("DOMContentLoaded", () => {
        $('#tbl').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
            }
        });
    });
</script>
@endsection
