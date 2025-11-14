<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-pink-100 via-purple-100 to-blue-100 flex items-center justify-center min-h-screen font-['Comfortaa']">

    <form action="{{ route('register.post') }}" method="POST" class="bg-white p-8 rounded-3xl shadow-xl w-80 sm:w-96 animate-fadeIn">
        @csrf
        <h2 class="text-3xl font-bold mb-6 text-center text-purple-600">🌸 Daftar Akun 🌸</h2>

        @if(session('error'))
            <p class="text-red-500 text-sm mb-4 text-center">{{ session('error') }}</p>
        @endif

        <div class="mb-4 relative">
            <label class="block text-sm font-medium mb-1">Nama</label>
            <input type="text" name="name" placeholder="Nama lengkap"
                class="w-full border border-purple-200 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-300 shadow-sm" required>
        </div>

        <div class="mb-4 relative">
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" autocomplete="off" placeholder="youremail@example.com"
                class="w-full border border-purple-200 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-300 shadow-sm" required>
        </div>

        <div class="mb-4 relative">
            <label class="block text-sm font-medium mb-1">Password</label>
            <input type="password" name="password" autocomplete="new-password" placeholder="••••••••"
                class="w-full border border-purple-200 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-300 shadow-sm" required>
        </div>

        <div class="mb-6 relative">
            <label class="block text-sm font-medium mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" placeholder="••••••••"
                class="w-full border border-purple-200 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-300 shadow-sm" required>
        </div>

        <button type="submit"
            class="bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 px-4 w-full rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl">
            Daftar
        </button>

        <p class="text-sm mt-4 text-center text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-purple-500 font-semibold hover:underline">Login</a>
        </p>
    </form>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px);}
            to { opacity: 1; transform: translateY(0);}
        }
        .animate-fadeIn {
            animation: fadeIn 0.6s ease-out;
        }
    </style>

</body>
</html>
