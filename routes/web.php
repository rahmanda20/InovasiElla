
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PerencanaanController;
use App\Http\Controllers\PengawasanController;
use App\Http\Controllers\KonstruksiController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\PembangunanBendunganController;
use App\Http\Controllers\PembangunanembungdanairController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\TemplateSuratController;
use App\Http\Controllers\PeninjauanSuratController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\RabController;


// Middleware untuk user yang sudah login (baik user biasa atau admin)
Route::middleware(['auth'])->group(function () {

    // 👤 Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 📁 Dokumen
    Route::prefix('dokumen')->group(function () {
        Route::get('/', [SuratController::class, 'index'])->name('dokumen.index');
        Route::post('/store', [SuratController::class, 'store'])->name('dokumen.store');
        Route::delete('/delete/{id}', [SuratController::class, 'destroy'])->name('dokumen.delete');

        // Upload
        Route::post('/upload-belum-ttd/{id}', [SuratController::class, 'uploadBelumTTD'])->name('dokumen.uploadBelumTTD');
        Route::post('/upload-ttd/{id}', [SuratController::class, 'uploadTTD'])->name('dokumen.uploadTTD');

        // Export
        Route::get('/export-excel/{id}', [SuratController::class, 'exportExcel'])->name('dokumen.exportExcel');
        Route::get('/export-draft/{id}', [SuratController::class, 'exportDraft'])->name('dokumen.exportDraft');
        Route::get('/export-final/{id}', [SuratController::class, 'exportFinal'])->name('dokumen.exportFinal');

        // Navigasi
        Route::get('/{jenis}', [SuratController::class, 'pilihJenis'])->name('dokumen.jenis');
        Route::get('/{jenis_dokumen}/{jenis_surat}', [SuratController::class, 'list'])->name('dokumen.list');
    });

    // 📄 Peninjauan Surat
    Route::get('/peninjauan', [PeninjauanSuratController::class, 'index'])->name('peninjauan.index');
    Route::post('/peninjauan/store', [PeninjauanSuratController::class, 'store'])->name('peninjauan.store');
    Route::post('/peninjauan/upload-ttd/{id}', [PeninjauanSuratController::class, 'uploadTTD'])->name('peninjauan.uploadTTD');

    // 🧩 Template Surat
    Route::get('/templatee', [TemplateSuratController::class, 'dashboard'])->name('template.dashboard');
    Route::get('/templatee/{jenis}', [TemplateSuratController::class, 'index'])->name('template.index');
    Route::post('/template/store', [TemplateSuratController::class, 'store'])->name('template.store');
    Route::get('/template/activate/{id}', [TemplateSuratController::class, 'activate'])->name('template.activate');
    Route::get('/template/download/{id}', [TemplateSuratController::class, 'download'])->name('template.download');
    Route::delete('/template/delete/{id}', [TemplateSuratController::class, 'delete'])->name('template.delete');

    // 🏠 Beranda
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/ProgramSDA', [BerandaController::class, 'ProgramSDA'])->name('ProgramSDA');

    // 📑 Perencanaan Dokumen
    Route::prefix('perencanaan')->group(function () {
        Route::get('/dokumen-kontrak', [PerencanaanController::class, 'DokumenKontrak'])->name('perencanaan.DokumenKontrak');
        Route::get('/list/{jenis_dokumen}/{jenis_surat}', [PerencanaanController::class, 'list'])->name('perencanaan.list');
        Route::post('/store', [PerencanaanController::class, 'store'])->name('perencanaan.store');

        // Export dan Upload
        Route::get('/export-excel/{id}', [PerencanaanController::class, 'exportExcel'])->name('perencanaan.exportExcel');
        Route::get('/export-draft/{id}', [PerencanaanController::class, 'exportDraft'])->name('perencanaan.exportDraft');
        Route::get('/export-final/{id}', [PerencanaanController::class, 'exportFinal'])->name('perencanaan.exportFinal');
        Route::post('/upload-draft/{id}', [PerencanaanController::class, 'uploadBelumTTD'])->name('perencanaan.uploadBelumTTD');
        Route::post('/upload-final/{id}', [PerencanaanController::class, 'uploadTTD'])->name('perencanaan.uploadTTD');
        Route::delete('/delete/{id}', [PerencanaanController::class, 'destroy'])->name('perencanaan.destroy');
    });

    // 📊 Pengawasan
    Route::get('/RekapanPengawasan', [PengawasanController::class, 'Rekapan'])->name('RekapanPengawasan');
    Route::get('/DokumenPengadaanPengawasan', [PengawasanController::class, 'DokumenPengadaan'])->name('DokumenPengadaanPengawasan');
    Route::get('/DokumenKontrakPengawasan', [PengawasanController::class, 'DokumenKontrak'])->name('DokumenKontrakPengawasan');

    // 🏗️ Konstruksi
    Route::get('/RekapanKonstruksi', [KonstruksiController::class, 'Rekapan'])->name('RekapanKonstruksi');
    Route::get('/DokumenPengadaanKonstruksi', [KonstruksiController::class, 'DokumenPengadaan'])->name('DokumenPengadaanKonstruksi');
    Route::get('/DokumenKontrakKonstruksi', [KonstruksiController::class, 'DokumenKontrak'])->name('DokumenKontrakKonstruksi');

    // 📚 Master
    Route::prefix('master')->group(function () {
        Route::get('/', [MasterController::class, 'index'])->name('master.index');
        Route::get('/create', [MasterController::class, 'create'])->name('master.create');
        Route::post('/store', [MasterController::class, 'store'])->name('master.store');
        Route::get('/{id}/edit/{key}', [MasterController::class, 'edit'])->name('master.edit');
        Route::put('/{id}/update/{key}', [MasterController::class, 'update'])->name('master.update');
        Route::delete('/{id}/{key}', [MasterController::class, 'destroy'])->name('master.destroy');
    });

    // 🌊 Pembangunan Bendungan
    Route::prefix('pembangunan-bendungan')->group(function () {
        Route::get('/', [PembangunanBendunganController::class, 'index'])->name('pembangunan-bendungan.index');
        Route::get('/create', [PembangunanBendunganController::class, 'create'])->name('pembangunan-bendungan.create');
        Route::post('/', [PembangunanBendunganController::class, 'store'])->name('pembangunan-bendungan.store');
        Route::get('/{id}/edit/{key}', [PembangunanBendunganController::class, 'edit'])->name('pembangunan-bendungan.edit');
        Route::put('/{id}/update/{key}', [PembangunanBendunganController::class, 'update'])->name('pembangunan-bendungan.update');
        Route::delete('/{id}/{key}', [PembangunanBendunganController::class, 'destroy'])->name('pembangunan-bendungan.destroy');
    });

    // 💧 Pembangunan Embung dan Air
    Route::prefix('pembangunan-embung-dan-air')->group(function () {
        Route::get('/', [PembangunanembungdanairController::class, 'index'])->name('Pembangunan-embung-dan-air.index');
        Route::get('/create', [PembangunanembungdanairController::class, 'create'])->name('Pembangunan-embung-dan-air.create');
        Route::post('/', [PembangunanembungdanairController::class, 'store'])->name('Pembangunan-embung-dan-air.store');
        Route::get('/{id}/edit/{key}', [PembangunanembungdanairController::class, 'edit'])->name('Pembangunan-embung-dan-air.edit');
        Route::put('/{id}/update/{key}', [PembangunanembungdanairController::class, 'update'])->name('Pembangunan-embung-dan-air.update');
        Route::delete('/{id}/{key}', [PembangunanembungdanairController::class, 'destroy'])->name('Pembangunan-embung-dan-air.destroy');
    });

 
    // 🖥️ Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');
});




Route::get('/rab', [RabController::class, 'index'])->name('rab.index');
Route::get('/rab/create', [RabController::class, 'create'])->name('rab.create');
Route::post('/rab', [RabController::class, 'store'])->name('rab.store');
Route::get('/rab/{id}', [RabController::class, 'show'])->name('rab.show');
Route::get('/rab/{id}/edit', [RabController::class, 'edit'])->name('rab.edit');
Route::put('/rab/{id}', [RabController::class, 'update'])->name('rab.update');
Route::delete('/rab/{id}', [RabController::class, 'destroy'])->name('rab.destroy');
// routes/web.php
Route::get('rab/{rab}/export-view', [RabController::class, 'exportFromView'])->name('rab.export.view');
Route::get('rab/{rab}/download-excel', [RabController::class, 'downloadExcel'])->name('rab.download.excel');
Route::get('/rab/{rab}/download-pdf', [RabController::class, 'downloadPdf'])->name('rab.downloadPdf');



// 🔐 Route Auth (Login, Register, etc.)
require __DIR__.'/auth.php';
