@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <!-- Header Section -->
        <div class="col-12">
            <div class="box no-shadow mb-0 bg-transparent">
                <div class="box-header no-border px-0">
                    <h4 class="section-title">Beranda - Program Sumber Daya Air</h4>
                </div>
            </div>
        </div>
        <hr />

        <!-- Dashboard Button -->
        <div class="col-12">
            <button class="dashboard-btn">Pengelolaan SDA dan Bangunan Pengaman Pantai pada Wilayah Sungai Lintas Daerah Kabupaten /Kota</button>
        </div>

        <!-- Row 1 -->
        <div class="col-xl-4 col-md-6 col-12">
            <a href="{{ route('pembangunan-bendungan.index') }}">

                <div class="box bg-white pull-up animate__animated animate__lightSpeedInLeft"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">Pembangunan Bendungan </h6>
                            <p class="text-fade mb-0 fs-12">Menampilkan diagram struktur organisasi perusahaan.</p>
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
        <a href="{{ route('Pembangunan-embung-dan-air.index') }}">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInRight"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">Pembangunan Embung dan Penampung Air Lainnya</h6>
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
                            <h6 class="mt-25 mb-5">Pembangunan Sumur Air Tanah Untuk Air Baku</h6>
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
                            <h6 class="mt-25 mb-5">Pembangunan Unit Air Baku</h6>
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
                            <h6 class="mt-25 mb-5">Pembangunan Tanggul Sungai </h6>
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
            <a href="/UndangUndangPeraturan/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInRight"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">Pembangunan Bangunan Perkuatan Tebing </h6>
                            <p class="text-fade mb-0 fs-12">Informasi Status izin pekerja .</p>
                        </div>

                        <!-- Gambar, 40% -->
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="../images/svg-icon/color-svg/Pipe14.svg" alt="Icon"
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
                            <h6 class="mt-25 mb-5">
                            Pembangunan Pintu Air/Bendung Pengendali Banjir 
                            </h6>
                            <p class="text-fade mb-0 fs-12">Menampilkan kalender acara.</p>
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
            <a href="/SertifikasiBapeten/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInRight"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">
                            Pembangunan Kanal Banjir
                            </h6>
                            <p class="text-fade mb-0 fs-12">Menampilkan kalender acara.</p>
                        </div>

                        <!-- Gambar, 40% -->
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="../images/svg-icon/color-svg/Pipe16.svg" alt="Icon"
                                 style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 col-12">
            <a href="/SertifikasiBapeten/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInRight"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">
                            Pembangunan Stasiun Pompa Banjir
                            </h6>
                            <p class="text-fade mb-0 fs-12">Menampilkan kalender acara.</p>
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
      

       
    </div>



    <div class="row">
        <div class="col-xl-4 col-md-6 col-12">
            <a href="/SertifikasiBapeten/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInRight"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">
                            Pembangunan Polder/Kolam Retensi 
                            </h6>
                            <p class="text-fade mb-0 fs-12">Menampilkan kalender acara.</p>
                        </div>

                        <!-- Gambar, 40% -->
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="../images/svg-icon/color-svg/Pipe28.svg" alt="Icon"
                                 style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 col-12">
            <a href="/SertifikasiBapeten/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInRight"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">
                            Pembangunan Bangunan Sabo
                            </h6>
                            <p class="text-fade mb-0 fs-12">Menampilkan kalender acara.</p>
                        </div>

                        <!-- Gambar, 40% -->
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="../images/svg-icon/color-svg/Pipe29.svg" alt="Icon"
                                 style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 col-12">
            <a href="/SertifikasiBapeten/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInRight"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">
                            Pembangunan Check Dam
                            </h6>
                            <p class="text-fade mb-0 fs-12">Menampilkan kalender acara.</p>
                        </div>

                        <!-- Gambar, 40% -->
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="../images/svg-icon/color-svg/Pipe30.svg" alt="Icon"
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
                            <h6 class="mt-25 mb-5">
                            Pembangunan Breakwater                            </h6>
                            <p class="text-fade mb-0 fs-12">Menampilkan kalender acara.</p>
                        </div>

                        <!-- Gambar, 40% -->
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="../images/svg-icon/color-svg/Pipe31.svg" alt="Icon"
                                 style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 col-12">
            <a href="/SertifikasiBapeten/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInRight"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">
                            Pembangunan Seawall dan Bangunan Pengaman Pantai Lainnya                            </h6>
                        </div>

                        <!-- Gambar, 40% -->
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="../images/svg-icon/color-svg/Pipe42.svg" alt="Icon"
                                 style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 col-12">
            <a href="/SertifikasiBapeten/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInRight"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">
                            Pembangunan Flood Forecasting And Warning System (FFWS)                            </h6>
                            <p class="text-fade mb-0 fs-12">Menampilkan kalender acara.</p>
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


    
    <div class="row">
        <div class="col-xl-4 col-md-6 col-12">
            <a href="/SertifikasiBapeten/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInRight"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">
                            Rehabilitasi Bendungan
                            </h6>
                            <p class="text-fade mb-0 fs-12">Menampilkan kalender acara.</p>
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

        <div class="col-xl-4 col-md-6 col-12">
            <a href="/SertifikasiBapeten/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInRight"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">
                            Rehabilitasi Sumur Air Tanah Untuk Air Baku                            </h6>
                        </div>

                        <!-- Gambar, 40% -->
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="../images/svg-icon/color-svg/Pipe17.svg" alt="Icon"
                                 style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 col-12">
            <a href="/SertifikasiBapeten/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInRight"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">
                            Rehabilitasi Embung dan Penampung Air Lainnya                          </h6>
                            <p class="text-fade mb-0 fs-12">Menampilkan kalender acara.</p>
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
      

       
    </div>


    <div class="col-12">
        <button class="knowledge-btn">Pengembangan dan Pengelolaan Sistem Irigasi Primer dan Sekunder pada Daerah Irigasi yang Luasnya 1000 Ha-3000 Ha dan Daerah Irigasi Lintas Daerah Kabupaten/Kota</button>
    </div>



    <div class="row">
        <div class="col-xl-4 col-md-6 col-12">
            <a href="/SertifikasiBapeten/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInRight"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">
                            Penyusunan Rencana Teknis dan Dokumen Lingkungan Hidup Untuk Konstruksi Irigasi dan Rawa                            </h6>
                            <p class="text-fade mb-0 fs-12">Menampilkan kalender acara.</p>
                        </div>

                        <!-- Gambar, 40% -->
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="../images/svg-icon/color-svg/Pipe28.svg" alt="Icon"
                                 style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 col-12">
            <a href="/SertifikasiBapeten/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInRight"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">
                            Pembangunan Jaringan Irigasi Permukaan                             </h6>
                            <p class="text-fade mb-0 fs-12">Menampilkan kalender acara.</p>
                        </div>

                        <!-- Gambar, 40% -->
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="../images/svg-icon/color-svg/Pipe29.svg" alt="Icon"
                                 style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 col-12">
            <a href="/SertifikasiBapeten/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInRight"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">
                            Pembangunan Jaringan Irigasi Permukaan                             </h6>
                            <p class="text-fade mb-0 fs-12">Menampilkan kalender acara.</p>
                        </div>

                        <!-- Gambar, 40% -->
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="../images/svg-icon/color-svg/Pipe30.svg" alt="Icon"
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
                            <h6 class="mt-25 mb-5">
                            Pembangunan Jaringan Irigasi Rawa       </h6>
                                                 <p class="text-fade mb-0 fs-12">Menampilkan kalender acara event setiap hari.</p>
                        </div>

                        <!-- Gambar, 40% -->
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="../images/svg-icon/color-svg/Pipe28.svg" alt="Icon"
                                 style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 col-12">
            <a href="/SertifikasiBapeten/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInRight"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">
                            Pembangunan Jaringan Irigasi Tambak                             </h6>
                            <p class="text-fade mb-0 fs-12">Menampilkan kalender acara.</p>
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

        <div class="col-xl-4 col-md-6 col-12">
            <a href="/SertifikasiBapeten/Index">
                <div class="box bg-white pull-up animate__animated animate__lightSpeedInRight"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body" style="display: flex; align-items: center;">
                        <!-- Tulisan, 60% -->
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">
                            Pembangunan Sumur Jaringan Irigasi Air Tanah                             </h6>
                            <p class="text-fade mb-0 fs-12">Menampilkan kalender acara.</p>
                        </div>

                        <!-- Gambar, 40% -->
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="../images/svg-icon/color-svg/Pipe30.svg" alt="Icon"
                                 style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>
      

       
    </div>
@endsection