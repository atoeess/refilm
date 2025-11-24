@extends('layouts.main')

@section('title', 'Hasil Pencarian - ReFilm')

@section('content')
    <div class="container mx-auto px-6 py-0 text-gray-800">

        {{-- 🔹 Tombol Kembali ke Home (pojok kiri atas) --}}
        <div class="mb-6">
            <a href="{{ route('home') }}"
                class="inline-flex items-center gap-2 text-gray-600 hover:text-blue-600 font-medium transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                    class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Beranda
            </a>
        </div>

        {{-- 🔹 Header --}}
        <div class="text-center mb-10">
            <p class="text-4xl font-bold text-blue-600 mb-1">
                Hasil Pencarian
            </p>
            <p class="text-gray-600 text-base">
                Menampilkan hasil untuk:
                <span class="font-semibold text-blue-500">"{{ $query }}"</span>
            </p>
            <div class="mt-4 w-24 h-1 bg-blue-400 mx-auto rounded-full"></div>
        </div>

        {{-- 🔹 Tidak ada hasil --}}
        @if ($films->isEmpty())
            <div class="text-center py-20">
                <p class="text-gray-500 text-lg">
                    😢 Tidak ada film yang cocok dengan kata kunci <span class="font-semibold">"{{ $query }}"</span>.
                </p>
                <a href="{{ route('film.index') }}"
                    class="mt-6 inline-block bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-full transition">
                    🔍 Kembali ke Daftar Film
                </a>
            </div>
        @else
            {{-- 🔹 Grid hasil pencarian --}}

            <section x-data="{ items: @js($films) }"
                class="px-4 py-4 grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-3">

                <template x-for="item in items" :key="item.id">

                    <div class="bg-[#1a1a1a] rounded-lg overflow-hidden shadow-md hover:scale-105 transition w-full">
                        <div class="relative">
                            <img :src="'/storage/fotos/' + item.foto" class="w-full h-44 object-cover">

                            <!-- Rating -->
                            <div
                                class="absolute bottom-1 left-1 bg-black/60 px-2 py-1 rounded-md flex items-center space-x-1 backdrop-blur-sm">

                                <template x-for="i in Math.floor(Number(item.ratings_avg_nilai_rating) || 0)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill='#facc15' viewBox='0 0 24 24'
                                        stroke-width='1.5' stroke='#facc15' class='w-4 h-4'>
                                        <path stroke-linecap='round' stroke-linejoin='round'
                                            d='M11.48 3.5l2.31 4.68 5.18.75-3.75 3.65.89 5.19L11.5 15.9l-4.61 2.42.88-5.19-3.75-3.65 5.19-.75 2.27-4.63z' />
                                    </svg>
                                </template>

                                <template
                                    x-if="(Number(item.ratings_avg_nilai_rating) || 0) - Math.floor(Number(item.ratings_avg_nilai_rating) || 0) >= 0.5">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox='0 0 24 24' fill='url(#half)'
                                        stroke='#facc15' stroke-width='1.5' class='w-4 h-4'>
                                        <defs>
                                            <linearGradient id='half'>
                                                <stop offset='50%' stop-color='#facc15'></stop>
                                                <stop offset='50%' stop-color='transparent'></stop>
                                            </linearGradient>
                                        </defs>
                                        <path stroke-linecap='round' stroke-linejoin='round'
                                            d='M11.48 3.5l2.31 4.68 5.18.75-3.75 3.65.89 5.19L11.5 15.9l-4.61 2.42.88-5.19-3.75-3.65 5.19-.75 2.27-4.63z' />
                                    </svg>
                                </template>

                                <span class="text-yellow-400 text-xs ml-1 font-semibold"
                                    x-text="'(' + (Number(item.ratings_avg_nilai_rating) || 0).toFixed(1) + ')'">
                                </span>

                            </div>
                        </div>

                        <div class="p-2">
                            <h3 class="text-xs text-white font-semibold mb-1 leading-tight" x-text="item.judul"></h3>
                            <p class="text-gray-400 text-[10px] mb-2" x-text="item.deskripsi.substring(0,45) + '...'"></p>
                            <a :href="'/film/' + item.slug"
                                class="bg-blue-400 text-black font-semibold px-2 py-1 rounded text-[11px] block text-center">
                                Detail
                            </a>
                        </div>
                    </div>

                </template>

            </section>
        @endif
    </div>
@endsection
