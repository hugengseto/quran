@extends('layouts.app')

@section('content')
    <div x-data="{
        open: false,
        search: '',
        // Data surah dikonversi ke JSON agar bisa dibaca Alpine.js
        listSurah: {{ json_encode($daftarSurah) }},
        get filteredSurah() {
            if (this.search === '') return this.listSurah;
            return this.listSurah.filter(s =>
                s.namaLatin.toLowerCase().includes(this.search.toLowerCase()) ||
                s.nomor.toString().includes(this.search)
            );
        }
    }" class="fixed bottom-6 left-6 z-50 md:top-24 md:bottom-auto md:left-auto md:right-6">

        <button @click="open = !open; if(open) $nextTick(() => $refs.searchInput.focus())"
            class="flex items-center gap-2.5 p-3 md:px-4 md:py-2.5 bg-white border border-emerald-100 rounded-full shadow-2xl hover:border-emerald-500 hover:scale-105 transition-all duration-300 group focus:outline-none">

            <div
                class="w-8 h-8 md:w-9 md:h-9 bg-emerald-600 text-white rounded-full flex items-center justify-center group-hover:rotate-180 transition-transform duration-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </div>
            <span class="hidden md:block font-extrabold text-slate-700 text-sm tracking-tight">Pindah Surah</span>
        </button>

        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-5 -translate-x-5"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0 translate-x-0"
            class="absolute bottom-16 left-0 md:left-auto md:right-0 md:top-16 md:bottom-auto w-72 max-h-[70vh] flex flex-col bg-white/95 backdrop-blur-sm border border-gray-100 rounded-3xl shadow-2xl overflow-hidden"
            style="display: none;">

            <div class="p-3 bg-white border-b border-gray-50">
                <div class="relative">
                    <input x-ref="searchInput" x-model="search" type="text" placeholder="Cari nomor atau nama surah..."
                        class="w-full pl-9 pr-4 py-2 bg-gray-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-emerald-500 transition-all outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-3 top-2.5 text-gray-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <div class="overflow-y-auto p-2 custom-scrollbar">
                <template x-for="s in filteredSurah" :key="s.nomor">
                    <a :href="'/surah/' + s.nomor"
                        class="flex items-center justify-between gap-3 p-3 rounded-2xl transition-all duration-300 hover:bg-emerald-50 group"
                        :class="s.nomor == {{ $surah['nomor'] }} ? 'bg-emerald-50 border border-emerald-100' : ''">

                        <div class="flex items-center gap-3">
                            <span class="text-[10px] font-mono opacity-40 w-5 text-center" x-text="s.nomor"></span>
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-slate-700 group-hover:text-emerald-700"
                                    x-text="s.namaLatin"></span>
                                <span class="text-[10px] text-gray-400" x-text="s.jumlahAyat + ' Ayat'"></span>
                            </div>
                        </div>
                        <span class="font-arabic text-lg text-emerald-600" x-text="s.nama"></span>
                    </a>
                </template>

                <div x-show="filteredSurah.length === 0" class="p-8 text-center">
                    <p class="text-xs text-gray-400 italic">Surah tidak ditemukan...</p>
                </div>
            </div>
        </div>
    </div>

    <div
        class="mb-10 flex flex-col items-center p-6 md:p-10 border-b border-gray-100 bg-white rounded-3xl shadow-sm transition-all">
        <a href="{{ route('quran.index') }}"
            class="self-start text-emerald-600 font-semibold mb-8 flex items-center gap-2 hover:text-emerald-700 transition group">
            <span class="group-hover:-translate-x-1 transition-transform">&larr;</span>
            <span class="text-sm">Daftar Surah</span>
        </a>

        <div class="flex flex-col md:flex-row items-center gap-4 md:gap-8 mb-4 text-center md:text-left w-full justify-center"
            x-data="{ showDeskripsi: false }">

            <h1 class="text-6xl md:text-7xl font-arabic text-emerald-700 leading-tight">
                {{ $surah['nama'] }}
            </h1>

            <div class="hidden md:block w-px h-16 bg-gray-200"></div>

            <div class="space-y-2 flex flex-col items-center md:items-start">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-800 tracking-tight">
                    {{ $surah['namaLatin'] }}
                </h2>
                <p class="text-gray-500 italic text-sm md:text-base">
                    {{ $surah['arti'] }} • {{ $surah['tempatTurun'] }} • {{ $surah['jumlahAyat'] }} Ayat
                </p>

                <button @click="showDeskripsi = true"
                    class="mt-2 flex items-center gap-2 px-4 py-1.5 bg-emerald-50 text-emerald-700 text-xs font-semibold rounded-full border border-emerald-100 hover:bg-emerald-100 transition-all shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Tentang Surah
                </button>
            </div>

            <template x-teleport="body">
                <div x-show="showDeskripsi"
                    class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
                    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

                    <div @click.away="showDeskripsi = false"
                        class="bg-white w-full max-w-2xl rounded-3xl shadow-2xl overflow-hidden"
                        x-transition:enter="transition ease-out duration-300 scale-95"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">

                        <div
                            class="p-6 border-b border-gray-100 flex justify-between items-center bg-emerald-600 text-white">
                            <h3 class="font-bold text-lg">Deskripsi Surah {{ $surah['namaLatin'] }}</h3>
                            <button @click="showDeskripsi = false"
                                class="hover:rotate-90 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="p-8 max-h-[70vh] overflow-y-auto leading-relaxed text-slate-700 prose prose-emerald">
                            {!! $surah['deskripsi'] !!}
                        </div>

                        <div class="p-4 bg-gray-50 text-right">
                            <button @click="showDeskripsi = false"
                                class="px-6 py-2 bg-white border border-gray-200 rounded-xl font-semibold text-slate-600 hover:bg-gray-100 transition">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <div class="mt-8 w-full max-w-lg bg-emerald-50 p-3 rounded-full border border-emerald-100 shadow-inner">
            <audio controls class="w-full h-10 custom-audio">
                <source src="{{ $surah['audioFull']['05'] }}" type="audio/mpeg">
                Browser Anda tidak mendukung elemen audio.
            </audio>
        </div>

        <div class="mt-6 w-full max-w-xs" x-data="{
            ayat: '',
            goToAyat() {
                if (!this.ayat) return;
                const target = document.getElementById('ayat-' + this.ayat);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                } else {
                    alert('Ayat tidak ditemukan');
                }
            }
        }">
            <div class="relative flex items-center">
                <input type="number" x-model.number="ayat" min="1" max="{{ $surah['jumlahAyat'] }}"
                    placeholder="Ke Ayat (1-{{ $surah['jumlahAyat'] }})"
                    class="w-full px-4 py-2 rounded-full border border-gray-200 outline-none text-sm focus:ring-2 focus:ring-emerald-500"
                    @keydown.enter="goToAyat()">

                <button type="button" @click="goToAyat()"
                    class="absolute right-1 bg-emerald-600 text-white p-1.5 rounded-full hover:bg-emerald-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-data="{ currentlyPlaying: null }" class="space-y-4 md:space-y-8 px-1 md:px-0">
        @foreach ($surah['ayat'] as $ayat)
            <div id="ayat-{{ $ayat['nomorAyat'] }}"
                class="scroll-mt-28 group relative p-5 md:p-8 border rounded-3xl transition-all duration-500 overflow-hidden"
                :class="currentlyPlaying === {{ $ayat['nomorAyat'] }} ?
                    'border-emerald-500 bg-emerald-50/30 shadow-[0_0_25px_-5px_rgba(16,185,129,0.2)] scale-[1.01]' :
                    'bg-white border-gray-100 shadow-sm hover:border-emerald-200 hover:shadow-md'">

                <div class="flex flex-col md:flex-row-reverse items-start gap-6 md:gap-10 z-10 relative">

                    <div class="w-full text-right font-arabic text-3xl md:text-4xl text-slate-900 
            bg-lined-paper leading-[3.8rem] md:leading-[4.8rem] py-4 px-2"
                        dir="rtl">
                        <bdi>{{ $ayat['teksArab'] }}</bdi>
                    </div>

                    <div class="w-full md:flex-grow flex items-start gap-4 md:gap-6">

                        <div class="flex flex-col items-center gap-4 flex-shrink-0">
                            <div class="w-10 h-10 md:w-12 md:h-12 border-2 rounded-full flex items-center justify-center font-bold text-xs md:text-sm transition-all duration-300 shadow-sm"
                                :class="currentlyPlaying === {{ $ayat['nomorAyat'] }} ?
                                    'bg-emerald-600 border-emerald-600 text-white rotate-[360deg]' :
                                    'bg-white border-emerald-100 text-emerald-700'">
                                {{ $ayat['nomorAyat'] }}
                            </div>

                            <button
                                @click="
                                const audio = $refs.audio{{ $ayat['nomorAyat'] }};
                                if (audio.paused) {
                                    // Matikan audio lain yang sedang berjalan
                                    document.querySelectorAll('audio').forEach(el => { el.pause(); el.currentTime = 0; });
                                    audio.play();
                                    currentlyPlaying = {{ $ayat['nomorAyat'] }};
                                } else {
                                    audio.pause();
                                    currentlyPlaying = null;
                                }
                            "
                                class="p-2.5 rounded-full transition-all duration-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                :class="currentlyPlaying === {{ $ayat['nomorAyat'] }} ?
                                    'bg-emerald-600 text-white animate-pulse' :
                                    'bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white'">

                                <template x-if="currentlyPlaying !== {{ $ayat['nomorAyat'] }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </template>
                                <template x-if="currentlyPlaying === {{ $ayat['nomorAyat'] }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </template>
                            </button>

                            <audio x-ref="audio{{ $ayat['nomorAyat'] }}" src="{{ $ayat['audio']['05'] }}"
                                class="hidden" @ended="currentlyPlaying = null"></audio>
                        </div>

                        <div class="flex-grow space-y-4 pt-1">
                            <div class="border-l-2 border-emerald-100 pl-4 space-y-3">
                                <p
                                    class="text-[13px] md:text-sm text-emerald-800 font-medium leading-relaxed italic tracking-wide">
                                    {{ $ayat['teksLatin'] }}
                                </p>
                                <p class="text-sm md:text-base text-slate-600 leading-relaxed">
                                    {{ $ayat['teksIndonesia'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="hidden md:block w-32 h-32 bg-emerald-50 rounded-full absolute -top-16 -left-16 opacity-0 group-hover:opacity-100 transition-opacity duration-700 blur-3xl z-0">
                </div>
            </div>
        @endforeach

        <div
            class="mt-12 mb-10 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-gray-100 pt-8">

            @if ($surah['suratSebelumnya'])
                <a href="{{ route('quran.show', $surah['suratSebelumnya']['nomor']) }}"
                    class="w-full sm:w-auto flex items-center gap-4 p-4 bg-white border border-gray-100 rounded-2xl hover:border-emerald-500 hover:shadow-md transition-all group">
                    <div
                        class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Sebelumnya</p>
                        <p class="text-slate-800 font-bold">{{ $surah['suratSebelumnya']['namaLatin'] }}</p>
                    </div>
                </a>
            @else
                <div class="hidden sm:block"></div>
            @endif

            <a href="{{ route('quran.index') }}"
                class="order-first sm:order-none p-3 bg-gray-50 text-gray-400 rounded-full hover:bg-gray-100 transition-colors"
                title="Kembali ke Daftar Surah">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </a>

            @if ($surah['suratSelanjutnya'])
                <a href="{{ route('quran.show', $surah['suratSelanjutnya']['nomor']) }}"
                    class="w-full sm:w-auto flex flex-row-reverse items-center gap-4 p-4 bg-white border border-gray-100 rounded-2xl hover:border-emerald-500 hover:shadow-md transition-all group">
                    <div
                        class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Selanjutnya</p>
                        <p class="text-slate-800 font-bold">{{ $surah['suratSelanjutnya']['namaLatin'] }}</p>
                    </div>
                </a>
            @else
                <div class="hidden sm:block"></div>
            @endif
        </div>
    </div>

    <div class="mt-12 py-6 border-t border-gray-100 flex justify-center">
        <a href="{{ route('quran.index') }}"
            class="px-6 py-3 bg-white border border-gray-200 text-emerald-700 font-semibold rounded-full hover:border-emerald-300 hover:bg-emerald-50 transition shadow-sm flex items-center gap-2">
            &larr; Kembali ke Daftar Surah
        </a>
    </div>

    <style>
        .custom-audio::-webkit-media-controls-panel {
            background-color: #ecfdf5;
            /* emerald-50 */
        }

        .custom-audio::-webkit-media-controls-play-button,
        .custom-audio::-webkit-media-controls-current-time-display,
        .custom-audio::-webkit-media-controls-time-remaining-display,
        .custom-audio::-webkit-media-controls-timeline,
        .custom-audio::-webkit-media-controls-volume-control-container {
            color: #047857;
            /* emerald-700 */
        }
    </style>
@endsection
