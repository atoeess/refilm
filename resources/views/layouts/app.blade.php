<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ReFilms</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font & Icons -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700" rel="stylesheet">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

</head>

<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg h-screen sticky top-0 flex flex-col">

        <div class="p-5 border-b">
            <h1 class="text-xl font-bold text-gray-800">🎬 ReFilms</h1>
        </div>

        <nav class="flex-1 overflow-y-auto">
            <ul class="p-4 space-y-2 text-gray-700">

                <li>
                    <a href="{{ route("dashboard")}}"
                        class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                        <i class="fa-solid fa-home"></i>
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="{{ route("film.index")}}"
                        class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                        <i class="fa-solid fa-film"></i>
                        Films
                    </a>
                </li>

                <li>
                    <a href="{{ route("genre.index")}}"
                        class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                        <i class="fa-solid fa-tags"></i>
                        Genre
                    </a>
                </li>

                <li>
                    <a href="{{ route("negara.index")}}"
                        class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                        <i class="fa-solid fa-tags"></i>
                        Negara
                    </a>
                </li>

                <li>
                    <a href="{{ route("tahun.index")}}"
                        class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                        <i class="fa-solid fa-tags"></i>
                       Tahun
                    </a>
                </li>

                <li>
                    <a href="{{ route("highlight.index")}}"
                        class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                        <i class="fa-solid fa-star"></i>
                        Highlight
                    </a>
                </li>

                <li>
                    <a href="{{ route("home")}}"
                        class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                        <i class="fa-solid fa-star"></i>
                        Home
                    </a>
                </li>

            </ul>
        </nav>

        <div class="p-4 border-t">
            <form action="{{ route("logout")}}" method="POST">
                @csrf
                <button
                    class="w-full bg-red-500 hover:bg-red-600 px-4 py-2 text-white rounded-lg transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </button>
            </form>
        </div>

    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">

        @yield('content')

    </main>

</body>

</html>
