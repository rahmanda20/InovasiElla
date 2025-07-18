@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <nav>
                    <h5 class="text-">Pengawasan</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href=""><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Reakapan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <hr />

    <div class="box">
        <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tahun</th>
                            <th>Nama Pekerjaan</th>
                            <th>Lokasi (Kab./Kota)</th>
                            <th>Titik Koordinat</th>
                            <th>Volume Rencana</th>
                            <th>Masa Waktu Pelaksanaan</th>
                            <th>Masa Waktu Pemeliharaan</th>
                            <th>No. & Tgl. SPPBJ</th>
                            <th>No. & Tgl. SPK/SP</th>
                            <th>No. & Tgl. SPMK</th>
                            <th>No. & Tgl. BAPL</th>
                            <th>Rekanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $data = [
                                [
                                    'tahun' => '2023',
                                    'nama_pekerjaan' => 'Pembangunan Jalan',
                                    'lokasi' => 'Semarang',
                                    'titik_koordinat' => '-7.005145,110.438125',
                                    'volume_rencana' => '500m',
                                    'masa_pelaksanaan' => '6 Bulan',
                                    'masa_pemeliharaan' => '12 Bulan',
                                    'no_tgl_sppbj' => '123/SPPBJ/2023, 01-01-2023',
                                    'no_tgl_spk' => '456/SPK/2023, 02-01-2023',
                                    'no_tgl_spmk' => '789/SPMK/2023, 03-01-2023',
                                    'no_tgl_bapl' => '012/BAPL/2023, 31-12-2023',
                                    'rekanan' => 'PT Konstruksi Sejahtera',
                                ],
                                [
                                    'tahun' => '2024',
                                    'nama_pekerjaan' => 'Pembangunan Jembatan',
                                    'lokasi' => 'Yogyakarta',
                                    'titik_koordinat' => '-7.797068,110.370529',
                                    'volume_rencana' => '1.2 Km',
                                    'masa_pelaksanaan' => '8 Bulan',
                                    'masa_pemeliharaan' => '24 Bulan',
                                    'no_tgl_sppbj' => '124/SPPBJ/2024, 01-02-2024',
                                    'no_tgl_spk' => '457/SPK/2024, 02-02-2024',
                                    'no_tgl_spmk' => '790/SPMK/2024, 03-02-2024',
                                    'no_tgl_bapl' => '013/BAPL/2024, 30-10-2024',
                                    'rekanan' => 'PT Infrastruktur Mandiri',
                                ],
                                [
                                    'tahun' => '2025',
                                    'nama_pekerjaan' => 'Pengembangan Drainase',
                                    'lokasi' => 'Solo',
                                    'titik_koordinat' => '-7.571666,110.826972',
                                    'volume_rencana' => '3 Km',
                                    'masa_pelaksanaan' => '10 Bulan',
                                    'masa_pemeliharaan' => '18 Bulan',
                                    'no_tgl_sppbj' => '125/SPPBJ/2025, 01-03-2025',
                                    'no_tgl_spk' => '458/SPK/2025, 02-03-2025',
                                    'no_tgl_spmk' => '791/SPMK/2025, 03-03-2025',
                                    'no_tgl_bapl' => '014/BAPL/2025, 30-12-2025',
                                    'rekanan' => 'PT Sumber Air Abadi',
                                ],
                            ];
                        @endphp

                        @if (!empty($data))
                            @foreach ($data as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item['tahun'] }}</td>
                                    <td>{{ $item['nama_pekerjaan'] }}</td>
                                    <td>{{ $item['lokasi'] }}</td>
                                    <td>{{ $item['titik_koordinat'] }}</td>
                                    <td>{{ $item['volume_rencana'] }}</td>
                                    <td>{{ $item['masa_pelaksanaan'] }}</td>
                                    <td>{{ $item['masa_pemeliharaan'] }}</td>
                                    <td>{{ $item['no_tgl_sppbj'] }}</td>
                                    <td>{{ $item['no_tgl_spk'] }}</td>
                                    <td>{{ $item['no_tgl_spmk'] }}</td>
                                    <td>{{ $item['no_tgl_bapl'] }}</td>
                                    <td>{{ $item['rekanan'] }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="13" class="text-center">No data available</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
