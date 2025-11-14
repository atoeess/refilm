<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ReFilm')</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            /* background-color: black */
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-[#0e0e0e] text-gray-100  text-gray-900 font-sans flex flex-col min-h-screen">

    {{-- 🔹 Navbar --}}
    <nav class="flex flex-wrap items-center justify-between px-6 md:px-12 py-4 bg-dark border-b border-blue-300 sticky top-0 z-50">
        {{-- Logo --}}
        <div class="flex items-center space-x-8">
            <a href="{{ route('home') }}" class="text-3xl font-bold text-blue-600">ReFilm</a>
        </div>

        {{-- 🔹 Search Bar --}}
        <form action="{{ route('film.search') }}" method="GET" class="relative flex-1 mx-6 hidden md:block">
            <input type="text" name="q" placeholder="Cari film..." value="{{ request('q') }}"
                class="w-full px-4 py-2 rounded bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-300">
        </form>

        {{-- 🔹 Dropdowns + Auth --}}
        <div class="flex items-center space-x-3 mt-3 md:mt-0">

            {{-- Dropdown Genre --}}
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open"
                    class="bg-blue-300 px-3 py-1 rounded text-sm text-white font-semibold flex items-center space-x-1 focus:outline-none">
                    <span>Genre</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform transition-transform duration-200"
                        :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" @click.away="open = false" x-transition
                    class="absolute bg-white border border-blue-300 rounded-lg mt-2 w-40 shadow-lg z-50 text-gray-800">
                    @foreach ($genres as $genre)
                        <a href="{{ route('genre.film', $genre->id) }}"
                            class="block px-4 py-2 text-sm hover:bg-blue-300 hover:text-black transition-colors">
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
                    class="absolute bg-white border border-blue-300 rounded-lg mt-2 w-40 shadow-lg z-50 text-gray-800">
                    @foreach ($negaras as $negara)
                        <a href="{{ route('negara.film', $negara->id) }}"
                            class="block px-4 py-2 text-sm hover:bg-blue-300 hover:text-black transition-colors">
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

    {{-- 🔹 Content --}}
    <main class="flex-1 px-6 md:px-12 py-10">
        @yield('content')
    </main>

    {{-- 🔹 Footer --}}
    <footer class="bg-blue-50 border-t border-blue-300 text-center py-6 text-gray-600 text-sm">
        © {{ date('Y') }} <span class="text-blue-600 font-semibold">ReFilm</span> — Semua Hak Dilindungi.
    </footer>

    @stack('scripts')
</body>

</html>
