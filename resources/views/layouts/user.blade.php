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

        <a href="{{ route('home') }}"
            class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>


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
