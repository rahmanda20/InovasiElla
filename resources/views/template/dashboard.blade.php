@extends('layouts.app')
@section('content')

<style>
    .section-title-box {
        background-color: #003d99;
        color: white;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 25px;
        text-align: center;
        font-size: 20px;
        font-weight: bold;
    }

    .section-subtitle-box {
        background-color: #e53935;
        color: white;
        padding: 10px;
        border-radius: 10px;
        margin-top: 40px;
        margin-bottom: 25px;
        text-align: center;
        font-size: 18px;
        font-weight: bold;
    }

    .template-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.07);
        border-bottom: 4px solid #3AA4F2;
        padding: 20px;
        transition: 0.3s ease;
        height: 100%;
    }

    .template-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .template-card-body {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 100%;
    }

    .template-card-text h6 {
        font-size: 16px;
        font-weight: bold;
        color: #003d99;
        margin-bottom: 5px;
    }

    .template-card-text p {
        font-size: 13px;
        color: #888;
        margin-bottom: 0;
    }

    .template-card-img {
        width: 80px;
        height: 80px;
        object-fit: contain;
        flex-shrink: 0;
    }

    .card-link {
        text-decoration: none;
        color: inherit;
    }

    @media (max-width: 767px) {
        .template-card-body {
            flex-direction: column;
            text-align: center;
        }

        .template-card-text {
            margin-bottom: 10px;
        }
    }
</style>

<div class="container py-5"> {{-- padding atas bawah --}}
    <div class="section-title-box">Templete Rancangan Kontrak</div>

    <div class="row g-4"> {{-- Gutter antar kolom --}}
        @php
            $firstSection = ['sppbj', 'spk', 'spmk', 'bapl', 'hps', 'time'];
            $secondSection = ['kak', 'sskk', 'ssuk', 'uraian'];
        @endphp

        @foreach($firstSection as $key)
            @if(isset($cards[$key]))
                <div class="col-xl-4 col-md-6">
                    <a href="{{ route('template.index', ['jenis' => $key]) }}" class="card-link">
                        <div class="template-card">
                            <div class="template-card-body">
                                <div class="template-card-text">
                                    <h6>{{ $cards[$key]['label'] }}</h6>
                                    <p>Informasi terkait dokumen {{ $cards[$key]['label'] }}.</p>
                                </div>
                                <img src="{{ asset('images/svg-icon/color-svg/' . $cards[$key]['icon']) }}" 
                                     alt="Icon" class="template-card-img">
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        @endforeach
    </div>

    <div class="section-subtitle-box">Template Dokumen Kontrak Lainnya</div>

    <div class="row g-4">
        @foreach($secondSection as $key)
            @if(isset($cards[$key]))
                <div class="col-xl-4 col-md-6">
                    <a href="{{ route('template.index', ['jenis' => $key]) }}" class="card-link">
                        <div class="template-card">
                            <div class="template-card-body">
                                <div class="template-card-text">
                                    <h6>{{ $cards[$key]['label'] }}</h6>
                                    <p>Informasi terkait dokumen {{ $cards[$key]['label'] }}.</p>
                                </div>
                                <img src="{{ asset('images/svg-icon/color-svg/' . $cards[$key]['icon']) }}" 
                                     alt="Icon" class="template-card-img">
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        @endforeach
    </div>
</div>

@endsection
