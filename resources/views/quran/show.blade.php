@extends('layouts.app')

@section('content')
    <div class="mb-10 flex flex-col items-center">
        <h1 class="text-4xl font-arabic mb-2 text-emerald-700">{{ $surah['nama'] }}</h1>
        <h2 class="text-xl font-bold">{{ $surah['namaLatin'] }}</h2>
        <p class="text-gray-500 italic">{{ $surah['arti'] }} • {{ $surah['tempatTurun'] }}</p>

        <audio controls class="mt-6 h-10 w-full max-w-md">
            <source src="{{ $surah['audioFull']['05'] }}" type="audio/mpeg">
        </audio>
    </div>

    <div class="space-y-0">
        @foreach ($surah['ayat'] as $ayat)
            <div class="py-10 border-b border-gray-100">
                <div class="flex flex-row-reverse items-start gap-6">
                    <div
                        class="text-emerald-600 font-bold border border-emerald-100 rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">
                        {{ $ayat['nomorAyat'] }}
                    </div>
                    <div class="text-right leading-[3.5rem] text-4xl font-arabic text-slate-800 w-full">
                        {{ $ayat['teksArab'] }}
                    </div>
                </div>
                <div class="mt-6 text-slate-600 leading-relaxed max-w-3xl italic">
                    {{ $ayat['teksIndonesia'] }}
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-10 flex justify-between">
        <a href="/" class="text-emerald-600 font-semibold">&larr; Kembali ke Daftar</a>
    </div>
@endsection
