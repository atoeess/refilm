<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReFilm</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

</head>

<body class="bg-[#ECECEC] text-whitw font-sans">


    <!-- Navbar -->
    <nav class="flex items-center justify-between px-8 py-4 bg-[#ECECEC] border-b border-blue-300">
        <div class="flex items-center space-x-8">
            <h1 class="text-3xl font-bold text-blue-600">ReFilm</h1>
        </div>

        <!-- Search Bar -->
        <div class="relative flex-1 mx-12">
            <input type="text" id="searchInput" placeholder="Cari film..."
                class="w-full px-4 py-2 rounded bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-300">

            <!-- hasil pencarian -->
            <div id="searchResults"
                class="absolute left-0 w-full mt-2 bg-white rounded shadow-lg text-black z-50 hidden max-h-64 overflow-y-auto">
            </div>
        </div>



        <div class="flex space-x-3">
            <!-- Dropdown Genre (klik untuk buka/tutup) -->
            <div x-data="{ open: false }" class="relative">
                <!-- Tombol -->
                <button @click="open = !open"
                    class="bg-blue-300 px-3 py-1 rounded text-sm text-white font-semibold flex items-center space-x-1 focus:outline-none">
                    <span>Genre</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform transition-transform duration-200"
                        :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" @click.away="open = false" x-transition
                    class="absolute bg-gray-900 border border-blue-300 rounded-lg mt-2 w-40 shadow-lg z-50">
                    @foreach ($genres as $genre)
                        <a href="{{ route('genre.film', $genre->id) }}"
                            class="block px-4 py-2 text-sm text-white hover:bg-blue-300 hover:text-black transition-colors">
                            {{ $genre->nama_genre }}
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Dropdown Negara --}}
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open"
                    class="bg-blue-300 px-3 py-1 rounded text-sm text-white font-semibold flex items-center space-x-1 focus:outline-none">
                    <span>Negara</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform transition-transform duration-200"
                        :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="open" @click.away="open = false" x-transition
                    class="absolute bg-gray-900 border border-blue-300 rounded-lg mt-2 w-40 shadow-lg z-50">
                    @foreach ($negaras as $negara)
                        <a href="{{ route('negara.film', $negara->id) }}"
                            class="block px-4 py-2 text-sm text-white hover:bg-blue-300 hover:text-black transition-colors">
                            {{ $negara->nama_negara }}
                        </a>
                    @endforeach
                </div>
            </div>
            <button class="bg-blue-300 px-3 py-1 rounded text-sm text-white font-semibold">Sign In</button>
        </div>
    </nav>

    {{-- ===== HERO SECTION (Highlight) ===== --}}
    @if ($highlights->count() > 0)
        @php
            $highlight = $highlights->first();
        @endphp

        <section class="relative h-[90vh] flex items-end bg-cover bg-center text-white"
            style="background-image: url('{{ asset('storage/' . $highlight->thumbnail) }}')">

            {{-- Overlay gelap --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-transparent"></div>

            <div class="relative z-10 p-10 md:p-16">
                <p class="inline-block text-white font-semibold px-6 py-2 bg-blue-400/60 shadow-md backdrop-blur-sm"
                    style="
        border-top-left-radius: 16px;
        border-bottom-right-radius: 16px;
        clip-path: polygon(6% 0, 100% 0, 100% 94%, 94% 100%, 0 100%, 0 6%);
        transition: all 0.3s ease;
    ">
                    {{ $highlight->tagline ?? '' }}
                </p>


                <h1 class="text-4xl md:text-5xl font-bold mb-3">{{ $highlight->film->judul ?? '-' }}</h1>
                <p class="text-lg text-gray-200 mb-4">{{ $highlight->kategori ?? '-' }}</p>
                @foreach ($film as $item)
                    <a href="{{ route('film.detail', $item->slug) }}"
                        class="bg-blue-300 text-black font-semibold px-4 py-2 rounded hover:bg-blue-400 transition-colors w-full block text-center">
                        Lihat Detail
                    </a>
                @endforeach

            </div>
        </section>
    @else
        <section class="h-[60vh] flex items-center justify-center bg-gray-200 text-gray-500">
            <p>Tidak ada highlight aktif saat ini.</p>
        </section>
    @endif




    <!-- Header -->
    <header class="px-8 py-10" x-data="{ tab: 'semua' }">
        <h2 class="text-4xl font-bold mb-4 text-blue-500">Rekomendasi Film</h2>

        <div class="flex items-center border-b border-blue-300 pb-2 space-x-6 text-lg font-semibold">
            <button @click="tab = 'semua'"
                :class="tab === 'semua' ? 'text-white border-b-2 border-blue-400' : 'text-blue-300 hover:text-white'">
                Semua
            </button>

            <button @click="tab = 'populer'"
                :class="tab === 'populer' ? 'text-white border-b-2 border-blue-400' : 'text-blue-300 hover:text-white'">
                Film Populer
            </button>

            <button @click="tab = 'baru'"
                :class="tab === 'baru' ? 'text-white border-b-2 border-blue-400' : 'text-blue-300 hover:text-white'">
                Baru Rilis
            </button>
        </div>


    </header>


    <!-- Film Cards -->
    <section class="px-8 py-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($film as $item)
            <div
                class="bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:scale-105 transition-transform duration-300 relative">
                <div class="relative">
                    <img src="{{ asset('storage/fotos/' . $item->foto) }}" alt="{{ $item->judul }}"
                        class="w-full h-64 object-cover">

                    {{-- Rating --}}
                    @php
                        $rating = 4.5;
                        $fullStars = floor($rating);
                        $halfStar = $rating - $fullStars >= 0.5;
                    @endphp

                    <div
                        class="absolute bottom-2 left-2 bg-black/60 px-2 py-1 rounded-md flex items-center space-x-1 backdrop-blur-sm">
                        @for ($i = 0; $i < $fullStars; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#facc15" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="#facc15" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.48 3.5l2.31 4.68 5.18.75-3.75 3.65.89 5.19L11.5 15.9l-4.61 2.42.88-5.19-3.75-3.65 5.19-.75 2.27-4.63z" />
                            </svg>
                        @endfor

                        @if ($halfStar)
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="url(#half)"
                                stroke="#facc15" stroke-width="1.5" class="w-4 h-4">
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

                        <span
                            class="text-yellow-400 text-xs ml-1 font-semibold">({{ number_format($rating, 1) }})</span>
                    </div>
                </div>

                <div class="p-4">
                    <h3 class="text-xl text-white font-semibold mb-1">{{ $item->judul }}</h3>
                    <p class="text-gray-400 text-sm mb-3">{{ Str::limit($item->deskripsi, 80) }}</p>
                    <a href="{{ route('film.detail', $item->slug) }}"
                        class="bg-blue-300 text-black font-semibold px-4 py-2 rounded hover:bg-blue-400 transition-colors w-full block text-center">
                        Lihat Detail
                    </a>
                </div>
            </div>
        @empty
            <div>
                <p>KOK KOSONG</p>
            </div>
        @endforelse

    </section>




</body>

<script>
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    let timer = null;

    searchInput.addEventListener('keyup', function() {
        const query = this.value.trim();
        clearTimeout(timer);

        // delay 300ms biar ga spam request
        timer = setTimeout(() => {
            if (query.length > 1) {
                fetch(`/search?q=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        searchResults.innerHTML = '';

                        if (data.length > 0) {
                            data.forEach(film => {
                                const item = document.createElement('a');
                                item.href = `/film/${film.slug}`;
                                item.className = 'block px-4 py-2 hover:bg-blue-100';
                                item.innerHTML = `<strong>${film.judul}</strong>`;
                                searchResults.appendChild(item);
                            });
                        } else {
                            searchResults.innerHTML =
                                '<p class="px-4 py-2 text-gray-500">Tidak ada hasil.</p>';
                        }

                        searchResults.classList.remove('hidden');
                    });
            } else {
                searchResults.classList.add('hidden');
            }
        }, 300);
    });

    // sembunyikan hasil saat klik di luar
    document.addEventListener('click', function(e) {
        if (!searchResults.contains(e.target) && e.target !== searchInput) {
            searchResults.classList.add('hidden');
        }
    });
</script>


</html>
