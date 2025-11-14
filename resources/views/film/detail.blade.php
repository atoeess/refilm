@extends('layouts.user')

@section('title', $film->judul)

@section('background')
    <img src="{{ asset('storage/fotos/' . $film->foto) }}" alt="{{ $film->judul }}"
        class="w-full h-full object-cover opacity-40">
@endsection

@section('content')
    <div class="max-w-6xl">

        <div class="mx-auto grid md:grid-cols-2 gap-10 items-start">

            {{-- Poster Film --}}
            <div class="relative group">
                <img src="{{ asset('storage/fotos/' . $film->foto) }}"
                    class="rounded-2xl shadow-2xl border border-gray-700 group-hover:scale-105 transition duration-500"
                    alt="{{ $film->judul }}">
            </div>

            {{-- Info Film --}}
            <div class="text-gray-200 space-y-4">

                <h1 class="text-4xl font-extrabold text-white">{{ $film->judul }}</h1>

                <p class="text-gray-400 italic">{{ $film->deskripsi }}</p>

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

                {{-- Rating Static (atas) --}}
                <div class="flex gap-3 items-center">
                    @for ($i = 0; $i < 5; $i++)
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path fill="#fffe3b"
                                d="m12 2l2.582 6.953L22 9.257l-5.822 4.602L18.18 21L12 16.891L5.82 21l2.002-7.141L2 9.257l7.418-.304z" />
                        </svg>
                    @endfor
                    <span>(4.5)</span>
                </div>

                {{-- Popup Trailer --}}
                <div x-data="{ trailerOpen: false }">

                    {{-- Tombol --}}
                    <button @click="trailerOpen = true"
                        class="inline-block bg-red-600 hover:bg-red-700 mt-6 px-6 py-3 rounded-full font-semibold text-white transition">
                        🎥 Lihat Trailer
                    </button>

                    {{-- Popup --}}
                    <template x-if="trailerOpen">
                        <div class="fixed inset-0 bg-black/70 flex items-center justify-center z-50" x-transition>

                            <div class="bg-[#1a1a1a] rounded-lg overflow-hidden w-[90%] md:w-[60%] lg:w-[50%] relative shadow-xl">

                                <button @click="trailerOpen = false"
                                    class="absolute top-2 right-2 text-gray-300 hover:text-white text-2xl font-bold">
                                    &times;
                                </button>

                                <div class="aspect-video">
                                    <iframe
                                        src="{{ str_replace('https://youtu.be/', 'https://www.youtube.com/embed//', $film->trailer) }}"
                                        frameborder="0" allowfullscreen class="w-full h-full rounded-b-lg">
                                    </iframe>
                                </div>

                            </div>

                        </div>
                    </template>

                </div>

            </div>

        </div>

        {{-- Sinopsis --}}
        <div class="pt-5">
            <h1 class="text-2xl font-semibold text-white mb-2">Sinopsis</h1>
            <p class="text-gray-300 leading-relaxed">{{ $film->sinopsis }}</p>
        </div>

        {{-- Rating Dinamis --}}
        <div class="pt-5">
            <input type="hidden" id="filmId" value="{{ $film->id }}">

            <div class="flex gap-3 items-center mb-3">
                @for ($i = 0; $i < 5; $i++)
                    <button class="stars" type="button" data-id="{{ $i + 1 }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path fill="#fff"
                                d="m12 6.308l1.176 3.167l.347.936l.997.041l3.374.139l-2.647 2.092l-.784.62l.27.962l.911 3.249l-2.814-1.871l-.83-.553l-.83.552l-2.814 1.871l.911-3.249l.27-.962l-.784-.62l-2.648-2.092l3.374-.139l.997-.41zM12 2L9.418 8.953L2 9.257l5.822 4.602L5.82 21L12 16.891L18.18 21l-2.002-7.141L22 9.257l-7.418-.305z" />
                        </svg>
                    </button>
                @endfor

                <span class="text-gray-300 ml-2">
                    ({{ number_format($film->averageRating(), 1) }})
                </span>
            </div>

            {{-- Komentar Form --}}
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

                                <div
                                    class="bg-gray-500 w-10 h-10 flex justify-center items-center rounded-full text-white font-semibold">
                                    {{ Str::substr($komentar->user->name, 0, 1) }}
                                </div>

                                <div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-semibold text-white">
                                            {{ $komentar->user->name }}
                                        </span>

                                        <span class="text-xs text-gray-400">
                                            {{ $komentar->created_at->diffForHumans() }}
                                        </span>
                                    </div>

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

    </div>

    {{-- Alpine.js --}}
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const starsButtons = document.querySelectorAll('.stars');

            starsButtons.forEach((el) => {
                el.addEventListener('click', () => {

                    const index = parseInt(el.dataset.id) - 1;
                    let allActive = true;

                    for (let i = 0; i <= index; i++) {
                        if (starsButtons[i].dataset.active !== "true") {
                            allActive = false;
                            break;
                        }
                    }

                    if (allActive) {
                        for (let i = 0; i <= index; i++) {
                            starsButtons[i].dataset.active = "false";
                            starsButtons[i].querySelector('svg path').setAttribute('fill', '#fff');
                        }
                    } else {
                        starsButtons.forEach(s => {
                            s.dataset.active = "false";
                            s.querySelector('svg path').setAttribute('fill', '#fff');
                        });

                        for (let i = 0; i <= index; i++) {
                            starsButtons[i].dataset.active = "true";
                            starsButtons[i].querySelector('svg path').setAttribute('fill', '#fffe3b');
                        }
                    }

                });
            });
        });
    </script>
@endpush
