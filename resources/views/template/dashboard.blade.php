@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <!-- Header Section -->
        <div class="col-12">
            <div class="box no-shadow mb-0 bg-transparent">
                <div class="box-header no-border px-0">
                    <h4 class="section-title">Template Rancangan Kontrak</h4>
                </div>
            </div>
        </div>
        <hr />

        @php
            $firstSection = ['sppbj', 'spk', 'spmk', 'bapl', 'hps', 'time'];
            $secondSection = ['kak', 'sskk', 'ssuk', 'uraian'];
            $allCards = array_merge($firstSection, $secondSection);
        @endphp

        @foreach($allCards as $index => $key)
            @if(isset($cards[$key]))
                <div class="col-xl-4 col-md-6 col-12 mb-3">
                    <a href="{{ route('template.index', ['jenis' => $key]) }}">
                        <div class="box bg-white pull-up animate__animated {{ $index % 2 === 0 ? 'animate__lightSpeedInLeft' : 'animate__lightSpeedInRight' }}"
                             style="border-bottom: 4px solid #3AA4F2;">
                            <div class="box-body" style="display: flex; align-items: center; height: 140px;">
                                <!-- Teks Kiri -->
                                <div style="flex: 0 0 60%; padding-right: 10px;">
                                    <h6 class="mt-10 mb-2" style="font-size: 14px;">{{ $cards[$key]['label'] }}</h6>
                                    <p class="text-fade mb-0 fs-11">
                                        Template {{ strtolower($cards[$key]['label']) }}.
                                    </p>
                                </div>

                                <!-- Gambar Kanan -->
                                <div style="flex: 0 0 40%; padding-left: 10px;">
                                    <img src="{{ asset('images/svg-icon/color-svg/' . $cards[$key]['icon']) }}" alt="Icon"
                                         style="width: 100%; height: 75px; object-fit: contain;">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        @endforeach
    </div>
</div>

@endsection
