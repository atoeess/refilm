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
            <h1 class="text-3xl font-bold text-blue-300">ReFilm</h1>
        </div>

        <!-- Search Bar -->
        <div class="flex-1 mx-12">
            <input type="text" placeholder="Type here..."
                class="w-full px-4 py-2 rounded bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-300">
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

    <!-- Hero Section -->
    <section class="relative h-[80vh] flex items-end bg-cover bg-center text-white"
        style="background-image: url('https://upload.wikimedia.org/wikipedia/en/5/56/Secret_High_School_poster.jpg');">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-transparent"></div>

        <div class="relative z-10 px-10 pb-16 max-w-4xl">
            <h1 class="text-5xl font-bold mt-4 mb-2">Mendadak Dangdut</h1>
            <p class="text-lg text-gray-300 mb-6">Drama Komedi | </p>
            <div class="flex space-x-4">
                <a href="#"
                    class="bg-blue-300 text-black font-bold px-6 py-3 rounded-lg hover:bg-blue-400 transition duration-200">
                    Detail Film
                </a>
            </div>
        </div>
    </section>

    <!-- Header -->
    <header class="px-8 py-10">
        <h2 class="text-4xl font-bold mb-4 text-blue-300">Rekomendasi Film</h2>
        <div class="flex items-center border-b border-blue-300 pb-2 space-x-6 text-lg font-semibold">
            <button class="text-blue-300 hover:text-white">Semua</button>
            <button class="text-blue-300 hover:text-white">Film Populer</button>
            <button class="text-blue-300 hover:text-white">Baru Rilis</button>
        </div>
    </header>

    <!-- Film Cards -->
    <section class="px-8 py-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @forelse ($films as $film)
            <div
                class="bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:scale-105 transition-transform duration-300">
                <img src="{{ asset('storage/fotos/' . $film->foto) }}" alt="{{ $film->judul }}"
                    class="w-full h-64 object-cover">
                <div class="p-4">
                    <h3 class="text-xl text-white font-semibold mb-1">{{ $film->judul }}</h3>
                    <p class="text-gray-400 text-sm mb-3">
                        {{ Str::limit($film->deskripsi, 80) }}
                    </p>
                    <a href="{{ route('film.detail', $film->slug) }}"
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

</html>
