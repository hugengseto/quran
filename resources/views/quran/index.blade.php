@extends('layouts.app')

@section('content')
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold mb-2">Daftar Surah</h1>
        <p class="text-gray-600">Pilih surah untuk mulai membaca</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($surahs as $item)
            <a href="{{ route('quran.show', $item['nomor']) }}"
                class="group p-5 bg-white border border-gray-100 rounded-2xl shadow-sm hover:border-emerald-300 hover:shadow-md transition-all duration-300 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div
                        class="w-10 h-10 bg-emerald-50 text-emerald-700 rounded-lg flex items-center justify-center font-bold group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        {{ $item['nomor'] }}
                    </div>
                    <div>
                        <h2 class="font-bold text-slate-800">{{ $item['namaLatin'] }}</h2>
                        <p class="text-xs text-gray-500 uppercase tracking-wider">{{ $item['arti'] }} •
                            {{ $item['jumlahAyat'] }} Ayat</p>
                    </div>
                </div>
                <div class="text-2xl font-arabic text-emerald-600">
                    {{ $item['nama'] }}
                </div>
            </a>
        @endforeach
    </div>
@endsection
