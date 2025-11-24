@extends('layouts.user')

@section('title', $film->judul)

@section('background')
    <img src="{{ asset('storage/fotos/' . $film->foto) }}" alt="{{ $film->judul }}"
        class="w-full h-full object-cover opacity-40">
@endsection

@section('content')
    <div class="max-w-6xl">

        <div class="grid grid-cols-[auto_1fr_280px] gap-10 items-start">


            {{-- Poster --}}
            <div class="relative group w-[320px] h-[440px]">
                <img src="{{ asset('storage/fotos/' . $film->foto) }}"
                    class="w-full h-full object-cover rounded-2xl shadow-2xl border border-gray-700 group-hover:scale-105 transition duration-500"
                    alt="{{ $film->judul }}">
            </div>

            {{-- Info Film --}}
            <div class="text-gray-200 space-y-4">

                <h1 class="text-4xl font-extrabold text-white">{{ $film->judul }}</h1>

                <p class="text-gray-400 italic max-w-lg leading-relaxed">
                    {{ $film->deskripsi }}
                </p>


                {{-- Genre --}}
                <div class="flex flex-wrap gap-2 mt-3">
                    @foreach ($film->genres as $genre)
                        <span class="bg-blue-600/20 border border-blue-600/30 px-3 py-1 rounded-full text-sm">
                            {{ $genre->nama_genre }}
                        </span>
                    @endforeach
                </div>

                {{-- Tahun & Negara --}}
                <div class="flex items-center gap-6 text-sm text-gray-400 mt-2">
                    <span>📅 <strong>{{ $film->tahun }}</strong></span>
                    <span>🌍 {{ $film->negara->nama_negara }}</span>
                </div>

                {{-- Rating --}}
                <div class="flex gap-3 items-center">
                    @php
                        $averageRating = $film->averageRating();
                    @endphp

                    @for ($i = 1; $i <= 5; $i++)
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="{{ $i <= round($averageRating) ? '#fffe3b' : '#fff' }}"
                                d="m12 2l2.582 6.953L22 9.257l-5.822 4.602L18.18 21L12 16.891L5.82 21l2.002-7.141L2 9.257l7.418-.304z" />
                        </svg>
                    @endfor

                    <span class="text-yellow-400 text-xs ml-1 font-semibold">
                        ({{ number_format($averageRating, 1) }})
                    </span>
                </div>

                {{-- Trailer --}}
                <div x-data="{ trailerOpen: false }">
                    <button @click="trailerOpen = true"
                        class="inline-block bg-red-600 hover:bg-red-700 mt-6 px-6 py-3 rounded-full font-semibold text-white transition">
                        🎥 Lihat Trailer
                    </button>

                    <template x-if="trailerOpen">
                        <div class="fixed inset-0 bg-black/70 flex items-center justify-center z-50" x-transition>
                            <div
                                class="bg-[#1a1a1a] rounded-lg overflow-hidden w-[90%] md:w-[60%] lg:w-[50%] relative shadow-xl">
                                <button @click="trailerOpen = false"
                                    class="absolute top-2 right-2 text-gray-300 hover:text-white text-2xl font-bold">
                                    &times;
                                </button>
                                <div class="aspect-video">
                                    <iframe
                                        src="{{ str_replace('https://youtu.be/', 'https://www.youtube.com/embed/', $film->trailer) }}"
                                        frameborder="0" allowfullscreen class="w-full h-full rounded-b-lg">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

            </div>

            {{-- Rekomendasi Lainnya --}}
            <div
                class="space-y-5 h-[440px] overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-gray-900">

                <h2 class="text-lg font-semibold text-gray-100 tracking-wide">
                    Rekomendasi Lainnya
                </h2>

                <div class="space-y-5">
                    @foreach ($rekomendasi as $rec)
                        <a href="{{ route('film.detail', $rec->slug) }}" class="block group">

                            <div
                                class="w-full h-40 rounded-xl overflow-hidden border border-gray-700/50
                           shadow-md bg-gray-800/30 backdrop-blur-sm
                           transition duration-300 ease-out
                           group-hover:scale-[1.03] group-hover:shadow-lg group-hover:border-gray-500/50">
                                <img src="{{ asset('storage/fotos/' . $rec->foto) }}"
                                    class="w-full h-full object-cover transition duration-300 group-hover:brightness-110">
                            </div>

                            <p
                                class="mt-3 text-white text-sm font-semibold leading-tight group-hover:text-blue-300 transition">
                                {{ $rec->judul }}
                            </p>

                            <p class="text-xs text-gray-400">
                                {{ $rec->tahun }} • {{ $rec->genres->pluck('nama_genre')->join(', ') }}
                            </p>
                        </a>
                    @endforeach
                </div>

            </div>


        </div>



        {{-- SINOPSIS & SERIES SEJAJAR --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-10">

            {{-- SINOPSIS (kolom besar) --}}
            <div class="md:col-span-2">
                <h1 class="text-2xl font-semibold text-white mb-2">Sinopsis</h1>
                <p class="text-gray-300 leading-relaxed">{{ $film->sinopsis }}</p>
            </div>

            {{-- SERIES TERKAIT (kolom kanan) --}}
           @if ($series->count() > 1)
    <div
        class="space-y-5 h-[440px] overflow-y-auto pr-2
        scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-gray-900">

        <h2 class="text-lg font-semibold text-gray-100 tracking-wide">
            Series Lainnya
        </h2>

        <div class="space-y-5">
            @foreach ($series as $s)
                @if ($s->id !== $film->id)
                    <a href="{{ route('film.detail', $s->slug) }}" class="block group">

                        {{-- Card Poster (SAMAAAA seperti rekomendasi) --}}
                        <div
                            class="w-full h-40 rounded-xl overflow-hidden border border-gray-700/50
                            shadow-md bg-gray-800/30 backdrop-blur-sm
                            transition duration-300 ease-out
                            group-hover:scale-[1.03] group-hover:shadow-lg group-hover:border-gray-500/50">

                            <img src="{{ asset('storage/fotos/' . $s->foto) }}"
                                class="w-full h-full object-cover transition duration-300 group-hover:brightness-110">

                            {{-- Badge Tahun --}}
                            <span
                                class="absolute top-2 right-2 text-xs bg-black/40 backdrop-blur-md
                                px-2 py-1 rounded-full border border-white/10 text-white">
                                {{ $s->tahun }}
                            </span>
                        </div>

                        <p
                            class="mt-3 text-white text-sm font-semibold leading-tight
                            group-hover:text-purple-300 transition">
                            {{ $s->judul }}
                        </p>

                        <p class="text-xs text-gray-400">
                            {{ $s->genres->pluck('nama_genre')->join(', ') }}
                        </p>

                    </a>
                @endif
            @endforeach
        </div>

    </div>
@endif



        </div>



        {{-- Rating Dinamis --}}
        <div class="pt-5">
            <input type="hidden" id="filmId" value="{{ $film->id }}">
            <div class="flex gap-2">
                @for ($i = 1; $i <= 5; $i++)
                    <button class="stars" data-star="{{ $i }}">
                        <svg width="26" height="26">
                            <path fill="#fff"
                                d="m12 2l2.582 6.953L22 9.257l-5.822 4.602L18.18 21L12 16.891L5.82 21l2.002-7.141L2 9.257l7.418-.304z" />
                        </svg>
                    </button>
                @endfor
            </div>

            <span id="avg-rating">
                ({{ number_format($averageRating, 1) }})
            </span>
        </div>

        {{-- Form Komentar --}}
        <div class="mt-8">
            <form action="{{ route('komen.post') }}" method="POST">
                @csrf
                <input type="hidden" name="id_film" value="{{ $film->id }}">
                <textarea name="isi_komentar" rows="2"
                    class="focus:shadow-primary-outline text-sm block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-gray-700 outline-none transition-all focus:border-blue-500"
                    placeholder="Tambahkan Komentar..."></textarea>
                <div class="flex justify-end mt-3">
                    <button type="submit"
                        class="bg-red-500 rounded py-2 text-sm px-4 text-white hover:bg-red-600 transition">
                        Submit
                    </button>
                </div>
            </form>
        </div>

        {{-- List Komentar --}}
        @if ($komentars->isNotEmpty())
            <div class="mt-8">
                <h2 class="text-lg font-semibold text-white mb-3">
                    {{ $komentars->count() }} Komentar
                </h2>

                <div
                    class="mt-4 space-y-5 max-h-80 overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-gray-600 scrollbar-track-gray-800">

                    @foreach ($komentars as $komentar)
                        <div class="flex gap-3 pb-4 border-b border-gray-700">

                            {{-- Foto / Inisial --}}
                            <div
                                class="bg-gray-500 w-10 h-10 flex justify-center items-center rounded-full text-white font-semibold">
                                {{ Str::substr($komentar->user->name, 0, 1) }}
                            </div>

                            <div class="flex-1">

                                {{-- Nama + waktu + hapus --}}
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-semibold text-white">
                                        {{ $komentar->user->name }}
                                    </span>

                                    <div class="flex items-center gap-3">
                                        <span class="text-xs text-gray-400">
                                            {{ $komentar->created_at->diffForHumans() }}
                                        </span>

                                        {{-- Tombol Hapus (khusus pemilik komentar) --}}
                                        @if (auth()->check() && auth()->id() === $komentar->id_user)
                                            <form action="{{ route('komen.delete', $komentar->id) }}" method="POST"
                                                onsubmit="return confirm('Hapus komentar ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-500 text-xs hover:underline">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>

                                {{-- Isi komentar --}}
                                <p class="text-gray-300 mt-1 text-sm leading-relaxed">
                                    {{ $komentar->isi_komentar }}
                                </p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        @endif


    </div>

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection

@push('scripts')
  <script>
document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('.stars');
    const avgText = document.getElementById('avg-rating');

    const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
    const userRating = {{ $userRating ?? 'null' }}; // ⭐ rating user

    // ⬅⬅⬅ BAGIAN UNTUK MENYALAKAN BINTANG SAAT RELOAD
    if (userRating) {
        stars.forEach(s => {
            const val = s.dataset.star;
            s.querySelector('path').setAttribute(
                'fill',
                val <= userRating ? '#fffe3b' : '#fff'
            );
        });
    }
    // ⬅⬅⬅ SAMPAI SINI

    stars.forEach(btn => {
        btn.addEventListener('click', function() {
            const rating = this.dataset.star;

            if (!isLoggedIn) {
                window.location.href = "{{ route('login') }}";
                return;
            }

            // update tampilan bintang
            stars.forEach(s => {
                const val = s.dataset.star;
                s.querySelector('path').setAttribute(
                    'fill',
                    val <= rating ? '#fffe3b' : '#fff'
                );
            });

            // kirim rating ke backend
            fetch("{{ route('rating.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    id_film: {{ $film->id }},
                    nilai_rating: rating
                })
            })
            .then(res => res.json())
            .then(data => {
                avgText.innerText = `(${data.average.toFixed(1)})`;
            });
        });
    });
});
</script>


@endpush
