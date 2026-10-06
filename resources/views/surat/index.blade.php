@extends('layouts.app')

@section('content')
    <h1>Daftar Surat</h1>

    @if($error)
        <div class="alert">{{ $error }}</div>
    @else
        @foreach($surat as $s)
            <div class="card">
                <a href="/surat/{{ $s['nomor'] }}">
                    {{ $s['nomor'] }}. {{ $s['namaLatin'] }}
                </a>
                <span class="arab" style="float:right">{{ $s['nama'] }}</span>
                <div>{{ $s['arti'] }} · {{ $s['jumlahAyat'] }} ayat</div>
            </div>
        @endforeach
    @endif
@endsection