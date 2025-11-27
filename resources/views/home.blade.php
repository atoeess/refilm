<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReFilm</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-[#0e0e0e] text-gray-100 font-sans">

    <!-- 🔹 Navbar -->
    <nav class="fixed top-0 left-0 w-full z-50 flex items-center justify-between px-8 py-4
        bg-[#1f1f1f]/80 backdrop-blur-md shadow-lg border-b border-gray-700">

        <div class="flex items-center space-x-8">
            <h1 class="text-3xl font-bold text-blue-400">ReFilm</h1>
        </div>

        <!-- 🔹 Search Bar -->
        <form action="{{ route('film.search') }}" method="GET" class="relative flex-1 mx-12">
            <input type="text" name="q" placeholder="Cari film..."
                class="w-full px-4 py-2 rounded bg-[#1e1e1e] text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400 border border-gray-700">
        </form>

        <div class="flex space-x-3">

            {{-- Dropdown Genre --}}
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open"
                    class="bg-blue-500/80 px-3 py-1 rounded text-sm text-white font-semibold flex items-center space-x-1 hover:bg-blue-500 transition">
                    <span>Genre</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform transition-transform duration-200"
                        :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="open" @click.away="open = false" x-transition
                    class="absolute bg-[#1e1e1e] border border-gray-700 rounded-lg mt-2 w-40 shadow-lg z-50">
                    @foreach ($genres as $genre)
                        <a href="{{ route('genre.film', $genre->id) }}"
                            class="block px-4 py-2 text-sm text-gray-200 hover:bg-blue-500 hover:text-white transition-colors">
                            {{ $genre->nama_genre }}
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Dropdown Negara --}}
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open"
                    class="bg-blue-500/80 px-3 py-1 rounded text-sm text-white font-semibold flex items-center space-x-1 hover:bg-blue-500 transition">
                    <span>Negara</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform transition-transform duration-200"
                        :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="open" @click.away="open = false" x-transition
                    class="absolute bg-[#1e1e1e] border border-gray-700 rounded-lg mt-2 w-40 shadow-lg z-50">
                    @foreach ($negaras as $negara)
                        <a href="{{ route('negara.film', $negara->id) }}"
                            class="block px-4 py-2 text-sm text-gray-200 hover:bg-blue-500 hover:text-white transition-colors">
                            {{ $negara->nama_negara }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Dropdown Tahun -->
            <div x-data="{ openTahun: false }" class="relative">
                <button @click="openTahun = !openTahun"
                    class="bg-blue-500/80 px-3 py-1 rounded text-sm text-white font-semibold flex items-center space-x-1 hover:bg-blue-500 transition">
                    <span>Tahun</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform transition-transform duration-200"
                        :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="openTahun" @click.away="openTahun = false" x-transition
                    class="absolute bg-[#1e1e1e] border border-gray-700 rounded-lg mt-2 w-40 shadow-lg z-50 py-2">
                    @foreach ($tahuns as $tahun)
                        <a href="{{ route('tahun.film', $tahun->tahun) }}"
                            class="block px-3 py-1 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition">
                            {{ $tahun->tahun }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- USER DROPDOWN -->
            <div x-data="{ open: false }" class="relative">
                @guest
                    <button @click="open = !open"
                        class="bg-blue-500/80 hover:bg-blue-500 px-3 py-1 rounded text-sm text-white font-semibold flex items-center space-x-1 transition">
                        <span>Sign In</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-80" fill="none"
                            viewBox="0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A9 9 0 1118.88 6.196M15 11a3 3 0 11-6 0 3 3 3 0z" />
                        </svg>
                    </button>
                @else
                    <button @click="open = !open"
                        class="bg-blue-500/80 hover:bg-blue-500 px-3 py-1 rounded text-sm text-white font-semibold flex items-center space-x-2 transition">

                        @if (Auth::user()->profile_photo_path ?? false)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                                class="w-6 h-6 rounded-full object-cover">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-90" fill="none"
                                viewBox="0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A9 9 0 1118.88 6.196M15 11a3 3 0 11-6 0 3 3 3 0z" />
                            </svg>
                        @endif

                        <span>{{ Auth::user()->name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform transition-transform"
                            :class="{ 'rotate-180': open }" fill="none" viewBox="0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                @endguest

                <div x-show="open" x-transition @click.outside="open = false"
                    class="absolute right-0 mt-2 w-48 bg-[#1e1e1e] border border-gray-700 rounded-lg overflow-hidden shadow-lg z-50">

                    @auth
                        <a href="{{ route('profile.show') }}"
                            class="flex items-center px-4 py-2 text-gray-200 hover:bg-gray-700 transition">
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M5.121 17.804A9 9 0 1118.88 6.196" />
                            </svg>
                            Profile
                        </a>
                    @endauth

                    <a href="{{ route('favorite.index') }}"
                        class="flex items-center px-4 py-2 text-gray-200 hover:bg-gray-700 transition">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                        </svg>
                        Daftar Favorit
                    </a>

                    @auth
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('dashboard') }}"
                                class="flex items-center px-4 py-2 text-gray-200 hover:bg-gray-700 transition">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h18v18H3z" />
                                </svg>
                                Dashboard Admin
                            </a>
                        @endif
                    @endauth

                    @guest
                        <a href="{{ route('login') }}"
                            class="flex items-center px-4 py-2 text-gray-200 hover:bg-gray-700 transition">
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 3h4v4M10 14l10-10" />
                            </svg>
                            Login
                        </a>
                    @endguest

                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center text-left px-4 py-2 text-gray-200 hover:bg-gray-700 transition">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    @endauth

                </div>
            </div>

        </div>
    </nav>

    {{-- HERO SECTION --}}
    @if ($highlights->count() > 0)
        <section x-data="{
            current: 0,
            items: {{ $highlights->values() }},
            next() { this.current = (this.current + 1) % this.items.length; }
        }"
        x-init="setInterval(() => next(), 5000)"
        class="relative h-[100vh] flex items-end bg-cover bg-center text-white transition-all duration-700"
        :style="`background-image: url('/storage/${items[current].thumbnail}')`">

            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/70 to-transparent"></div>

            <div class="relative z-10 p-10 md:p-16 transition-all duration-500">
                <p class="inline-block text-white font-semibold px-6 py-2 bg-blue-400/60 backdrop-blur-sm rounded-tl-xl rounded-br-xl"
                    x-text="items[current].tagline"></p>

                <h1 class="text-4xl md:text-5xl font-bold mb-3" x-text="items[current].film.judul"></h1>

                <p class="text-lg text-gray-300 mb-4" x-text="items[current].kategori"></p>

                <a :href="'/film/' + items[current].film.slug"
                    class="bg-blue-400 text-black font-semibold px-4 py-2 rounded hover:bg-blue-500 transition-colors inline-block">
                    Lihat Detail
                </a>
            </div>

            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20">
                <div class="flex flex-nowrap space-x-2 px-4 py-2 bg-black/50 backdrop-blur-sm rounded-lg">
                    @foreach ($highlights as $i => $h)
                        <div x-on:click="current = {{ $i }}"
                            class="flex-shrink-0 w-32 h-18 rounded-md overflow-hidden cursor-pointer border-4 transition-all duration-300"
                            :class="current === {{ $i }} ? 'border-blue-400' : 'border-transparent'">
                            <img src="{{ asset('storage/' . $h->thumbnail) }}" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>
            </div>

        </section>
    @else
        <section class="h-[60vh] flex items-center justify-center bg-[#1a1a1a] text-gray-400">
            <p>Tidak ada highlight aktif saat ini.</p>
        </section>
    @endif

    {{-- SECTION Rekomendasi Film --}}
    <div x-data="{
        tab: 'semua',
        semua: @js($filmsSemua),
        populer: @js($filmsPopuler),
        baru: @js($filmsBaru),

        favorites: @js($favoritesUserIds ?? []),
        isLoggedIn: {{ Auth::check() ? 'true' : 'false' }},

        toggleFavorite(id) {
            if (!this.isLoggedIn) {
                window.location.href = '{{ route('login') }}';
                return;
            }

            fetch('{{ route('favorite.toggle') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id_film: id })
            })
            .then(res => res.json())
            .then(data => {
                if (data.favorite) {
                    this.favorites.push(id);
                } else {
                    this.favorites = this.favorites.filter(f => f !== id);
                }
            });
        }
    }"
    class="px-8 py-10">

        <h2 class="text-4xl font-bold mb-4 text-blue-400">Rekomendasi Film</h2>

        <div class="flex items-center border-b border-gray-700 pb-2 space-x-6 text-lg font-semibold">
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

        <section class="px-4 py-4 grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-3">

            <template x-for="item in (tab === 'semua' ? semua : tab === 'populer' ? populer : baru)" :key="item.id">

                <div class="bg-[#1a1a1a] rounded-lg overflow-hidden shadow-md hover:scale-105 transition w-full">
                    <div class="relative">

                        <!-- Poster -->
                        <img :src="'/storage/fotos/' + item.foto" class="w-full h-44 object-cover">

                        <!-- Favorite Button -->
                        <button @click="toggleFavorite(item.id)"
                            class="absolute top-1 right-1 bg-black/60 p-2 rounded-full hover:bg-black transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                :stroke="favorites.includes(item.id) ? 'red' : 'white'" stroke-width="1.5"
                                viewBox="0 0 24 24" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.153-4.312 2.813C11.285 4.903 9.623 3.75 7.688 3.75 5.099 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                        </button>

                        <!-- Rating -->
                        <div class="absolute bottom-1 left-1 bg-black/60 px-2 py-1 rounded-md flex items-center space-x-1 backdrop-blur-sm">

                            <template x-for="i in Math.floor(Number(item.ratings_avg_nilai_rating) || 0)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#facc15" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="#facc15" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11.48 3.5l2.31 4.68 5.18.75-3.75 3.65.89 5.19L11.5 15.9l-4.61 2.42.88-5.19-3.75-3.65 5.19-.75 2.27-4.63z" />
                                </svg>
                            </template>

                            <template x-if="(Number(item.ratings_avg_nilai_rating) || 0) - Math.floor(Number(item.ratings_avg_nilai_rating) || 0) >= 0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="url(#half)"
                                    stroke="#facc15" stroke-width="1.5" class="w-4 h-4">
                                    <defs>
                                        <linearGradient id="half">
                                            <stop offset="50%" stop-color="#facc15"></stop>
                                            <stop offset="50%" stop-color="transparent"></stop>
                                        </linearGradient>
                                    </defs>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11.48 3.5l2.31 4.68 5.18.75-3.75 3.65.89 5.19L11.5 15.9l-4.61 2.42.88-5.19-3.75-3.65 5.19-.75 2.27-4.63z" />
                                </svg>
                            </template>

                            <span class="text-yellow-400 text-xs ml-1 font-semibold"
                                x-text="'(' + (Number(item.ratings_avg_nilai_rating) || 0).toFixed(1) + ')'">
                            </span>
                        </div>

                    </div>

                    <div class="p-2">
                        <h3 class="text-xs text-white font-semibold mb-1 leading-tight" x-text="item.judul"></h3>
                        <p class="text-gray-400 text-[10px] mb-2"
                            x-text="item.deskripsi.substring(0,45) + '...'">
                        </p>
                        <a :href="'/film/' + item.slug"
                            class="bg-blue-400 text-black font-semibold px-2 py-1 rounded text-[11px] block text-center">
                            Detail
                        </a>
                    </div>
                </div>

            </template>

        </section>

    </div>

    <footer class="w-full bg-[#111827] text-gray-300 mt-20 border-t border-gray-700">
        <div class="max-w-6xl mx-auto px-6 py-10 flex flex-col md:flex-row items-center justify-between">

            <div class="flex items-center space-x-3">
                <div class="relative w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-2 h-2 rounded-full bg-white/80"></div>
                    <div class="absolute right-0 top-1/2 -translate-y-1/2 w-2 h-2 rounded-full bg-white/80"></div>
                    <div class="w-4 h-4 bg-white rounded-sm"></div>
                </div>
                <span class="text-xl font-semibold text-white tracking-wide">ReFilm</span>
            </div>

            <nav class="flex space-x-6 mt-6 md:mt-0 text-sm">
                <a href="/" class="hover:text-white transition">Beranda</a>
            </nav>

            <div class="flex space-x-5 mt-6 md:mt-0 text-sm">
                <a class="hover:text-white transition cursor-pointer">IG</a>
                <a class="hover:text-white transition cursor-pointer">Email</a>
                <a class="hover:text-white transition cursor-pointer">Git</a>
            </div>

        </div>

        <div class="text-center py-5 border-t border-gray-700 text-gray-500 text-xs tracking-wider">
            © 2025 ReFilm — Semua Hak Dilindungi.
        </div>
    </footer>

</body>
</html>
