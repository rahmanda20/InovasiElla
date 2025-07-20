@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Daftar Rekapitulasi Rencana Anggaran Biaya (RAB)</h4>
            <a href="{{ route('rab.create', ['jenis' => $jenisDokumen]) }}" class="btn btn-light">
                <i class="fas fa-plus"></i> Tambah RAB Baru
            </a>
        </div>

        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="tbl">
                    <thead class="table-primary">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Judul Pekerjaan</th>
                            <th>Jenis Dokumen</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rabs as $rab)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $rab->pekerjaan }}</td>
                                <td>{{ $rab->jenis_dokumen }}</td>
                                <td>{{ \Carbon\Carbon::parse($rab->created_at)->translatedFormat('d F Y') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('rab.downloadPdfperencenaan', $rab->id) }}" class="btn btn-danger btn-sm mb-1">
                                        <i class="fas fa-file-pdf"></i> Export PDF
                                    </a>

                                    <form action="{{ route('rab.destroy', $rab->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus RAB ini?')">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data RAB.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- DataTables -->
<script>
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
