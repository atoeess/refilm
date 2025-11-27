<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login — ReFilm</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;700&display=swap" rel="stylesheet">

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.6s ease-out;
        }
    </style>
</head>

<body class="bg-[#0f0f0f] min-h-screen flex items-center justify-center font-['Comfortaa'] relative overflow-hidden">

    <div class="absolute -top-20 -left-20 w-72 h-72 bg-blue-500/30 blur-[110px] rounded-full"></div>
    <div class="absolute bottom-0 right-0 w-64 h-64 bg-purple-600/20 blur-[100px] rounded-full"></div>

    <form action="{{ route('login.post') }}" method="POST"
        class="animate-fadeIn bg-white/10 backdrop-blur-xl border border-white/10 p-8 rounded-3xl shadow-xl w-80 sm:w-96 text-gray-200">

        @csrf

        <h2 class="text-3xl font-bold mb-6 text-center text-blue-400 drop-shadow-md">
            Login ke ReFilm
        </h2>

        @if(session('error'))
            <p class="text-red-400 text-sm mb-4 text-center">{{ session('error') }}</p>
        @endif

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Email</label>
            <div class="relative">
                <input type="email" name="email" autocomplete="off" placeholder="youremail@example.com"
                    class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-2 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500/70 transition"
                    required>

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 absolute left-3 top-2.5 text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 12H8m8 0l-8-6m8 6l-8 6" />
                </svg>
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold mb-1">Password</label>
            <div class="relative">
                <input type="password" name="password" autocomplete="new-password" placeholder="••••••••"
                    class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-2 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500/70 transition"
                    required>

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 absolute left-3 top-2.5 text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 11c0-1.105-.895-2-2-2s-2 .895-2 2m4 0a4 4 0 11-8 0a4 4 0 018 0z" />
                </svg>
            </div>
        </div>

        <button type="submit"
            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 w-full rounded-xl shadow-lg hover:shadow-blue-500/40 transition-all duration-200">
            Masuk
        </button>

        <p class="text-sm mt-4 text-center text-gray-300">
            Belum punya akun?
            <a href="{{ route('register') }}"
                class="text-blue-400 font-semibold hover:underline">
                Daftar
            </a>
        </p>

    </form>

</body>

</html>
