<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Rekapitulasi RAB</title>
  <style>
        @page {
            size: A4;
            margin: 15mm 20mm;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 0;
            padding: 0;
            line-height: 1.4;
        }

        .header-wrapper {
            display: table;
            width: 100%;
            margin-bottom: 5px;
        }
        .header-logo {
            display: table-cell;
            width: 80px;
            vertical-align: middle;
            text-align: center;
        }
        .header-logo img {
            width: 70px;
        }
        .header-content {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
            padding: 0 10px;
        }
        .header-content h1 {
            font-size: 14px;
            margin: 0;
            font-weight: bold;
        }
        .header-content h2 {
            font-size: 12px;
            margin: 2px 0;
            font-weight: bold;
        }
        .header-content p {
            font-size: 10px;
            margin: 1px 0;
        }

        .border-top {
            border-top: 3px solid #000;
            margin: 5px 0 15px;
        }

        .judul {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .info-rab {
            margin-bottom: 15px;
        }
        .info-rab table {
            width: 100%;
        }
        .info-rab td {
            padding: 2px 0;
            vertical-align: top;
        }
        .info-rab td:first-child {
            width: 140px;
            font-weight: bold;
        }

        .detail-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
            margin-bottom: 10px;
        }
        .detail-table th, 
        .detail-table td {
            border: 1px solid #000;
            padding: 5px;
            vertical-align: top;
        }
        .detail-table th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .bold {
            font-weight: bold;
        }

        .terbilang-row td {
            padding: 5px;
            font-style: italic;
        }

        .signature {
            width: 100%;
            margin-top: 30px;
        }
        .signature td {
            width: 50%;
            vertical-align: top;
        }
        .signature .ttd-space {
            height: 60px;
        }
    </style>
</head>
<body>
    <!-- Kop Surat dengan logo kiri dan teks header tengah -->
    <div class="header-wrapper">
        <div class="header-logo">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/Coat_of_arms_of_Papua_2.svg/1200px-Coat_of_arms_of_Papua_2.svg.png" alt="Logo Papua">
        </div>
        <div class="header-content">
            <h1>PEMERINTAH PROVINSI PAPUA</h1>
            <h2>DINAS PEKERJAAN UMUM, PENATAAN RUANG, PERUMAHAN DAN KAWASAN PERMUKIMAN</h2>
            <p>Alamat: Jl. Sumatera No.15 Dok IV, Jayapura - Papua - Indonesia</p>
            <p>Telepon: (0967) 532497, 533219 | Email: pu@papua.net | Laman: http://pu.papua.go.id</p>
        </div>
    </div>
    <div class="border-top"></div>

    <!-- Judul -->
    <div class="judul">REKAPITULASI RENCANA ANGGARAN BIAYA</div>

    <!-- Informasi RAB -->
    <div class="info-rab">
        <table>
            <tr><td>Pekerjaan</td><td>: {{ $rab->pekerjaan }}</td></tr>
            <tr><td>Lokasi</td><td>: {{ $rab->lokasi }}</td></tr>
            <tr><td>Masa Pelaksanaan</td><td>: {{ $rab->masa_pelaksanaan }}</td></tr>
            <tr><td>Sumber Dana</td><td>: {{ $rab->sumber_dana }}</td></tr>
        </table>
    </div>

    <!-- Tabel Rincian -->
    <table class="detail-table">
        <thead>
            <tr>
                <th width="5%">NO.</th>
                <th>URAIAN KEGIATAN</th>
                <th width="25%">JUMLAH BIAYA (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <!-- Biaya Personil -->
            <tr>
                <td class="text-center bold">A.</td>
                <td class="bold">BIAYA LANGSUNG PERSONIL</td>
                <td class="text-right">{{ number_format($rab->jumlah_biaya_langsung_personal, 2, ',', '.') }}</td>
            </tr>
            @foreach($personalItems as $index => $item)
            <tr>
                <td class="text-center">A.{{ $index + 1 }}</td>
                <td>{{ $item['uraian'] }}</td>
                <td class="text-right">{{ number_format($item['jumlah'], 2, ',', '.') }}</td>
            </tr>
            @endforeach

            <!-- Biaya Non Personil -->
            <tr>
                <td class="text-center bold">B.</td>
                <td class="bold">BIAYA LANGSUNG NON PERSONIL</td>
                <td class="text-right">{{ number_format($rab->jumlah_biaya_langsung_non_personal, 2, ',', '.') }}</td>
            </tr>
            @foreach($nonPersonalItems as $index => $item)
            <tr>
                <td class="text-center">B.{{ $index + 1 }}</td>
                <td>{{ $item['uraian'] }}</td>
                <td class="text-right">{{ number_format($item['jumlah'], 2, ',', '.') }}</td>
            </tr>
            @endforeach

            <!-- Total -->
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

            <!-- Terbilang -->
            <tr class="terbilang-row">
                <td colspan="3">Terbilang: <strong>{{ ucfirst($terbilang) }} Rupiah</strong></td>
            </tr>
        </tbody>
    </table>

    <!-- Tanda Tangan -->
    <table class="signature">
        <tr>
            <td>
                Untuk dan atas nama<br>
                <strong>PENYEDIA</strong><br>
                {{ $rab->nama_perusahaan_penyedia }}<br><br>
                <div class="ttd-space"></div>
                <strong><u>{{ $rab->nama_penyedia }}</u></strong><br>
                {{ $rab->jabatan_penyedia }}
            </td>
            <td style="text-align: right">
                Jayapura, {{ \Carbon\Carbon::parse($rab->created_at)->translatedFormat('d F Y') }}<br>
                Untuk dan atas nama<br>
                Pemerintah Provinsi Papua<br>
                <strong>PEJABAT PENANDATANGAN KONTRAK</strong><br>
                Dinas PUPR Papua<br><br>
                <div class="ttd-space"></div>
                <strong><u>{{ $rab->nama_pejabat_penandatangan_kontrak }}</u></strong><br>
                {{ $rab->jabatan_pejabat }}<br>
                NIP. {{ $rab->nip_pejabat }}
            </td>
        </tr>
    </table>
</body>
</html>
