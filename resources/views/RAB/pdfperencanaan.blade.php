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
            height: auto;
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
            text-transform: uppercase;
        }
        .header-content h2 {
            font-size: 12px;
            margin: 2px 0;
            font-weight: bold;
            text-transform: uppercase;
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
            text-transform: uppercase;
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
            vertical-align: middle;
        }
        .detail-table th {
            background-color: #f2f2f2;
            text-align: center;
            font-weight: bold;
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
        .section-title {
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        .page-break {
            page-break-after: always;
        }
        .underline {
            text-decoration: underline;
        }
        .uppercase {
            text-transform: uppercase;
        }
        .empty-value {
            color: #999;
            font-style: italic;
        }
    </style>
</head>
<body>
    <!-- HALAMAN PERTAMA (REKAPITULASI) -->
    <div class="header-wrapper">
        <div class="header-logo">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/Coat_of_arms_of_Papua_2.svg/1200px-Coat_of_arms_of_Papua_2.svg.png" alt="Logo Papua">
        </div>
        <div class="header-content">
            <h1>PEMERINTAH PROVINSI PAPUA</h1>
            <h2>DINAS PEKERJAAN UMUM, PENATAAN RUANG, PERUMAHAN DAN KAWASAN PERMUKIMAN</h2>
            <p>Alamat : Jl. Sumatera No. 15 Dok IV, Jayapura, Papua - Indonesia</p>
            <p>Telepon : (0967) 532497, 533219, Email : pu@papua.net, laman : http://pu.papua.go.id/</p>
        </div>
    </div>
    <div class="border-top"></div>

    <div class="judul">REKAPITULASI RENCANA ANGGARAN BIAYA</div>

    <div class="info-rab">
        <table>
            <tr><td>Pekerjaan</td><td>: {{ $rab->pekerjaan }}</td></tr>
            <tr><td>Lokasi</td><td>: {{ $rab->lokasi }}</td></tr>
            <tr><td>Masa Pelaksanaan</td><td>: {{ $rab->masa_pelaksanaan }}</td></tr>
            <tr><td>Sumber Dana</td><td>: {{ $rab->sumber_dana }}</td></tr>
        </table>
    </div>

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
                <td class="bold uppercase">BIAYA LANGSUNG PERSONIL</td>
                <td class="text-right">-</td>
            </tr>
            <tr>
                <td class="text-center">A.1</td>
                <td>Professional Staff</td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td class="text-center">A.2</td>
                <td>Tenaga Ahli Sub Professional</td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td class="text-center">A.3</td>
                <td>Tenaga Pendukung (Supporting Staff)</td>
                <td class="text-right"></td>
            </tr>

            <!-- Biaya Non Personil -->
            <tr>
                <td class="text-center bold">B.</td>
                <td class="bold uppercase">BIAYA LANGSUNG NON PERSONIL</td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td class="text-center">B.1</td>
                <td>Biaya Operasional Kantor</td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td class="text-center">B.2</td>
                <td>Biaya Perjalanan Dinas/Perdiem Allowance (Turjangan Harlan) untuk proyek &lt; 3 bulan</td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td class="text-center">B.3</td>
                <td>Depresiasi Perlengkapan Khusus dan Lapangan</td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td class="text-center">B.4</td>
                <td>Biaya Pelaporan</td>
                <td class="text-right"></td>
            </tr>

            <!-- Total -->
          <!-- Di dalam tabel rekapitulasi -->
<tr class="bold">
    <td colspan="2" class="text-right">JUMLAH (A + B)</td>
    <td class="text-right"></td>
</tr>
<!-- Baris PPN - hanya ditampilkan jika ada nilai PPN -->
@if($ppn > 0)
<tr class="bold">
    <td colspan="2" class="text-right">PPN 11%</td>
    <td class="text-right"></td>
</tr>
@else
<tr class="bold">
    <td colspan="2" class="text-right">PPN</td>
    <td class="text-right">-</td>
</tr>
@endif
<tr class="bold">
    <td colspan="2" class="text-right">TOTAL</td>
    <td class="text-right"></td>
</tr>
            <tr class="terbilang-row">
                <td colspan="3">Terbilang: <strong></strong></td>
            </tr>
        </tbody>
    </table>

    <!-- Tanda Tangan Halaman 1 -->
    <table class="signature">
        <tr>
            <td>
                Untuk dan atas nama<br>
                <strong class="uppercase">Penyedia</strong><br>
                <strong></strong><br><br>
                <div class="ttd-space"></div>
                <strong class="underline"></strong><br>
               
            </td>
            <td style="text-align: right">
                Jayapura, <br>
                Untuk dan atas nama<br>
                Pemerintah Provinsi Papua<br>
                <strong class="uppercase">Pejabat Penandatangan Kontrak</strong><br>
                Dinas Pekerjaan Umum, Penataan Ruang,<br>
                Perumahan dan Kawasan Permukiman<br><br>
                <div class="ttd-space"></div>
                <strong class="underline"></strong><br>
               <br>
                NIP. 
            </td>
        </tr>
    </table>

    <!-- HALAMAN KEDUA (DETAIL) -->
    <div class="page-break"></div>

    <!-- Header untuk halaman 2 -->
    <div class="header-wrapper">
        <div class="header-logo">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/Coat_of_arms_of_Papua_2.svg/1200px-Coat_of_arms_of_Papua_2.svg.png" alt="Logo Papua">
        </div>
        <div class="header-content">
            <h1>PEMERINTAH PROVINSI PAPUA</h1>
            <h2>DINAS PEKERJAAN UMUM, PENATAAN RUANG, PERUMAHAN DAN KAWASAN PERMUKIMAN</h2>
        </div>
    </div>
    <div class="border-top"></div>

    <div class="judul">DETAIL RENCANA ANGGARAN BIAYA</div>
    <div class="info-rab">
        <table>
            <tr><td>Pekerjaan</td><td>: {{ $rab->pekerjaan }}</td></tr>
            <tr><td>Lokasi</td><td>: {{ $rab->lokasi }}</td></tr>
        </table>
    </div>

    <!-- A. BIAYA LANGSUNG PERSONIL -->
    <div class="section-title">A. BIAYA LANGSUNG PERSONIL</div>

    <!-- A.1. Profesional Staff -->
    <div class="section-title">A.1. Professional Staff</div>
    <table class="detail-table">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="35%">Uraian</th>
                <th width="10%">Volume</th>
                <th width="10%">Satuan</th>
                <th width="20%">Harga Satuan (Rp)</th>
                <th width="20%">Jumlah Harga (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($profesionalStaf as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item['uraian'] }}</td>
                <td class="text-center">{{ number_format($item['volume'], 1, ',', '.') }}</td>
                <td class="text-center">{{ $item['satuan'] }}</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            @endforeach
            <tr class="bold">
                <td colspan="5" class="text-right">Jumlah A.1.</td>
                <td class="text-right"></td>
            </tr>
        </tbody>
    </table>

    <!-- A.2. Tenaga Ahli Sub Professional -->
    <div class="section-title">A.2. Tenaga Ahli Sub Professional</div>
    <table class="detail-table">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="35%">Personil</th>
                <th width="10%">Jumlah</th>
                <th width="10%">Satuan</th>
                <th width="20%">Harga Satuan (Rp)</th>
                <th width="20%">Jumlah Biaya (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tenagaAhliSub as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item['personil'] }}</td>
                <td class="text-center">{{ number_format($item['jumlah'], 1, ',', '.') }}</td>
                <td class="text-center">{{ $item['satuan'] }}</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            @endforeach
            <tr class="bold">
                <td colspan="5" class="text-right">Jumlah A.2.</td>
                <td class="text-right"></td>
            </tr>
        </tbody>
    </table>

    <!-- A.3. Tenaga Pendukung (Supporting Staff) -->
    <div class="section-title">A.3. Tenaga Pendukung (Supporting Staff)</div>
    <table class="detail-table">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="35%">Personil</th>
                <th width="10%">Jumlah</th>
                <th width="10%">Satuan</th>
                <th width="20%">Harga Satuan (Rp)</th>
                <th width="20%">Jumlah Biaya (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tenagaPendukung as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item['personil'] }}</td>
                <td class="text-center">{{ number_format($item['jumlah'], 1, ',', '.') }}</td>
                <td class="text-center">{{ $item['satuan'] }}</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            @endforeach
            <tr class="bold">
                <td colspan="5" class="text-right">Jumlah A.3.</td>
                <td class="text-right"></td>
            </tr>
        </tbody>
    </table>

    <!-- B. BIAYA LANGSUNG NON PERSONIL -->
    <div class="section-title">B. BIAYA LANGSUNG NON PERSONIL</div>

    <!-- B.1. Biaya Operasional Kantor -->
    <div class="section-title">B.1. Biaya Operasional Kantor</div>
    <table class="detail-table">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="35%">Uraian</th>
                <th width="10%">Jumlah</th>
                <th width="10%">Satuan</th>
                <th width="20%">Harga Satuan (Rp)</th>
                <th width="20%">Jumlah Biaya (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($operasionalKantor as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item['uraian'] }}</td>
                <td class="text-center">{{ number_format($item['jumlah'], 1, ',', '.') }}</td>
                <td class="text-center">{{ $item['satuan'] }}</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            @endforeach
            <tr class="bold">
                <td colspan="5" class="text-right">Jumlah B.1.</td>
                <td class="text-right"></td>
            </tr>
        </tbody>
    </table>

    <!-- B.2. Biaya Perjalanan Dinas -->
    <div class="section-title">B.2. Biaya Perjalanan Dinas/Perdiem Allowance (Turjangan Harlan) untuk proyek &lt; 3 bulan</div>
    <table class="detail-table">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="35%">Uraian</th>
                <th width="10%">Jumlah</th>
                <th width="10%">Satuan</th>
                <th width="20%">Harga Satuan (Rp)</th>
                <th width="20%">Jumlah Biaya (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($perjalananDinas as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item['uraian'] }}</td>
                <td class="text-center">{{ number_format($item['jumlah'], 1, ',', '.') }}</td>
                <td class="text-center">{{ $item['satuan'] }}</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            @endforeach
            <tr class="bold">
                <td colspan="5" class="text-right">Jumlah B.2.</td>
                <td class="text-right"></td>
            </tr>
        </tbody>
    </table>

    <!-- B.3. Depresiasi Perlengkapan -->
    <div class="section-title">B.3. Depresiasi Perlengkapan Khusus dan Lapangan</div>
    <table class="detail-table">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="35%">Uraian</th>
                <th width="10%">Jumlah</th>
                <th width="10%">Satuan</th>
                <th width="20%">Harga Satuan (Rp)</th>
                <th width="20%">Jumlah Biaya (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($depresiasi as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item['uraian'] }}</td>
                <td class="text-center">{{ number_format($item['jumlah'], 1, ',', '.') }}</td>
                <td class="text-center">{{ $item['satuan'] }}</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            @endforeach
            <tr class="bold">
                <td colspan="5" class="text-right">Jumlah B.3.</td>
                <td class="text-right"></td>
            </tr>
        </tbody>
    </table>

    <!-- B.4. Biaya Pelaporan -->
    <div class="section-title">B.4. Biaya Pelaporan</div>
    <table class="detail-table">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="35%">Uraian</th>
                <th width="10%">Jumlah</th>
                <th width="10%">Satuan</th>
                <th width="20%">Harga Satuan (Rp)</th>
                <th width="20%">Jumlah Biaya (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($biayaPelaporan as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item['uraian'] }}</td>
                <td class="text-center">{{ number_format($item['jumlah'], 1, ',', '.') }}</td>
                <td class="text-center">{{ $item['satuan'] }}</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            @endforeach
            <tr class="bold">
                <td colspan="5" class="text-right">Jumlah B.4.</td>
                <td class="text-right"></td>
            </tr>
        </tbody>
    </table>

    <!-- Tanda Tangan Halaman 2 -->
    <table class="signature">
        <tr>
            <td>
                Untuk dan atas nama<br>
                <strong class="uppercase">Penyedia</strong><br>
                <strong></strong><br><br>
                <div class="ttd-space"></div>
                <strong class="underline">{{ $rab->nama_penyedia }}</strong><br>
                {{ $rab->jabatan_penyedia }}
            </td>
            <td style="text-align: right">
                Jayapura, <br>
                Untuk dan atas nama<br>
                Pemerintah Provinsi Papua<br>
                <strong class="uppercase">Pejabat Penandatangan Kontrak</strong><br>
                Dinas Pekerjaan Umum, Penataan Ruang,<br>
                Perumahan dan Kawasan Permukiman<br><br>
                <div class="ttd-space"></div>
                <strong class="underline"></strong><br>
               <br>
                NIP. 
            </td>
        </tr>
    </table>
</body>
</html>