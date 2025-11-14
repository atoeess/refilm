@extends('layouts.main')

@section('title', 'Hasil Pencarian - ReFilm')

@section('content')
    <div class="container mx-auto px-6 py-0 text-gray-800">

        {{-- 🔹 Tombol Kembali ke Home (pojok kiri atas) --}}
        <div class="mb-6">
            <a href="{{ route('home') }}"
                class="inline-flex items-center gap-2 text-gray-600 hover:text-blue-600 font-medium transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" class="w-5 h-5">
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
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
                @foreach ($films as $film)
                    <div
                        class="bg-gray-800 rounded-lg overflow-hidden shadow-md hover:scale-105 transition-transform duration-300 relative">
                        {{-- Thumbnail --}}
                        <img src="{{ asset('storage/fotos/' . $film->foto) }}" alt="{{ $film->judul }}"
                            class="w-full h-40 object-cover">

                        {{-- Info --}}
                        <div class="p-3">
                            <h3 class="text-sm text-white font-semibold mb-1 leading-tight truncate">
                                {{ Str::limit($film->judul, 25) }}
                            </h3>
                            <p class="text-gray-400 text-xs mb-2 leading-snug">
                                {{ Str::limit($film->deskripsi, 50) }}
                            </p>

                            <div class="flex items-center justify-between text-[11px] text-gray-400">
                                <span class="italic">{{ $film->negara->nama_negara ?? '-' }}</span>
                            </div>

                            <a href="{{ route('film.show', $film->slug) }}"
                                class="mt-2 bg-blue-300 text-black font-semibold px-2 py-1 rounded text-xs hover:bg-blue-400 transition-colors w-full block text-center">
                                🎬 Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
