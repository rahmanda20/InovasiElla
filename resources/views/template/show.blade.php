@extends('layouts.app')
@section('content')
<div class="container">
    <h4>Preview Template: {{ $template->original_name }}</h4>
    <iframe src="{{ asset($url) }}" style="width: 100%; height: 600px;" frameborder="0"></iframe>
    <a href="{{ route('template.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
