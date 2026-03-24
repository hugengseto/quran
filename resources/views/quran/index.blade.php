<div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
    @foreach ($surahs as $item)
        <a href="{{ route('quran.show', $item['nomor']) }}"
            class="block p-4 bg-white border rounded-xl hover:shadow-lg transition">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="font-bold">{{ $item['nomor'] }}. {{ $item['namaLatin'] }}</h2>
                    <p class="text-sm text-gray-500">{{ $item['arti'] }}</p>
                </div>
                <span class="text-2xl font-serif">{{ $item['nama'] }}</span>
            </div>
        </a>
    @endforeach
</div>
