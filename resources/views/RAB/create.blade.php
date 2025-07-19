@extends('layouts.app')
@section('content')
<div class="container">
    <h2 class="text-center mb-4">Tambah Rencana Anggaran Biaya (RAB)</h2>

    <form action="{{ route('rab.store') }}" method="POST">
        @csrf
        
        <!-- Informasi Umum -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5>Informasi Umum</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pekerjaan</label>
                            <input type="text" name="pekerjaan" class="form-control" required 
                                   value="Perencanaan Teknis Pengendalian Banjir Di Alfa Omega Kota Jayapura Titik I dan Perencanaan Teknis Pengendalian Banjir Di Alfa Omega Kota Jayapura Titik II">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Lokasi</label>
                            <input type="text" name="lokasi" class="form-control" required value="Kota Jayapura">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Masa Pelaksanaan</label>
                            <input type="text" name="masa_pelaksanaan" class="form-control" required value="15 (Lima belas) Hari Kalender">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sumber Dana</label>
                            <input type="text" name="sumber_dana" class="form-control" required value="APBD-P Tahun 2024">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Biaya Langsung Personil -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5>A. BIAYA LANGSUNG PERSONIL</h5>
            </div>
            <div class="card-body">
                <!-- Profesional Staff -->
                <h6>A.1. Profesional Staff</h6>
                <div class="table-responsive">
                    <table id="tblProfesional" class="table table-bordered table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">No.</th>
                                <th width="25%">Uraian</th>
                                <th width="10%">Volume</th>
                                <th width="10%">Satuan</th>
                                <th width="20%">Harga Satuan (Rp)</th>
                                <th width="20%">Jumlah Harga (Rp)</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Default rows will be added by JavaScript -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-right font-weight-bold">Jumlah A.1.</td>
                                <td id="totalProfesional" class="text-right font-weight-bold">0</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <button type="button" class="btn btn-sm btn-primary mt-2" onclick="addProfesionalRow()">
                    <i class="fas fa-plus"></i> Tambah Profesional Staff
                </button>

                <!-- Tenaga Ahli Sub Profesional -->
                <h6 class="mt-4">A.2. Tenaga Ahli Sub Professional</h6>
                <div class="table-responsive">
                    <table id="tblTenagaAhli" class="table table-bordered table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">No.</th>
                                <th width="25%">Personil</th>
                                <th width="10%">Jumlah</th>
                                <th width="10%">Satuan</th>
                                <th width="20%">Harga Satuan (Rp)</th>
                                <th width="20%">Jumlah Biaya (Rp)</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Default rows will be added by JavaScript -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-right font-weight-bold">Jumlah A.2.</td>
                                <td id="totalTenagaAhli" class="text-right font-weight-bold">0</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <button type="button" class="btn btn-sm btn-primary mt-2" onclick="addTenagaAhliRow()">
                    <i class="fas fa-plus"></i> Tambah Tenaga Ahli
                </button>

                <!-- Tenaga Pendukung -->
                <h6 class="mt-4">A.3. Tenaga Pendukung (Supporting Staff)</h6>
                <div class="table-responsive">
                    <table id="tblTenagaPendukung" class="table table-bordered table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">No.</th>
                                <th width="25%">Personil</th>
                                <th width="10%">Jumlah</th>
                                <th width="10%">Satuan</th>
                                <th width="20%">Harga Satuan (Rp)</th>
                                <th width="20%">Jumlah Biaya (Rp)</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Default rows will be added by JavaScript -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-right font-weight-bold">Jumlah A.3.</td>
                                <td id="totalTenagaPendukung" class="text-right font-weight-bold">0</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <button type="button" class="btn btn-sm btn-primary mt-2" onclick="addTenagaPendukungRow()">
                    <i class="fas fa-plus"></i> Tambah Tenaga Pendukung
                </button>

                <!-- Total Biaya Personil -->
                <div class="row mt-3">
                    <div class="col-md-6 offset-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <td class="font-weight-bold">Jumlah A (Biaya Langsung Personil)</td>
                                <td id="totalPersonil" class="text-right font-weight-bold">0</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Biaya Langsung Non Personil -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5>B. BIAYA LANGSUNG NON PERSONIL</h5>
            </div>
            <div class="card-body">
                <!-- Operasional Kantor -->
                <h6>B.1. Biaya Operasional Kantor</h6>
                <div class="table-responsive">
                    <table id="tblOperasionalKantor" class="table table-bordered table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">No.</th>
                                <th width="25%">Uraian</th>
                                <th width="10%">Jumlah</th>
                                <th width="10%">Satuan</th>
                                <th width="20%">Harga Satuan (Rp)</th>
                                <th width="20%">Jumlah Biaya (Rp)</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Default rows will be added by JavaScript -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-right font-weight-bold">Jumlah B.1.</td>
                                <td id="totalOperasionalKantor" class="text-right font-weight-bold">0</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <button type="button" class="btn btn-sm btn-primary mt-2" onclick="addOperasionalKantorRow()">
                    <i class="fas fa-plus"></i> Tambah Operasional Kantor
                </button>

                <!-- Biaya Perjalanan Dinas -->
                <h6 class="mt-4">B.2. Biaya Perjalanan Dinas/Perdiem Allowance</h6>
                <div class="table-responsive">
                    <table id="tblPerjalananDinas" class="table table-bordered table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">No.</th>
                                <th width="25%">Uraian</th>
                                <th width="10%">Jumlah</th>
                                <th width="10%">Satuan</th>
                                <th width="20%">Harga Satuan (Rp)</th>
                                <th width="20%">Jumlah Biaya (Rp)</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><input type="text" name="biaya_perjalanan_dinas[0][uraian]" class="form-control form-control-sm" value="Biaya Perjalanan Dinas"></td>
                                <td><input type="number" step="0.01" name="biaya_perjalanan_dinas[0][jumlah]" class="form-control form-control-sm" value="1"></td>
                                <td><input type="text" name="biaya_perjalanan_dinas[0][satuan]" class="form-control form-control-sm" value="Paket"></td>
                                <td><input type="number" name="biaya_perjalanan_dinas[0][harga_satuan]" class="form-control form-control-sm harga-satuan" value="0"></td>
                                <td class="jumlah-biaya">0</td>
                                <td><input type="hidden" name="biaya_perjalanan_dinas[0][jumlah_biaya]" value="0">
                                    <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove(); calculateTotals()">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-right font-weight-bold">Jumlah B.2.</td>
                                <td id="totalPerjalananDinas" class="text-right font-weight-bold">0</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <button type="button" class="btn btn-sm btn-primary mt-2" onclick="addPerjalananDinasRow()">
                    <i class="fas fa-plus"></i> Tambah Biaya Perjalanan
                </button>

                <!-- Depresiasi Perlengkapan -->
                <h6 class="mt-4">B.3. Depresiasi Perlengkapan Khusus dan Lapangan</h6>
                <div class="table-responsive">
                    <table id="tblDepresiasi" class="table table-bordered table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">No.</th>
                                <th width="25%">Uraian</th>
                                <th width="10%">Jumlah</th>
                                <th width="10%">Satuan</th>
                                <th width="20%">Harga Satuan (Rp)</th>
                                <th width="20%">Jumlah Biaya (Rp)</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><input type="text" name="depresiasi[0][uraian]" class="form-control form-control-sm" value="Depresiasi Perlengkapan"></td>
                                <td><input type="number" step="0.01" name="depresiasi[0][jumlah]" class="form-control form-control-sm" value="1"></td>
                                <td><input type="text" name="depresiasi[0][satuan]" class="form-control form-control-sm" value="Paket"></td>
                                <td><input type="number" name="depresiasi[0][harga_satuan]" class="form-control form-control-sm harga-satuan" value="0"></td>
                                <td class="jumlah-biaya">0</td>
                                <td><input type="hidden" name="depresiasi[0][jumlah_biaya]" value="0">
                                    <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove(); calculateTotals()">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-right font-weight-bold">Jumlah B.3.</td>
                                <td id="totalDepresiasi" class="text-right font-weight-bold">0</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <button type="button" class="btn btn-sm btn-primary mt-2" onclick="addDepresiasiRow()">
                    <i class="fas fa-plus"></i> Tambah Depresiasi
                </button>

                <!-- Biaya Pelaporan -->
                <h6 class="mt-4">B.4. Biaya Pelaporan</h6>
                <div class="table-responsive">
                    <table id="tblBiayaPelaporan" class="table table-bordered table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">No.</th>
                                <th width="25%">Uraian</th>
                                <th width="10%">Jumlah</th>
                                <th width="10%">Satuan</th>
                                <th width="20%">Harga Satuan (Rp)</th>
                                <th width="20%">Jumlah Biaya (Rp)</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><input type="text" name="biaya_pelaporan[0][uraian]" class="form-control form-control-sm" value="Biaya Pelaporan"></td>
                                <td><input type="number" step="0.01" name="biaya_pelaporan[0][jumlah]" class="form-control form-control-sm" value="1"></td>
                                <td><input type="text" name="biaya_pelaporan[0][satuan]" class="form-control form-control-sm" value="Paket"></td>
                                <td><input type="number" name="biaya_pelaporan[0][harga_satuan]" class="form-control form-control-sm harga-satuan" value="0"></td>
                                <td class="jumlah-biaya">0</td>
                                <td><input type="hidden" name="biaya_pelaporan[0][jumlah_biaya]" value="0">
                                    <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove(); calculateTotals()">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-right font-weight-bold">Jumlah B.4.</td>
                                <td id="totalBiayaPelaporan" class="text-right font-weight-bold">0</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <button type="button" class="btn btn-sm btn-primary mt-2" onclick="addBiayaPelaporanRow()">
                    <i class="fas fa-plus"></i> Tambah Biaya Pelaporan
                </button>

                <!-- Total Biaya Non Personil -->
                <div class="row mt-3">
                    <div class="col-md-6 offset-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <td class="font-weight-bold">Jumlah B (Biaya Langsung Non Personil)</td>
                                <td id="totalNonPersonil" class="text-right font-weight-bold">0</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rekapitulasi Total -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5>REKAPITULASI TOTAL</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 offset-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <td class="font-weight-bold">Jumlah (A + B)</td>
                                <td id="totalAB" class="text-right font-weight-bold">0</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">PPN 11%</td>
                                <td id="ppn" class="text-right font-weight-bold">0</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">TOTAL</td>
                                <td id="totalAll" class="text-right font-weight-bold">0</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <label>Terbilang</label>
                    <input type="text" name="terbilang" class="form-control" readonly value="">
                </div>
            </div>
        </div>

        <!-- Penyedia & Pejabat -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5>PENYEDIA & PEJABAT</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Penyedia</h6>
                        <div class="form-group">
                            <label>Nama Penyedia</label>
                            <input type="text" name="nama_penyedia" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Perusahaan Penyedia</label>
                            <input type="text" name="nama_perusahaan_penyedia" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Jabatan Penyedia</label>
                            <input type="text" name="jabatan_penyedia" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6>Pejabat Penandatangan</h6>
                        <div class="form-group">
                            <label>Nama Pejabat Penandatangan Kontrak</label>
                            <input type="text" name="nama_pejabat_penandatangan_kontrak" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Jabatan Pejabat</label>
                            <input type="text" name="jabatan_pejabat" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>NIP Pejabat</label>
                            <input type="text" name="nip_pejabat" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mb-4">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-save"></i> Simpan RAB
            </button>
            <a href="{{ route('rab.index') }}" class="btn btn-secondary btn-lg ml-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>

<script>
// Data default sesuai gambar (hanya uraian)
const defaultProfesionalStaff = [
    { uraian: 'Team Leader', volume: '', satuan: 'OB', harga_satuan: '' },
    { uraian: 'Ahli Bidang Teknik SDA', volume: '', satuan: 'OB', harga_satuan: '' },
    { uraian: 'Ahli Hidrologi', volume: '', satuan: 'OB', harga_satuan: '' },
    { uraian: 'Ahli Lingkungan', volume: '', satuan: 'OB', harga_satuan: '' },
    { uraian: 'Ahli Keselamatan Konstruksi', volume: '', satuan: 'OB', harga_satuan: '' }
];

const defaultTenagaAhliSub = [
    { personil: 'Surveyor', jumlah: '', satuan: 'OB', harga_satuan: '' },
    { personil: 'Operator CAD/CAM', jumlah: '', satuan: 'OB', harga_satuan: '' },
    { personil: 'Operator SIG', jumlah: '', satuan: 'OB', harga_satuan: '' }
];

const defaultTenagaPendukung = [
    { personil: 'Sekretaris', jumlah: '', satuan: 'OB', harga_satuan: '' },
    { personil: 'Operator Komputer', jumlah: '', satuan: 'OB', harga_satuan: '' },
    { personil: 'Pengemudi', jumlah: '', satuan: 'OB', harga_satuan: '' },
    { personil: 'Pesuruh', jumlah: '', satuan: 'OB', harga_satuan: '' },
    { personil: 'Tenaga Harlan Lokal', jumlah: '', satuan: 'OH', harga_satuan: '' }
];

const defaultOperasionalKantor = [
    { uraian: 'Operasional Kantor', jumlah: '', satuan: 'Unit-Bulan', harga_satuan: '' },
    { uraian: 'Komunikasi', jumlah: '', satuan: 'Bulan', harga_satuan: '' },
    { uraian: 'Operasional Lapangan', jumlah: '', satuan: 'Bulan', harga_satuan: '' },
    { uraian: 'Sewa Kendaraan Operasional', jumlah: '', satuan: 'Bulan', harga_satuan: '' }
];

// Fungsi untuk menambah baris profesional staff
function addProfesionalRow(data = {}) {
    const table = document.querySelector('#tblProfesional tbody');
    const rowCount = table.rows.length;
    const newRow = table.insertRow();
    
    const total = (data.harga_satuan || 0) * (data.volume || 0);
    
    newRow.innerHTML = `
        <td>${rowCount + 1}</td>
        <td><input type="text" name="biaya_langsung_personil_profesional_staf[${rowCount}][uraian]" 
            value="${data.uraian || ''}" class="form-control form-control-sm" required></td>
        <td><input type="number" step="0.01" name="biaya_langsung_personil_profesional_staf[${rowCount}][volume]" 
            value="${data.volume || ''}" class="form-control form-control-sm volume" required></td>
        <td><input type="text" name="biaya_langsung_personil_profesional_staf[${rowCount}][satuan]" 
            value="${data.satuan || 'OB'}" class="form-control form-control-sm" required></td>
        <td><input type="number" name="biaya_langsung_personil_profesional_staf[${rowCount}][harga_satuan]" 
            value="${data.harga_satuan || ''}" class="form-control form-control-sm harga-satuan" required></td>
        <td class="jumlah-harga text-right">${total.toLocaleString('id-ID')}</td>
        <td><input type="hidden" name="biaya_langsung_personil_profesional_staf[${rowCount}][jumlah_harga]" value="${total}">
            <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove(); calculateTotals()">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;
    
    // Tambahkan event listener untuk menghitung otomatis
    const inputs = newRow.querySelectorAll('input[type="number"]');
    inputs.forEach(input => {
        input.addEventListener('change', function() {
            const row = this.closest('tr');
            const volume = parseFloat(row.querySelector('.volume').value) || 0;
            const hargaSatuan = parseFloat(row.querySelector('.harga-satuan').value) || 0;
            const total = volume * hargaSatuan;
            
            row.querySelector('.jumlah-harga').textContent = total.toLocaleString('id-ID');
            row.querySelector('input[name*="jumlah_harga"]').value = total;
            calculateTotals();
        });
    });
}

// Fungsi untuk menambah baris tenaga ahli sub profesional
function addTenagaAhliRow(data = {}) {
    const table = document.querySelector('#tblTenagaAhli tbody');
    const rowCount = table.rows.length;
    const newRow = table.insertRow();
    
    const total = (data.harga_satuan || 0) * (data.jumlah || 0);
    
    newRow.innerHTML = `
        <td>${rowCount + 1}</td>
        <td><input type="text" name="biaya_langsung_personil_tenaga_ahli_sub_profesional[${rowCount}][personil]" 
            value="${data.personil || ''}" class="form-control form-control-sm" required></td>
        <td><input type="number" step="0.01" name="biaya_langsung_personil_tenaga_ahli_sub_profesional[${rowCount}][jumlah]" 
            value="${data.jumlah || ''}" class="form-control form-control-sm jumlah" required></td>
        <td><input type="text" name="biaya_langsung_personil_tenaga_ahli_sub_profesional[${rowCount}][satuan]" 
            value="${data.satuan || 'OB'}" class="form-control form-control-sm" required></td>
        <td><input type="number" name="biaya_langsung_personil_tenaga_ahli_sub_profesional[${rowCount}][harga_satuan]" 
            value="${data.harga_satuan || ''}" class="form-control form-control-sm harga-satuan" required></td>
        <td class="jumlah-biaya text-right">${total.toLocaleString('id-ID')}</td>
        <td><input type="hidden" name="biaya_langsung_personil_tenaga_ahli_sub_profesional[${rowCount}][jumlah_biaya]" value="${total}">
            <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove(); calculateTotals()">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;
    
    // Tambahkan event listener untuk menghitung otomatis
    const inputs = newRow.querySelectorAll('input[type="number"]');
    inputs.forEach(input => {
        input.addEventListener('change', function() {
            const row = this.closest('tr');
            const jumlah = parseFloat(row.querySelector('.jumlah').value) || 0;
            const hargaSatuan = parseFloat(row.querySelector('.harga-satuan').value) || 0;
            const total = jumlah * hargaSatuan;
            
            row.querySelector('.jumlah-biaya').textContent = total.toLocaleString('id-ID');
            row.querySelector('input[name*="jumlah_biaya"]').value = total;
            calculateTotals();
        });
    });
}

// Fungsi untuk menambah baris tenaga pendukung
function addTenagaPendukungRow(data = {}) {
    const table = document.querySelector('#tblTenagaPendukung tbody');
    const rowCount = table.rows.length;
    const newRow = table.insertRow();
    
    const total = (data.harga_satuan || 0) * (data.jumlah || 0);
    
    newRow.innerHTML = `
        <td>${rowCount + 1}</td>
        <td><input type="text" name="biaya_langsung_personil_tenaga_pendukung[${rowCount}][personil]" 
            value="${data.personil || ''}" class="form-control form-control-sm" required></td>
        <td><input type="number" step="0.01" name="biaya_langsung_personil_tenaga_pendukung[${rowCount}][jumlah]" 
            value="${data.jumlah || ''}" class="form-control form-control-sm jumlah" required></td>
        <td><input type="text" name="biaya_langsung_personil_tenaga_pendukung[${rowCount}][satuan]" 
            value="${data.satuan || 'OB'}" class="form-control form-control-sm" required></td>
        <td><input type="number" name="biaya_langsung_personil_tenaga_pendukung[${rowCount}][harga_satuan]" 
            value="${data.harga_satuan || ''}" class="form-control form-control-sm harga-satuan" required></td>
        <td class="jumlah-biaya text-right">${total.toLocaleString('id-ID')}</td>
        <td><input type="hidden" name="biaya_langsung_personil_tenaga_pendukung[${rowCount}][jumlah_biaya]" value="${total}">
            <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove(); calculateTotals()">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;
    
    // Tambahkan event listener untuk menghitung otomatis
    const inputs = newRow.querySelectorAll('input[type="number"]');
    inputs.forEach(input => {
        input.addEventListener('change', function() {
            const row = this.closest('tr');
            const jumlah = parseFloat(row.querySelector('.jumlah').value) || 0;
            const hargaSatuan = parseFloat(row.querySelector('.harga-satuan').value) || 0;
            const total = jumlah * hargaSatuan;
            
            row.querySelector('.jumlah-biaya').textContent = total.toLocaleString('id-ID');
            row.querySelector('input[name*="jumlah_biaya"]').value = total;
            calculateTotals();
        });
    });
}

// Fungsi untuk menambah baris operasional kantor
function addOperasionalKantorRow(data = {}) {
    const table = document.querySelector('#tblOperasionalKantor tbody');
    const rowCount = table.rows.length;
    const newRow = table.insertRow();
    
    const total = (data.harga_satuan || 0) * (data.jumlah || 0);
    
    newRow.innerHTML = `
        <td>${rowCount + 1}</td>
        <td><input type="text" name="biaya_langsung_non_personil_biaya_operasional_kantor[${rowCount}][uraian]" 
            value="${data.uraian || ''}" class="form-control form-control-sm" required></td>
        <td><input type="number" step="0.01" name="biaya_langsung_non_personil_biaya_operasional_kantor[${rowCount}][jumlah]" 
            value="${data.jumlah || ''}" class="form-control form-control-sm jumlah" required></td>
        <td><input type="text" name="biaya_langsung_non_personil_biaya_operasional_kantor[${rowCount}][satuan]" 
            value="${data.satuan || 'Bulan'}" class="form-control form-control-sm" required></td>
        <td><input type="number" name="biaya_langsung_non_personil_biaya_operasional_kantor[${rowCount}][harga_satuan]" 
            value="${data.harga_satuan || ''}" class="form-control form-control-sm harga-satuan" required></td>
        <td class="jumlah-biaya text-right">${total.toLocaleString('id-ID')}</td>
        <td><input type="hidden" name="biaya_langsung_non_personil_biaya_operasional_kantor[${rowCount}][jumlah_biaya]" value="${total}">
            <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove(); calculateTotals()">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;
    
    // Tambahkan event listener untuk menghitung otomatis
    const inputs = newRow.querySelectorAll('input[type="number"]');
    inputs.forEach(input => {
        input.addEventListener('change', function() {
            const row = this.closest('tr');
            const jumlah = parseFloat(row.querySelector('.jumlah').value) || 0;
            const hargaSatuan = parseFloat(row.querySelector('.harga-satuan').value) || 0;
            const total = jumlah * hargaSatuan;
            
            row.querySelector('.jumlah-biaya').textContent = total.toLocaleString('id-ID');
            row.querySelector('input[name*="jumlah_biaya"]').value = total;
            calculateTotals();
        });
    });
}

// Fungsi untuk menambah baris perjalanan dinas
function addPerjalananDinasRow() {
    const table = document.querySelector('#tblPerjalananDinas tbody');
    const rowCount = table.rows.length;
    const newRow = table.insertRow();
    
    newRow.innerHTML = `
        <td>${rowCount + 1}</td>
        <td><input type="text" name="biaya_perjalanan_dinas[${rowCount}][uraian]" class="form-control form-control-sm" value="Biaya Perjalanan Dinas"></td>
        <td><input type="number" step="0.01" name="biaya_perjalanan_dinas[${rowCount}][jumlah]" class="form-control form-control-sm jumlah" value="1"></td>
        <td><input type="text" name="biaya_perjalanan_dinas[${rowCount}][satuan]" class="form-control form-control-sm" value="Paket"></td>
        <td><input type="number" name="biaya_perjalanan_dinas[${rowCount}][harga_satuan]" class="form-control form-control-sm harga-satuan" value="0"></td>
        <td class="jumlah-biaya text-right">0</td>
        <td><input type="hidden" name="biaya_perjalanan_dinas[${rowCount}][jumlah_biaya]" value="0">
            <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove(); calculateTotals()">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;
    
    // Tambahkan event listener untuk menghitung otomatis
    const inputs = newRow.querySelectorAll('input[type="number"]');
    inputs.forEach(input => {
        input.addEventListener('change', function() {
            const row = this.closest('tr');
            const jumlah = parseFloat(row.querySelector('.jumlah').value) || 0;
            const hargaSatuan = parseFloat(row.querySelector('.harga-satuan').value) || 0;
            const total = jumlah * hargaSatuan;
            
            row.querySelector('.jumlah-biaya').textContent = total.toLocaleString('id-ID');
            row.querySelector('input[name*="jumlah_biaya"]').value = total;
            calculateTotals();
        });
    });
}

// Fungsi untuk menambah baris depresiasi
function addDepresiasiRow() {
    const table = document.querySelector('#tblDepresiasi tbody');
    const rowCount = table.rows.length;
    const newRow = table.insertRow();
    
    newRow.innerHTML = `
        <td>${rowCount + 1}</td>
        <td><input type="text" name="depresiasi[${rowCount}][uraian]" class="form-control form-control-sm" value="Depresiasi Perlengkapan"></td>
        <td><input type="number" step="0.01" name="depresiasi[${rowCount}][jumlah]" class="form-control form-control-sm jumlah" value="1"></td>
        <td><input type="text" name="depresiasi[${rowCount}][satuan]" class="form-control form-control-sm" value="Paket"></td>
        <td><input type="number" name="depresiasi[${rowCount}][harga_satuan]" class="form-control form-control-sm harga-satuan" value="0"></td>
        <td class="jumlah-biaya text-right">0</td>
        <td><input type="hidden" name="depresiasi[${rowCount}][jumlah_biaya]" value="0">
            <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove(); calculateTotals()">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;
    
    // Tambahkan event listener untuk menghitung otomatis
    const inputs = newRow.querySelectorAll('input[type="number"]');
    inputs.forEach(input => {
        input.addEventListener('change', function() {
            const row = this.closest('tr');
            const jumlah = parseFloat(row.querySelector('.jumlah').value) || 0;
            const hargaSatuan = parseFloat(row.querySelector('.harga-satuan').value) || 0;
            const total = jumlah * hargaSatuan;
            
            row.querySelector('.jumlah-biaya').textContent = total.toLocaleString('id-ID');
            row.querySelector('input[name*="jumlah_biaya"]').value = total;
            calculateTotals();
        });
    });
}

// Fungsi untuk menambah baris biaya pelaporan
function addBiayaPelaporanRow() {
    const table = document.querySelector('#tblBiayaPelaporan tbody');
    const rowCount = table.rows.length;
    const newRow = table.insertRow();
    
    newRow.innerHTML = `
        <td>${rowCount + 1}</td>
        <td><input type="text" name="biaya_pelaporan[${rowCount}][uraian]" class="form-control form-control-sm" value="Biaya Pelaporan"></td>
        <td><input type="number" step="0.01" name="biaya_pelaporan[${rowCount}][jumlah]" class="form-control form-control-sm jumlah" value="1"></td>
        <td><input type="text" name="biaya_pelaporan[${rowCount}][satuan]" class="form-control form-control-sm" value="Paket"></td>
        <td><input type="number" name="biaya_pelaporan[${rowCount}][harga_satuan]" class="form-control form-control-sm harga-satuan" value="0"></td>
        <td class="jumlah-biaya text-right">0</td>
        <td><input type="hidden" name="biaya_pelaporan[${rowCount}][jumlah_biaya]" value="0">
            <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove(); calculateTotals()">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;
    
    // Tambahkan event listener untuk menghitung otomatis
    const inputs = newRow.querySelectorAll('input[type="number"]');
    inputs.forEach(input => {
        input.addEventListener('change', function() {
            const row = this.closest('tr');
            const jumlah = parseFloat(row.querySelector('.jumlah').value) || 0;
            const hargaSatuan = parseFloat(row.querySelector('.harga-satuan').value) || 0;
            const total = jumlah * hargaSatuan;
            
            row.querySelector('.jumlah-biaya').textContent = total.toLocaleString('id-ID');
            row.querySelector('input[name*="jumlah_biaya"]').value = total;
            calculateTotals();
        });
    });
}

// Fungsi untuk menghitung total keseluruhan
function calculateTotals() {
    // Hitung total profesional staff
    let totalProfesional = 0;
    document.querySelectorAll('#tblProfesional tbody tr').forEach(row => {
        totalProfesional += parseFloat(row.querySelector('input[name*="jumlah_harga"]').value) || 0;
    });
    document.getElementById('totalProfesional').textContent = totalProfesional.toLocaleString('id-ID');
    
    // Hitung total tenaga ahli sub profesional
    let totalTenagaAhli = 0;
    document.querySelectorAll('#tblTenagaAhli tbody tr').forEach(row => {
        totalTenagaAhli += parseFloat(row.querySelector('input[name*="jumlah_biaya"]').value) || 0;
    });
    document.getElementById('totalTenagaAhli').textContent = totalTenagaAhli.toLocaleString('id-ID');
    
    // Hitung total tenaga pendukung
    let totalTenagaPendukung = 0;
    document.querySelectorAll('#tblTenagaPendukung tbody tr').forEach(row => {
        totalTenagaPendukung += parseFloat(row.querySelector('input[name*="jumlah_biaya"]').value) || 0;
    });
    document.getElementById('totalTenagaPendukung').textContent = totalTenagaPendukung.toLocaleString('id-ID');
    
    // Hitung total personil
    const totalPersonil = totalProfesional + totalTenagaAhli + totalTenagaPendukung;
    document.getElementById('totalPersonil').textContent = totalPersonil.toLocaleString('id-ID');
    
    // Hitung total operasional kantor
    let totalOperasional = 0;
    document.querySelectorAll('#tblOperasionalKantor tbody tr').forEach(row => {
        totalOperasional += parseFloat(row.querySelector('input[name*="jumlah_biaya"]').value) || 0;
    });
    document.getElementById('totalOperasionalKantor').textContent = totalOperasional.toLocaleString('id-ID');
    
    // Hitung total perjalanan dinas
    let totalPerjalanan = 0;
    document.querySelectorAll('#tblPerjalananDinas tbody tr').forEach(row => {
        totalPerjalanan += parseFloat(row.querySelector('input[name*="jumlah_biaya"]').value) || 0;
    });
    document.getElementById('totalPerjalananDinas').textContent = totalPerjalanan.toLocaleString('id-ID');
    
    // Hitung total depresiasi
    let totalDepresiasi = 0;
    document.querySelectorAll('#tblDepresiasi tbody tr').forEach(row => {
        totalDepresiasi += parseFloat(row.querySelector('input[name*="jumlah_biaya"]').value) || 0;
    });
    document.getElementById('totalDepresiasi').textContent = totalDepresiasi.toLocaleString('id-ID');
    
    // Hitung total biaya pelaporan
    let totalPelaporan = 0;
    document.querySelectorAll('#tblBiayaPelaporan tbody tr').forEach(row => {
        totalPelaporan += parseFloat(row.querySelector('input[name*="jumlah_biaya"]').value) || 0;
    });
    document.getElementById('totalBiayaPelaporan').textContent = totalPelaporan.toLocaleString('id-ID');
    
    // Hitung total non personil
    const totalNonPersonil = totalOperasional + totalPerjalanan + totalDepresiasi + totalPelaporan;
    document.getElementById('totalNonPersonil').textContent = totalNonPersonil.toLocaleString('id-ID');
    
    // Hitung total A + B
    const totalAB = totalPersonil + totalNonPersonil;
    document.getElementById('totalAB').textContent = totalAB.toLocaleString('id-ID');
    
    // Hitung PPN 11%
    const ppn = totalAB * 0.11;
    document.getElementById('ppn').textContent = ppn.toLocaleString('id-ID');
    
    // Hitung total semua
    const totalAll = totalAB + ppn;
    document.getElementById('totalAll').textContent = totalAll.toLocaleString('id-ID');
    
    // Update terbilang
    document.querySelector('input[name="terbilang"]').value = terbilang(totalAll) + ' Rupiah';
}

// Fungsi untuk mengkonversi angka ke terbilang
function terbilang(angka) {
    angka = parseFloat(angka);
    const bil1 = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'];
    const bil2 = ['', 'puluh', 'ratus', 'ribu', 'juta', 'milyar', 'triliun'];
    
    if (angka < 12) {
        return bil1[angka];
    } else if (angka < 20) {
        return bil1[angka - 10] + ' belas';
    } else if (angka < 100) {
        const puluh = Math.floor(angka / 10);
        const sisa = angka % 10;
        return bil1[puluh] + ' puluh ' + bil1[sisa];
    } else if (angka < 200) {
        return 'seratus ' + terbilang(angka - 100);
    } else if (angka < 1000) {
        const ratus = Math.floor(angka / 100);
        const sisa = angka % 100;
        return bil1[ratus] + ' ratus ' + terbilang(sisa);
    } else if (angka < 2000) {
        return 'seribu ' + terbilang(angka - 1000);
    } else if (angka < 1000000) {
        const ribu = Math.floor(angka / 1000);
        const sisa = angka % 1000;
        return terbilang(ribu) + ' ribu ' + terbilang(sisa);
    } else if (angka < 1000000000) {
        const juta = Math.floor(angka / 1000000);
        const sisa = angka % 1000000;
        return terbilang(juta) + ' juta ' + terbilang(sisa);
    } else if (angka < 1000000000000) {
        const milyar = Math.floor(angka / 1000000000);
        const sisa = angka % 1000000000;
        return terbilang(milyar) + ' milyar ' + terbilang(sisa);
    } else {
        return 'Angka terlalu besar';
    }
}

// Tambahkan data default saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    // Profesional Staff
    defaultProfesionalStaff.forEach(item => addProfesionalRow(item));
    
    // Tenaga Ahli Sub Profesional
    defaultTenagaAhliSub.forEach(item => addTenagaAhliRow(item));
    
    // Tenaga Pendukung
    defaultTenagaPendukung.forEach(item => addTenagaPendukungRow(item));
    
    // Operasional Kantor
    defaultOperasionalKantor.forEach(item => addOperasionalKantorRow(item));
    
    // Hitung total awal
    calculateTotals();
});
</script>

<style>
.table th {
    white-space: nowrap;
    vertical-align: middle;
}
.table td {
    vertical-align: middle;
}
.text-right {
    text-align: right !important;
}
.form-control-sm {
    height: calc(1.5em + 0.5rem + 2px);
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    line-height: 1.5;
    border-radius: 0.2rem;
}
.card-header h5 {
    margin-bottom: 0;
}
</style>
@endsection