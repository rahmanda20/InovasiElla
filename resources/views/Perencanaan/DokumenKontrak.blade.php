@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Header Section -->
        <div class="col-12">
            <div class="box no-shadow mb-0 bg-transparent">
                <div class="box-header no-border px-0">
                    <h4 class="section-title">Perencanaan - Dokumen {{ ucfirst($jenis) }}</h4>
                </div>
            </div>
        </div>
        <hr />

        <!-- Dokumen Utama -->
        <div class="col-12">
            <button class="dashboard-btn">
                @if($jenis == 'pengadaan')
                    Dokumen Pengadaan Utama
                @else
                    Dokumen Kontrak Utama
                @endif
            </button>
        </div>

        <!-- Menampilkan Jenis Surat Options -->
        <div class="row">
            @foreach($jenisSuratOptions as $option)
                <div class="col-xl-4 col-md-6 col-12">
                    <a href="{{ $option['slug'] === 'hps' ? route('rab.indexkontrak') : route('perencanaan.list', [$jenis, $option['slug']]) }}">
                        <div class="box bg-white pull-up animate__animated animate__lightSpeedInLeft"
                             style="border-bottom: 5px solid #3AA4F2;">
                            <div class="box-body" style="display: flex; align-items: center;">
                                <!-- Tulisan, 60% -->
                                <div style="flex: 0 0 60%; padding-right: 15px;">
                                    <h6 class="mt-25 mb-5">{{ $option['nama'] }}</h6>
                                    <p class="text-fade mb-0 fs-12">{{ $option['deskripsi'] }}</p>
                                </div>

                                <!-- Gambar, 40% -->
                                <div style="flex: 0 0 40%; padding-left: 15px;">
                                    <img src="{{ asset('images/svg-icon/color-svg/' . $option['ikon']) }}" alt="Icon"
                                         style="width: 100%; height: 100px; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Dokumen Lainnya -->
        <div class="col-12">
            <button class="knowledge-btn">Dokumen {{ ucfirst($jenis) }} Lainnya</button>
        </div>

        <!-- Menampilkan Dokumen Lainnya Options -->
        <div class="row">
            @foreach($dokumenLainnyaOptions as $option)
                <div class="col-xl-4 col-md-6 col-12">
                    <a href="{{ route('perencanaan.list', [$jenis, $option['slug']]) }}">
                        <div class="box bg-white pull-up animate__animated animate__lightSpeedInLeft"
                             style="border-bottom: 5px solid #3AA4F2;">
                            <div class="box-body" style="display: flex; align-items: center;">
                                <!-- Tulisan, 60% -->
                                <div style="flex: 0 0 60%; padding-right: 15px;">
                                    <h6 class="mt-25 mb-5">{{ $option['nama'] }}</h6>
                                    <p class="text-fade mb-0 fs-12">{{ $option['deskripsi'] }}</p>
                                </div>

                                <!-- Gambar, 40% -->
                                <div style="flex: 0 0 40%; padding-left: 15px;">
                                    <img src="{{ asset('images/svg-icon/color-svg/' . $option['ikon']) }}" alt="Icon"
                                         style="width: 100%; height: 100px; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>


@endsection