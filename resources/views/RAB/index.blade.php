<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar RAB</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #343a40;
            margin-bottom: 25px;
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .table tbody tr:hover {
            background-color: #e2f2ff;
        }
        .action-buttons {
            display: flex;
            gap: 5px; /* Memberi sedikit jarak antar tombol */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Daftar Rekapitulasi Rencana Anggaran Biaya</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('rab.create') }}" class="btn btn-primary">Tambah RAB Baru</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Judul (Pekerjaan)</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rabs as $rab)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rab->pekerjaan }}</td>
                        <td>{{ \Carbon\Carbon::parse($rab->created_at)->format('d F Y') }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('rab.show', $rab->id) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('rab.download.excel', $rab->id) }}" class="btn btn-success btn-sm">Export Excel</a>
                            <a href="{{ route('rab.downloadPdf', $rab->id) }}" class="btn btn-danger btn-sm">
    Export PDF
</a>

                                <form action="{{ route('rab.destroy', $rab->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus RAB ini?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data RAB.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>