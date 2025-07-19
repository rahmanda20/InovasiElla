<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>RAB Rekapitulasi - {{ $rab->pekerjaan }}</title>
  <style>
    @page {
      size: A4;
      margin: 20mm;
    }

    body {
      font-family: Arial, sans-serif;
      background: #f0f0f0;
      margin: 0;
      padding: 20px;
    }

    .card {
      background: white;
      width: 210mm; /* A4 width */
      min-height: 297mm; /* A4 height */
      margin: auto;
      padding: 20mm;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
      box-sizing: border-box; /* Include padding in width/height */
    }

    .kop-header {
      display: flex;
      align-items: center;
      border-bottom: 3px solid black;
      padding-bottom: 8px;
      margin-bottom: 10px;
    }

    .kop-logo {
      width: 80px; /* Lebar logo */
      margin-right: 15px; /* Jarak antara logo dan teks */
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

    table.rab-info { /* Changed to rab-info for specificity */
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 15px;
      font-size: 12px;
    }
    table.rab-info td {
      border: none; /* Ensure no borders for this specific table */
      padding: 2px 0;
      vertical-align: top;
    }
    table.rab-info td:first-child {
      width: 25%; /* Lebar kolom label */
    }
    table.rab-info td:nth-child(2) {
      width: 1%; /* Lebar kolom titik dua */
    }

    table.detail-table { /* Specific class for the main data table */
      border-collapse: collapse;
      width: 100%;
      font-size: 12px;
      margin-bottom: 0; /* Remove bottom margin here, terbilang handles it */
    }

    table.detail-table th,
    table.detail-table td {
      border: 1px solid black;
      padding: 5px;
      vertical-align: top;
    }

    table.detail-table thead th {
      text-align: center;
      background-color: #f2f2f2; /* Warna latar belakang header tabel */
    }

    .no-border {
        border: none !important;
    }

    .text-right {
      text-align: right;
    }

    .text-center {
      text-align: center;
    }

    .text-left {
      text-align: left;
    }

    .bold {
      font-weight: bold;
    }

    /* Terbilang section styles - now applied to table rows */
    .terbilang-title-row td {
      border-top: 1px solid black;
      border-left: 1px solid black;
      border-right: 1px solid black;
      border-bottom: none;
      font-weight: bold;
      font-style: italic;
    }

    .terbilang-content-row td {
      border-left: 1px solid black;
      border-right: 1px solid black;
      border-top: none;
      border-bottom: 1px solid black;
      font-style: italic;
    }

    .signature-section { /* Changed from .signature to avoid conflict and be more descriptive */
      width: 100%;
      margin-top: 40px;
      font-size: 12px;
      display: flex; /* Use flexbox for side-by-side layout */
      justify-content: space-between; /* Distribute space between items */
    }

    .signature-block { /* Specific class for each signature block */
      width: 48%; /* Adjust width for two columns */
      text-align: center;
    }

    .ttd-space {
      height: 80px; /* Jarak untuk tanda tangan */
    }

    /* Style untuk tombol "Kembali" agar tidak tercetak */
    @media print {
        .no-print {
            display: none;
        }
    }
  </style>
</head>
<body>
  <div class="card">
    <div class="kop-header">
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/Coat_of_arms_of_Papua_2.svg/1200px-Coat_of_arms_of_Papua_2.svg.png" class="kop-logo" alt="Logo Papua" />
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
        @forelse($rab->uraian_kegiatan_biaya_langsung_personal as $item)
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
        @forelse($rab->uraian_kegiatan_biaya_langsung_non_personal as $item)
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
          <td class="text-right" id="total-rp">{{ number_format($total, 2, ',', '.') }}</td>
        </tr>
        <tr class="terbilang-title-row">
            <td colspan="3">Terbilang:</td>
        </tr>
        <tr class="terbilang-content-row">
            <td colspan="3" id="terbilang-output"></td>
        </tr>
      </tbody>
    </table>

    <div class="signature-section">
      <div class="signature-block">
        Jayapura, {{ \Carbon\Carbon::parse($rab->created_at)->format('d F Y') }}<br>
        Untuk dan atas nama<br>
        <strong>PENYEDIA</strong><br>
        {{ $rab->nama_perusahaan_penyedia }}
        <div class="ttd-space"></div>
        <strong><u>{{ $rab->nama_penyedia }}</u></strong><br>
        {{ $rab->jabatan_penyedia }}
      </div>

      <div class="signature-block">
        Jayapura, {{ \Carbon\Carbon::parse($rab->created_at)->format('d F Y') }}<br>
        Untuk dan atas nama<br>
        Pemerintah Provinsi Papua<br>
        <strong>PEJABAT PENANDATANGAN KONTRAK</strong><br>
        Dinas PUPR Papua
        <div class="ttd-space"></div>
        <strong><u>{{ $rab->nama_pejabat_penandatangan_kontrak }}</u></strong><br>
        {{ $rab->jabatan_pejabat }}<br>
        NIP. {{ $rab->nip_pejabat }}
      </div>
    </div>
    <div class="text-center mt-4 no-print">
        <a href="{{ route('rab.index') }}" class="btn btn-secondary">Kembali ke Daftar RAB</a>
    </div>
  </div>

  <script>
    // Fungsi terbilang dalam JavaScript (Sama seperti sebelumnya)
    function terbilang(angka) {
        var bilangan = String(angka).split('.');
        var bulat = parseInt(bilangan[0]);
        var desimal = bilangan.length > 1 ? parseInt(bilangan[1]) : 0;

        var units = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'];
        var scales = ['', 'ribu', 'juta', 'milyar', 'triliun'];

        function convert(num) {
            if (num < 12) {
                return units[num];
            } else if (num < 20) {
                return convert(num - 10) + ' belas';
            } else if (num < 100) {
                return convert(Math.floor(num / 10)) + ' puluh ' + convert(num % 10);
            } else if (num < 200) {
                return 'seratus ' + convert(num - 100);
            } else if (num < 1000) {
                return convert(Math.floor(num / 100)) + ' ratus ' + convert(num % 100);
            }
            return '';
        }

        var result = [];
        var num = bulat;
        if (num === 0) result.push('nol');
        
        for (var i = 0; num > 0; i++) {
            var chunk = num % 1000;
            if (chunk > 0) {
                var convertedChunk = convert(chunk);
                // Handle "seribu" vs "satu ribu"
                if (convertedChunk === 'satu' && scales[i] === 'ribu') {
                    convertedChunk = 'seribu';
                }
                result.unshift(convertedChunk + ' ' + scales[i]);
            }
            num = Math.floor(num / 1000);
        }

        var finalResult = result.join(' ').replace(/\s+/g, ' ').trim();
        if (finalResult === '') {
            finalResult = 'nol';
        }

        // Handle decimals
        if (desimal > 0) {
            let desimalString = String(desimal).padEnd(2, '0');
            finalResult += ' koma ' + convert(parseInt(desimalString.substring(0,1))) + ' ' + convert(parseInt(desimalString.substring(1,2)));
        }
        return finalResult;
    }

    document.addEventListener('DOMContentLoaded', function() {
        const totalAmountElement = document.getElementById('total-rp');
        const terbilangOutputElement = document.getElementById('terbilang-output');

        if (totalAmountElement && terbilangOutputElement) {
            // Ambil teks total, hilangkan format rupiah (titik sebagai ribuan, koma sebagai desimal)
            // Ubah koma desimal menjadi titik agar parseFloat bekerja dengan benar.
            let totalText = totalAmountElement.textContent.replace(/\./g, '').replace(/,/g, '.');
            let totalValue = parseFloat(totalText);

            if (!isNaN(totalValue)) {
                terbilangOutputElement.textContent = terbilang(totalValue) + " Rupiah";
            } else {
                terbilangOutputElement.textContent = "Jumlah tidak valid untuk dihitung terbilang.";
            }
        }
    });
  </script>
</body>
</html>