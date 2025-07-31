@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <!-- Header Section -->
        <div class="col-12">
            <div class="box no-shadow mb-0 bg-transparent">
                <div class="box-header no-border px-0">
                    <h4 class="section-title">Dokumen Pengadaan - Perencanaan</h4>
                </div>
            </div>
        </div>
        <hr />

       @php
    $jenisPengadaan = [
        [
            "label" => "Pengadaan Langsung",
            "desc" => "Proses pengadaan cepat tanpa lelang untuk nilai kecil atau kebutuhan mendesak.",
            "img" => "Pipe9.svg",
            "slug" => "pengadaan_langsung",
        ],
        [
            "label" => "Penunjukan Langsung",
            "desc" => "Pemilihan langsung satu penyedia berdasarkan kriteria tertentu.",
            "img" => "Pipe10.svg",
            "slug" => "penunjukan_langsung",
        ],
        [
            "label" => "Tender",
            "desc" => "Pemilihan penyedia melalui pelelangan terbuka dengan evaluasi lengkap.",
            "img" => "Pipe11.svg",
            "slug" => "tender",
        ],
        [
            "label" => "Seleksi",
            "desc" => "Pengadaan jasa konsultansi melalui evaluasi teknis dan kualifikasi.",
            "img" => "Pipe12.svg",
            "slug" => "seleksi",
        ],
        [
            "label" => "Barang",
            "desc" => "Pengadaan dan pengelolaan kebutuhan barang secara terencana.",
            "img" => "Pipe13.svg",
            "slug" => "barang",
        ],
    ];
@endphp


        @foreach($jenisPengadaan as $index => $item)
            <div class="col-xl-4 col-md-6 col-12 mb-4">
                <a href="{{ route('dokumen.jenis', ['jenis' => $item['slug']]) }}">
                    <div class="box bg-white pull-up animate__animated {{ $index % 2 === 0 ? 'animate__lightSpeedInLeft' : 'animate__lightSpeedInRight' }}"
                         style="border-bottom: 5px solid #3AA4F2;">
                        <div class="box-body" style="display: flex; align-items: center;">
                            <!-- Tulisan, 60% -->
                            <div style="flex: 0 0 60%; padding-right: 15px;">
                                <h6 class="mt-25 mb-5">{{ $item['label'] }}</h6>
                                <p class="text-fade mb-0 fs-12">{{ $item['desc'] }}</p>
                            </div>

                            <!-- Gambar, 40% -->
                            <div style="flex: 0 0 40%; padding-left: 15px;">
                                <img src="{{ asset('images/svg-icon/color-svg/' . $item['img']) }}" alt="Icon"
                                     style="width: 100%; height: 100px; object-fit: cover;">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

    </div>
</div>

@endsection
