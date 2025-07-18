@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <!-- Header Section -->
        <div class="col-12">
            <div class="box no-shadow mb-0 bg-transparent">
                <div class="box-header no-border px-0">
                    <h4 class="section-title">Konstruksi - Dokumen Kontrak</h4>
                </div>
            </div>
        </div>
        <hr />

        <div class="col-12">
            <button class="dashboard-btn">Rancangan Kontrak </button>
        </div>

        <!-- Row 1 -->
        <div class="col-xl-4 col-md-6 col-12">
            <a href="/PerizinanLayakOperasi/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInLeft"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">Surat Penunjukan Penyedia Barang Jasa (SPPBJ)</h6>
                            <p class="text-fade mb-0 fs-12">Menampilkan diagram .</p>
                        </div>

                        <!-- Gambar, 40% -->
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="../images/svg-icon/color-svg/Pipe9.svg" alt="Icon"
                                 style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 col-12">
            <a href="/Coi/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInRight"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">Surat Perjanjian Kerja (SPK)/ Surat Perjanjian (SP)</h6>
                            <p class="text-fade mb-0 fs-12">Menampilkan data pekerja .</p>
                        </div>

                        <!-- Gambar, 40% -->
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="../images/svg-icon/color-svg/Pipe10.svg" alt="Icon"
                                 style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 col-12">
            <a href="/ResidualLifeAssessment/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInLeft"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">Surat Perintah Mulai Kerja (SPMK)</h6>
                            <p class="text-fade mb-0 fs-12">Informasi Memantau status kontrak perusahaan.</p>
                        </div>

                        <!-- Gambar, 40% -->
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="../images/svg-icon/color-svg/Pipe11.svg" alt="Icon"
                                 style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>


  

    <!-- Row 2 -->
    <div class="row">
        <div class="col-xl-4 col-md-6 col-12">
            <a href="/SertifikasiBapeten/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInRight"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">Berita Acara Penyerahan Lapangan (BAPL)</h6>
                            <p class="text-fade mb-0 fs-12">Menampilkan kalender acara penting organisasi.</p>
                        </div>

                        <!-- Gambar, 40% -->
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="../images/svg-icon/color-svg/Pipe12.svg" alt="Icon"
                                 style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 col-12">
            <a href="/SertifikasiDisnaker/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInLeft"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">Harga Perkiraan Sendiri (HPS) </h6>
                            <p class="text-fade mb-0 fs-12">Informasi Isu utama yang perlu perhatian.</p>
                        </div>
                        <!-- Gambar, 40% -->
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="../images/svg-icon/color-svg/Pipe13.svg" alt="Icon"
                                 style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 col-12">
            <a href="/SertifikasiDisnaker/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInLeft"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">Rencana Time Schedule</h6>
                            <p class="text-fade mb-0 fs-12">Informasi Isu utama yang perlu perhatian.</p>
                        </div>
                
                        <!-- Gambar, 40% -->
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="../images/svg-icon/color-svg/Pipe13.svg" alt="Icon"
                                 style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-4 col-md-6 col-12">
            <a href="/SertifikasiBapeten/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInRight"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">Gambar</h6>
                            <p class="text-fade mb-0 fs-12">Menampilkan kalender acara penting organisasi.</p>
                        </div>

                        <!-- Gambar, 40% -->
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="../images/svg-icon/color-svg/Pipe12.svg" alt="Icon"
                                 style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>

      
       
    </div>

        
    <div class="col-12">
        <button class="knowledge-btn">Dokumen Kontrak Lainnya</button>
    </div>

    
    <div class="row">
        <div class="col-xl-4 col-md-6 col-12">
            <a href="/SertifikasiBapeten/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInRight"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">Spesifikasi Teknis dan Metodelogi Penelitian</h6>
                            <p class="text-fade mb-0 fs-12">Menampilkan kalender acara penting organisasi.</p>
                        </div>

                        <!-- Gambar, 40% -->
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="../images/svg-icon/color-svg/Pipe18.svg" alt="Icon"
                                 style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 col-12">
            <a href="/SertifikasiDisnaker/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInLeft"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">Syarat-Syarat Khusus Kontrak (SSKK)</h6>
                            <p class="text-fade mb-0 fs-12">Informasi Isu utama yang perlu perhatian.</p>
                        </div>
                        <!-- Gambar, 40% -->
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="../images/svg-icon/color-svg/Pipe20.svg" alt="Icon"
                                 style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 col-12">
            <a href="/SertifikasiDisnaker/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInLeft"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">Syarat-Syarat Umum Kontrak (SSUK)</h6>
                            <p class="text-fade mb-0 fs-12">Informasi Isu utama yang perlu perhatian.</p>
                        </div>
                
                        <!-- Gambar, 40% -->
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="../images/svg-icon/color-svg/Pipe19.svg" alt="Icon"
                                 style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-4 col-md-6 col-12">
            <a href="/SertifikasiBapeten/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInRight"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">Uraian singkat Pekerjaan </h6>
                            <p class="text-fade mb-0 fs-12">Menampilkan kalender acara penting organisasi.</p>
                        </div>

                        <!-- Gambar, 40% -->
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="../images/svg-icon/color-svg/Pipe40.svg" alt="Icon"
                                 style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>

      

       
    </div>

       
@endsection