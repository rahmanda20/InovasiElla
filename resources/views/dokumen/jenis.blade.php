@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Header Section -->
        <div class="col-12">
            <div class="box no-shadow mb-0 bg-transparent">
                <div class="box-header no-border px-0">
                    <h4 class="section-title">
                        Perencanaan - Dokumen Kontrak ({{ strtoupper(str_replace('_', ' ', $jenis)) }})
                    </h4>
                </div>
            </div>
        </div>

        <hr />

        {{-- Rancangan Kontrak --}}
        @if(isset($suratOptions) && count($suratOptions) > 0)
        <div class="col-12">
            <button class="dashboard-btn">Rancangan Kontrak</button>
        </div>

        @foreach($suratOptions as $index => $option)
        <div class="col-xl-4 col-md-6 col-12 mb-4">
            <a href="{{ $option['slug'] === 'hps'
                ? route('rab.index', ['jenis_dokumen' => $jenis])
                : route('dokumen.list', ['jenis_dokumen' => $jenis, 'jenis_surat' => $option['slug']]) }}">
                <div class="box bg-white pull-up animate__animated {{ $index % 2 == 0 ? 'animate__lightSpeedInLeft' : 'animate__lightSpeedInRight' }}"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body d-flex align-items-center">
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">{{ $option['nama'] }}</h6>
                            <p class="text-fade mb-0 fs-12">{{ $option['deskripsi'] }}</p>
                        </div>
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="{{ asset('images/svg-icon/color-svg/' . $option['ikon']) }}"
                                 alt="Icon" style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
        @endif

        {{-- Dokumen Kontrak Lainnya --}}
        @if(isset($dokumenLainnyaOptions) && count($dokumenLainnyaOptions) > 0)
        <div class="col-12 mt-4">
            <button class="knowledge-btn">Dokumen Kontrak Lainnya</button>
        </div>

        @foreach($dokumenLainnyaOptions as $index => $option)
        <div class="col-xl-4 col-md-6 col-12 mb-4">
            <a href="{{ route('dokumen.list', ['jenis_dokumen' => $jenis, 'jenis_surat' => $option['slug']]) }}">
                <div class="box bg-white pull-up animate__animated {{ $index % 2 == 0 ? 'animate__lightSpeedInLeft' : 'animate__lightSpeedInRight' }}"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body d-flex align-items-center">
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mt-25 mb-5">{{ $option['nama'] }}</h6>
                            <p class="text-fade mb-0 fs-12">{{ $option['deskripsi'] }}</p>
                        </div>
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="{{ asset('images/svg-icon/color-svg/' . $option['ikon']) }}"
                                 alt="Icon" style="width: 100%; height: 100px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
        @endif
    </div>
</div>
@endsection
