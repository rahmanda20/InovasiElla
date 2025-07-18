@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="box no-shadow bg-transparent">
                <div class="box-header px-0">
                    <h4 class="section-title">Perencanaan - Dokumen Pengadaan</h4>
                </div>
            </div>
        </div>
    </div>

    @php
        $jenisPengadaan = [
            [
                "label" => "(MDP) – Pengadaan langsung",
                "desc" => "Struktur organisasi perusahaan",
                "img" => "Pipe9.svg",
                "slug" => "pengadaan_langsung"
            ],
            [
                "label" => "(MDP) – Penunjukan langsung",
                "desc" => "Data pekerja",
                "img" => "Pipe10.svg",
                "slug" => "penunjukan_langsung"
            ],
            [
                "label" => "(MDP) – Tender",
                "desc" => "Status kontrak perusahaan",
                "img" => "Pipe11.svg",
                "slug" => "tender"
            ],
            [
                "label" => "(MDP) – Seleksi",
                "desc" => "Kalender acara penting",
                "img" => "Pipe12.svg",
                "slug" => "seleksi"
            ],
            [
                "label" => "(MDP) – Barang",
                "desc" => "Isu utama yang perlu perhatian",
                "img" => "Pipe13.svg",
                "slug" => "barang"
            ],
        
        ];
    @endphp

    <div class="row">
        @foreach($jenisPengadaan as $item)
        <div class="col-xl-4 col-md-6 col-12 mb-4">
            <a href="{{ route('dokumen.jenis', ['jenis' => $item['slug']]) }}">
                <div class="box bg-white shadow-sm h-100 pull-up animate__animated animate__fadeInUp"
                     style="border-bottom: 5px solid #3AA4F2;">
                    <div class="box-body d-flex align-items-center">
                        <div style="flex: 0 0 60%; padding-right: 15px;">
                            <h6 class="mb-1">{{ $item['label'] }}</h6>
                            <p class="text-fade fs-12 mb-0">{{ $item['desc'] }}</p>
                        </div>
                        <div style="flex: 0 0 40%; padding-left: 15px;">
                            <img src="{{ asset('images/svg-icon/color-svg/' . $item['img']) }}"
                                 alt="Icon" style="width: 100%; height: 80px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

@endsection
