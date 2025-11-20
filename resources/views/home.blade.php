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
    <nav
        class="fixed top-0 left-0 w-full z-50 flex items-center justify-between px-8 py-4
    bg-[#1f1f1f]/80 backdrop-blur-md shadow-lg border-b border-gray-700">

        <div class="flex items-center space-x-8">
            <h1 class="text-3xl font-bold text-blue-400">ReFilm</h1>
        </div>

        <!-- 🔹 Search Bar -->
        <form action="{{ route('film.search') }}" method="GET" class="relative flex-1 mx-12">
            <input type="text" name="q" placeholder="Cari film..."
                class="w-full px-4 py-2 rounded bg-[#1e1e1e] text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400 border border-gray-700">
        </form>

        <!-- 🔹 Dropdown & Auth Buttons -->
        <!-- 🔹 Dropdown & Auth Buttons -->
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

            {{-- 🔹 Login / Logout --}}
            @guest
                <a href="{{ route('login') }}"
                    class="bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded text-sm text-white font-semibold transition-all duration-200">
                    Sign In
                </a>
            @endguest

            @auth
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('dashboard') }}"
                        class="bg-green-500 hover:bg-green-600 px-3 py-1 rounded text-sm text-white font-semibold transition-all duration-200">
                        Dashboard Admin
                    </a>
                @endif

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-sm text-white font-semibold transition-all duration-200">
                        Logout
                    </button>
                </form>
            @endauth
        </div>

    </nav>

    {{-- 🔹 HERO SECTION --}}
    @if ($highlights->count() > 0)
        <section x-data="{
            current: 0,
            items: {{ $highlights->values() }},
            next() {
                this.current = (this.current + 1) % this.items.length;
            }
        }" x-init="setInterval(() => next(), 5000)"
            class="relative h-[100vh] flex items-end bg-cover bg-center text-white transition-all duration-700"
            :style="`background-image: url('/storage/${items[current].thumbnail}')`">

            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/70 to-transparent"></div>

            <div class="relative z-10 p-10 md:p-16 transition-all duration-500">
                <p class="inline-block text-white font-semibold px-6 py-2 bg-blue-400/60 backdrop-blur-sm rounded-tl-xl rounded-br-xl"
                    x-text="items[current].tagline">
                </p>

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

    <div x-data="{
        tab: 'semua',
        semua: @js($filmsSemua),
        populer: @js($filmsPopuler),
        baru: @js($filmsBaru),
    }" class="px-8 py-10">

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

            <template x-for="item in (tab === 'semua' ? semua : tab === 'populer' ? populer : baru)"
                :key="item.id">

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

    </div>

</body>

</html>
