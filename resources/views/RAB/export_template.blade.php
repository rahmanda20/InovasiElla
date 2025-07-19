<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .kop-header {
            display: flex;
            align-items: center;
            border-bottom: 3px solid black;
            padding-bottom: 8px;
            margin-bottom: 10px;
        }
        .kop-logo {
            width: 80px;
            margin-right: 15px;
        }
        .kop-text {
            text-align: center;
            flex-grow: 1;
        }
        .kop-text h1 {
            font-size: 14px;
            font-weight: bold;
            margin: 0;
        }
        .kop-text h2 {
            font-size: 13px;
            font-weight: bold;
            margin: 4px 0;
        }
        .kop-text p {
            font-size: 11px;
            margin: 2px 0;
        }
        .judul {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            font-size: 14px;
            margin: 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        table.detail-table th,
        table.detail-table td {
            border: 1px solid black;
            padding: 5px;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .bold {
            font-weight: bold;
        }
        .signature-section {
            width: 100%;
            margin-top: 40px;
            font-size: 12px;
            display: flex;
            justify-content: space-between;
        }
        .signature-block {
            width: 48%;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="kop-header">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/Coat_of_arms_of_Papua_2.svg/1200px-Coat_of_arms_of_Papua_2.svg.png" class="kop-logo" alt="Logo Papua"/>
        <div class="kop-text">
            <h1>PEMERINTAH PROVINSI PAPUA</h1>
            <h2>DINAS PEKERJAAN UMUM, PENATAAN RUANG,<br>PERUMAHAN DAN KAWASAN PERMUKIMAN</h2>
            <p>Alamat : Jl. Sumatera No.15 Dok IV, Jayapura - Papua - Indonesia</p>
            <p>Telepon : (0967) 532497, 533219, Email : pu@papua.net, laman : http://pu.papua.go.id/</p>
        </div>
    </div>

    <p class="judul">REKAPITULASI RENCANA ANGGARAN BIAYA</p>

    <table class="rab-info">
        <tr>
            <td>Pekerjaan</td>
            <td>:</td>
            <td>{{ $rab->pekerjaan }}</td>
        </tr>
        <tr>
            <td>Lokasi</td>
            <td>:</td>
            <td>{{ $rab->lokasi }}</td>
        </tr>
        <tr>
            <td>Masa Pelaksanaan</td>
            <td>:</td>
            <td>{{ $rab->masa_pelaksanaan }}</td>
        </tr>
        <tr>
            <td>Sumber Dana</td>
            <td>:</td>
            <td>{{ $rab->sumber_dana }}</td>
        </tr>
    </table>

    <table class="detail-table">
        <thead>
            <tr>
                <th style="width:5%;">NO.</th>
                <th>URAIAN KEGIATAN</th>
                <th style="width:25%;">JUMLAH BIAYA (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center bold">A.</td>
                <td class="bold">BIAYA LANGSUNG PERSONAL</td>
                <td></td>
            </tr>
            @php $personalIndex = 1; @endphp
            @forelse($personalItems as $item)
            <tr>
                <td class="text-center">A.{{ $personalIndex++ }}</td>
                <td>{{ $item['uraian'] ?? '-' }}</td>
                <td class="text-right">{{ number_format($item['jumlah'] ?? 0, 2, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td class="text-center">A.1</td>
                <td>Tidak ada data biaya langsung personal.</td>
                <td class="text-right">0,00</td>
            </tr>
            @endforelse
            <tr class="bold">
                <td colspan="2" class="text-right">JUMLAH (A)</td>
                <td class="text-right">{{ number_format($rab->jumlah_biaya_langsung_personal, 2, ',', '.') }}</td>
            </tr>

            <tr>
                <td class="text-center bold">B.</td>
                <td class="bold">BIAYA LANGSUNG NON PERSONAL</td>
                <td></td>
            </tr>
            @php $nonPersonalIndex = 1; @endphp
            @forelse($nonPersonalItems as $item)
            <tr>
                <td class="text-center">B.{{ $nonPersonalIndex++ }}</td>
                <td>{{ $item['uraian'] ?? '-' }}</td>
                <td class="text-right">{{ number_format($item['jumlah'] ?? 0, 2, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td class="text-center">B.1</td>
                <td>Tidak ada data biaya langsung non personal.</td>
                <td class="text-right">0,00</td>
            </tr>
            @endforelse
            <tr class="bold">
                <td colspan="2" class="text-right">JUMLAH (B)</td>
                <td class="text-right">{{ number_format($rab->jumlah_biaya_langsung_non_personal, 2, ',', '.') }}</td>
            </tr>

            <tr class="bold">
                <td colspan="2" class="text-right">JUMLAH (A + B)</td>
                <td class="text-right">{{ number_format($jumlahAB, 2, ',', '.') }}</td>
            </tr>
            <tr class="bold">
                <td colspan="2" class="text-right">PPN 11%</td>
                <td class="text-right">{{ number_format($ppn, 2, ',', '.') }}</td>
            </tr>
            <tr class="bold">
                <td colspan="2" class="text-right">TOTAL</td>
                <td class="text-right">{{ number_format($total, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3">Terbilang: {{ \App\Http\Controllers\RabController::terbilangHelper($total) }} Rupiah</td>
            </tr>
        </tbody>
    </table>

    <div class="signature-section">
        <div class="signature-block">
            Jayapura, {{ \Carbon\Carbon::parse($rab->created_at)->format('d F Y') }}<br>
            Untuk dan atas nama<br>
            <strong>PENYEDIA</strong><br>
            {{ $rab->nama_perusahaan_penyedia }}
            <div style="height: 80px;"></div>
            <strong><u>{{ $rab->nama_penyedia }}</u></strong><br>
            {{ $rab->jabatan_penyedia }}
        </div>

        <div class="signature-block">
            Jayapura, {{ \Carbon\Carbon::parse($rab->created_at)->format('d F Y') }}<br>
            Untuk dan atas nama<br>
            Pemerintah Provinsi Papua<br>
            <strong>PEJABAT PENANDATANGAN KONTRAK</strong><br>
            Dinas PUPR Papua
            <div style="height: 80px;"></div>
            <strong><u>{{ $rab->nama_pejabat_penandatangan_kontrak }}</u></strong><br>
            {{ $rab->jabatan_pejabat }}<br>
            NIP. {{ $rab->nip_pejabat }}
        </div>
    </div>
</body>
</html>