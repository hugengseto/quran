<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class QuranController extends Controller
{
    public function index(): View
    {
        // Mengambil data daftar surah dari API equran.id
        $response = Http::get('https://equran.id/api/v2/surat');
        $surahs = $response->json()['data'];

        return view('quran.index', compact('surahs'));
    }

    public function show($nomor)
    {
        // Ambil detail surah aktif
        $response = Http::get("https://equran.id/api/v2/surat/{$nomor}");
        $surah = $response->json()['data'];

        // Ambil daftar semua surah untuk dropdown
        $allSurahResponse = Http::get("https://equran.id/api/v2/surat");
        $daftarSurah = $allSurahResponse->json()['data'];

        $surah['suratSebelumnya'] = $surah['suratSebelumnya'] ?? false;
        $surah['suratSelanjutnya'] = $surah['suratSelanjutnya'] ?? false;

        return view('quran.show', compact('surah', 'daftarSurah'));
    }
}
