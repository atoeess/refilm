<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak - 403</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-gray-900 to-blue-900 text-white flex items-center justify-center h-screen">
    <div class="text-center">
        <h1 class="text-9xl font-extrabold text-blue-400">403</h1>
        <p class="text-2xl mt-4 font-semibold">Akses Ditolak</p>
        <p class="mt-2 text-gray-300">Anda tidak memiliki izin untuk mengakses halaman ini.</p>
        <a href="{{ route('home') }}"
           class="mt-6 inline-block px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-all">
           Kembali ke Beranda
        </a>
    </div>
</body>
</html>

