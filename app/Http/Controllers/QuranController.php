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

    public function show($nomor): View
    {
        // Mengambil detail surah berdasarkan nomor
        $response = Http::get("https://equran.id/api/v2/surat/{$nomor}");
        $surah = $response->json()['data'];

        return view('quran.show', compact('surah'));
    }
}
