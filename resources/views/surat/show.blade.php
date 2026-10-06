@extends('layouts.app')

@section('title', $surat ? $surat['namaLatin'] : 'Surat')

@section('content')
    @if($error)
        <div class="alert">{{ $error }}</div>
        <p><a href="/surat">&larr; Kembali ke daftar surat</a></p>
    @else
        <p><a href="/surat">&larr; Daftar surat</a></p>

        <div class="card" style="text-align:center">
            <div class="arab">{{ $surat['nama'] }}</div>
            <h1 style="margin:0">{{ $surat['nomor'] }}. {{ $surat['namaLatin'] }}</h1>
            <div>{{ $surat['arti'] }} · {{ $surat['jumlahAyat'] }} ayat · {{ $surat['tempatTurun'] }}</div>
            <p style="text-align:left">{{ strip_tags($surat['deskripsi']) }}</p>
        </div>

        <div class="card">
            <label for="qari"><b>Pilih qari:</b></label>
            <select id="qari">
                <option value="01">Abdullah Al-Juhany</option>
                <option value="02">Abdul Muhsin Al-Qasim</option>
                <option value="03">Abdurrahman As-Sudais</option>
                <option value="04">Ibrahim Al-Dossari</option>
                <option value="05" selected>Misyari Rasyid Al-Afasy</option>
                <option value="06">Yasser Al-Dosari</option>
            </select>

            <p style="margin-bottom:4px"><b>Audio surat penuh:</b></p>
            <audio id="audio-full" controls style="width:100%" data-audio='@json($surat['audioFull'])'></audio>
        </div>

        @foreach($surat['ayat'] as $a)
            <div class="card">
                <p class="arab" dir="rtl" lang="ar">{{ $a['teksArab'] }} ﴿{{ $a['nomorAyat'] }}﴾</p>
                <p><em>{{ $a['teksLatin'] }}</em></p>
                <p>{{ $a['teksIndonesia'] }}</p>

                <audio class="audio-ayat" controls data-audio='@json($a['audio'])'></audio>

                @if($tafsir->has($a['nomorAyat']))
                    <details>
                        <summary>Tafsir</summary>
                        <p>{{ $tafsir[$a['nomorAyat']]['teks'] }}</p>
                    </details>
                @endif
            </div>
        @endforeach

        <p>
            @if(!empty($surat['suratSebelumnya']))
                <a href="/surat/{{ $surat['suratSebelumnya']['nomor'] }}">&larr; {{ $surat['suratSebelumnya']['namaLatin'] }}</a>
            @endif
            @if(!empty($surat['suratSelanjutnya']))
                <a style="float:right"
                    href="/surat/{{ $surat['suratSelanjutnya']['nomor'] }}">{{ $surat['suratSelanjutnya']['namaLatin'] }} &rarr;</a>
            @endif
        </p>

        <script>
            const qari = document.getElementById('qari');
            const players = document.querySelectorAll('audio');

            function setSumber() {
                players.forEach(p => {
                    const daftar = JSON.parse(p.dataset.audio);
                    p.pause();
                    p.src = daftar[qari.value] || '';
                });
            }

            // hanya satu audio yang boleh jalan
            players.forEach(p => p.addEventListener('play', () => {
                players.forEach(x => { if (x !== p) x.pause(); });
            }));

            qari.addEventListener('change', setSumber);
            setSumber();
        </script>
    @endif
@endsection