<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ReFilm')</title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="//unpkg.com/alpinejs" defer></script>


    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- Custom Style --}}
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #0a0a0a;
            color: #fff;
        }

        .glass {
            background: rgba(255, 255, 255, 0.07);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background: #444;
            border-radius: 10px;
        }

        .nav-link {
            @apply text-gray-300 hover:text-red-500 transition;
        }
    </style>

    @stack('styles')
</head>
<body class="relative min-h-screen flex flex-col">

    {{-- Background --}}
    <div class="absolute inset-0">
        @yield('background')
        <div class="absolute inset-0 bg-black/70"></div>
    </div>

    {{-- Navbar --}}
    <nav class="relative z-10 glass shadow-lg flex justify-between items-center px-8 py-4">
        <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-500  transition">
            🎬 ReFilm
        </a>

        <div class="flex gap-6">
            <a href="{{ route('home') }}" class="nav-link">Beranda</a>
            <a href="{{ route('film.index') }}" class="nav-link">Film</a>
            <a href="{{ route('genre.index') }}" class="nav-link">Genre</a>
            <a href="{{ route('negara.index') }}" class="nav-link">Negara</a>
        </div>
    </nav>

    {{-- Main content --}}
    <main class="relative z-10 flex-1 px-6 md:px-16 py-10">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="relative z-10 glass text-center py-6 text-gray-400 text-sm">
        © {{ date('Y') }} ReFilm — Semua Hak Dilindungi.
    </footer>

    @stack('scripts')
</body>
</html>
