@extends('layouts.user')

@section('content')
<div class="text-white">

    <h2 class="text-2xl font-bold mb-4">
        Film dengan Genre: <span class="text-blue-400">{{ $genre->nama_genre }}</span>
    </h2>

    <section class="px-4 py-4 grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-3">
        @forelse ($films as $item)
            <div
                class="bg-[#1a1a1a] rounded-lg overflow-hidden shadow-md hover:scale-105 transition-transform duration-300 relative w-full">

                {{-- FOTO + RATING --}}
                <div class="relative">
                    <img src="{{ asset('storage/fotos/' . $item->foto) }}"
                         alt="{{ $item->judul }}"
                         class="w-full h-44 object-cover">

                    {{-- ⭐ Rating (Dummy Rating 4.5) --}}
                    @php
                        $rating = 4.5;
                        $fullStars = floor($rating);
                        $halfStar = $rating - $fullStars >= 0.5;
                    @endphp

                    <div
                        class="absolute bottom-1 left-1 bg-black/60 px-2 py-1 rounded-md flex items-center space-x-1 backdrop-blur-sm">

                        {{-- Bintang penuh --}}
                        @for ($i = 0; $i < $fullStars; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#facc15"
                                 viewBox="0 0 24 24" stroke-width="1.5" stroke="#facc15"
                                 class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M11.48 3.5l2.31 4.68 5.18.75-3.75 3.65.89 5.19L11.5 15.9l-4.61 2.42.88-5.19-3.75-3.65 5.19-.75 2.27-4.63z" />
                            </svg>
                        @endfor

                        {{-- Bintang setengah --}}
                        @if ($halfStar)
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                 fill="url(#half)" stroke="#facc15" stroke-width="1.5"
                                 class="w-4 h-4">
                                <defs>
                                    <linearGradient id="half">
                                        <stop offset="50%" stop-color="#facc15" />
                                        <stop offset="50%" stop-color="transparent" />
                                    </linearGradient>
                                </defs>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M11.48 3.5l2.31 4.68 5.18.75-3.75 3.65.89 5.19L11.5 15.9l-4.61 2.42.88-5.19-3.75-3.65 5.19-.75 2.27-4.63z" />
                            </svg>
                        @endif

                        <span class="text-yellow-400 text-xs ml-1 font-semibold">
                            ({{ number_format($rating, 1) }})
                        </span>
                    </div>
                </div>

                {{-- TEKS --}}
                <div class="p-2">
                    <h3 class="text-xs text-white font-semibold mb-1 leading-tight">
                        {{ Str::limit($item->judul, 25) }}
                    </h3>

                    <p class="text-gray-400 text-[10px] mb-2 leading-snug">
                        {{ Str::limit($item->deskripsi, 45) }}
                    </p>

                    <a href="{{ route('film.detail', $item->slug) }}"
                       class="bg-blue-400 text-black font-semibold px-2 py-1 rounded text-[11px]
                              hover:bg-blue-500 transition-colors w-full block text-center">
                        Detail
                    </a>
                </div>

            </div>
        @empty
            <p class="text-gray-400 text-center col-span-full">
                Belum ada film untuk genre ini.
            </p>
        @endforelse
    </section>

    <div class="mt-4">
        {{ $films->links() }}
    </div>

</div>
@endsection
