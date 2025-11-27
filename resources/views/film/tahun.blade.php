@extends('layouts.user')

@section('content')
<div class="text-white">

    <h2 class="text-2xl font-bold mb-4">
        Film Tahun: <span class="text-blue-400">{{ $tahun }}</span>
    </h2>

    <section class="px-4 py-4 grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-3">
        @forelse ($films as $film)
            <div
                class="bg-[#1a1a1a] rounded-lg overflow-hidden shadow-md hover:scale-105 transition-transform duration-300 relative w-full">

                {{-- FOTO --}}
                <div class="relative">
                    <img src="{{ asset('storage/fotos/' . $film->foto) }}"
                         alt="{{ $film->judul }}"
                         class="w-full h-44 object-cover">
                </div>

                {{-- TEKS --}}
                <div class="p-2">
                    <h3 class="text-xs text-white font-semibold mb-1 leading-tight">
                        {{ Str::limit($film->judul, 25) }}
                    </h3>

                    <p class="text-gray-400 text-[10px] mb-2">
                        {{ Str::limit($film->deskripsi, 45) }}
                    </p>

                    <a href="{{ route('film.detail', $film->slug) }}"
                       class="bg-blue-400 text-black font-semibold px-2 py-1 rounded text-[11px]
                              hover:bg-blue-500 transition-colors w-full block text-center">
                        Detail
                    </a>
                </div>

            </div>
        @empty
            <p class="text-gray-400 text-center col-span-full">
                Tidak ada film pada tahun {{ $tahun }}.
            </p>
        @endforelse
    </section>

    <div class="mt-4">
        {{ $films->links() }}
    </div>

</div>
@endsection
