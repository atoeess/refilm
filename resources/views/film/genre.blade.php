@extends('layouts.user')

@section('content')

<div class="text-white px-2">

    <!-- HEADER -->
    <h2 class="text-2xl font-bold mb-4">
        Film dengan Genre:
        <span class="text-blue-400">{{ $genre->nama_genre }}</span>
    </h2>

    <!-- GRID -->
    <section class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">

        @forelse ($films as $item)
            <div class="bg-[#151515] rounded-xl overflow-hidden shadow-lg
                        hover:scale-[1.04] hover:shadow-xl transition-all duration-300">

                {{-- FOTO + RATING --}}
                <div class="relative">
                    <img src="{{ asset('storage/fotos/' . $item->foto) }}"
                         alt="{{ $item->judul }}"
                         class="w-full h-48 object-cover bg-black">

                    {{-- RATING BADGE --}}
                    @php
                        $rating = 4.5; // dummy
                        $fullStars = floor($rating);
                        $halfStar = $rating - $fullStars >= 0.5;
                    @endphp

                    <div class="absolute bottom-2 left-2 bg-black/60 backdrop-blur-sm
                                px-2 py-1 rounded-md shadow flex items-center gap-1">

                        {{-- full stars --}}
                        @for ($i = 0; $i < $fullStars; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#facc15"
                                 viewBox="0 0 24 24" stroke="#facc15" stroke-width="1"
                                 class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M11.48 3.5l2.31 4.68 5.18.75-3.75 3.65.89 5.19L11.5 15.9l-4.61 2.42.88-5.19-3.75-3.65 5.19-.75 2.27-4.63z" />
                            </svg>
                        @endfor

                        {{-- half star --}}
                        @if ($halfStar)
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                 fill="url(#half)" stroke="#facc15" stroke-width="1"
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

                        <span class="text-yellow-400 text-xs font-semibold">
                            {{ number_format($rating, 1) }}
                        </span>
                    </div>
                </div>

                {{-- TEKS --}}
                <div class="p-3">
                    <h3 class="text-sm font-semibold text-white mb-1 leading-tight">
                        {{ Str::limit($item->judul, 25) }}
                    </h3>

                    <p class="text-gray-400 text-xs mb-3">
                        {{ Str::limit($item->deskripsi, 45) }}
                    </p>

                    <a href="{{ route('film.detail', $item->slug) }}"
                       class="block text-center bg-blue-500 hover:bg-blue-600
                              text-black font-semibold rounded-md py-1.5 text-xs transition">
                        Detail
                    </a>
                </div>

            </div>

        @empty
            <p class="text-gray-400 text-center col-span-full py-6">
                Belum ada film untuk genre ini.
            </p>
        @endforelse

    </section>

    <!-- PAGINATION -->
    <div class="mt-6">
        {{ $films->links() }}
    </div>

</div>

@endsection
