@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Tombol Tambah di Luar Card & Sebelah Kanan -->
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('pembangunan-bendungan.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Data
        </a>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Pembangunan Bendungan</h4>
        </div>

        <div class="card-body">
            @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '{{ session("success") }}',
                        confirmButtonText: 'OK'
                    });
                });
            </script>
            @endif
            @if ($data->isEmpty())
            <p class="text-center">Tidak ada data yang tersedia.</p>
            @else
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="margin-top: 10px;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Surat</th>
                            <th>Uraian</th>
                            <th>Nomor Berita Acara</th>
                            <th>Tanggal</th>
                            <th>Data Paket</th>
                            <th>Keterangan Data Paket</th>
                            <th>Data Organisasi</th>
                            <th>Keterangan Organisasi</th>
                            <th>Pejabat Pengadaan</th>
                            <th>Keterangan Pengadaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $nomor = 1; @endphp
                        @foreach ($data as $row)
                        @if ($row->jenis_surat == 'Pembangunan Bendungan' && is_array($row->uraian))
                        @foreach ($row->uraian as $key => $uraian)
                        <tr>
                            <td>{{ $nomor++ }}</td>
                            <td>{{ $row->jenis_surat ?? '-' }}</td>
                            <td>{{ $uraian }}</td>
                            <td>{{ $row->nomor_berita_acara[$key] ?? '-' }}</td>
                            <td>{{ $row->tanggal[$key] ?? '-' }}</td>
                            <td>{{ $row->data_paket[$key] ?? '-' }}</td>
                            <td>{{ $row->keterangan_data_paket[$key] ?? '-' }}</td>
                            <td>{{ $row->data_organisasi[$key] ?? '-' }}</td>
                            <td>{{ $row->keterangan_organisasi[$key] ?? '-' }}</td>
                            <td>{{ $row->pejabat_pengadaan[$key] ?? '-' }}</td>
                            <td>{{ $row->keterangan_pengadaan[$key] ?? '-' }}</td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('pembangunan-bendungan.edit', ['id' => $row->id, 'key' => $key]) }}" class="btn btn-warning btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                        </svg> Edit
                                    </a>

                                    <form action="{{ route('pembangunan-bendungan.destroy', ['id' => $row->id, 'key' => $key]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm me-2 btn-hapus" title="Hapus">
                                            <i class="fas fa-trash fs-5"></i> DELETE
                                        </button>

                                    </form>
                                    <form action="3" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z" />
                                            </svg> PDF
                                        </button>
                                    </form>

                                </div>

                            </td>
                        </tr>
                        @endforeach
                        @endif
                        @endforeach
                    </tbody>
                </table>
                @endif
                </body>
  @endsection