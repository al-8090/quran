<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class SuratController extends Controller
{
    public function index()
    {
        $res = Http::timeout(10)->get(config('services.equran.url') . '/api/v2/surat');

        if ($res->failed()) {
            return view('surat.index', ['surat' => [], 'error' => 'Gagal memuat data surat.']);
        }

        return view('surat.index', ['surat' => $res->json('data'), 'error' => null]);
    }

    public function show($nomor)
    {
        $base = config('services.equran.url');

        $res = Http::timeout(10)->get("$base/api/v2/surat/$nomor");

        if ($res->status() === 404 || ($res->successful() && !$res->json('data'))) {
            return view('surat.show', ['surat' => null, 'tafsir' => collect(), 'error' => 'Surat tidak ditemukan.']);
        }

        if ($res->failed()) {
            return view('surat.show', ['surat' => null, 'tafsir' => collect(), 'error' => 'Request gagal, coba lagi nanti.']);
        }

        // tafsir opsional: kalau gagal, halaman tetap tampil
        $tafsirRes = Http::timeout(10)->get("$base/api/v2/tafsir/$nomor");
        $tafsir = $tafsirRes->successful()
            ? collect($tafsirRes->json('data.tafsir'))->keyBy('ayat')
            : collect();

        return view('surat.show', [
            'surat' => $res->json('data'),
            'tafsir' => $tafsir,
            'error' => null,
        ]);
    }
}