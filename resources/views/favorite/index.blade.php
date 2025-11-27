    @extends('layouts.user')

    @section('content')
        <main class="p-6">

            <h1 class="text-2xl font-bold text-white mb-6 tracking-wide">
                ❤️ Film Favorit Saya
            </h1>

            @if ($favorites->isEmpty())
                <div class="flex flex-col items-center justify-center py-20 text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 opacity-40 mb-4" viewBox="0 0 24 24"
                        fill="currentColor">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 6
                            3.5 4 5.5 4c1.74 0 3.41 1.01 4.13 2.44h0.74C12.09 5.01
                            13.76 4 15.5 4 17.5 4 19 6 19 8.5c0 3.78-3.4 6.86-8.55
                            11.54L12 21.35z" />
                    </svg>


                    <p class="text-lg text-gray-400">Belum ada film favorit.</p>
                    <p class="text-sm mt-1 text-gray-500">Tambahkan film ke favoritmu untuk melihatnya di sini!</p>
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-5">

                    @foreach ($favorites as $fav)
                        <div
                            class="bg-[#1a1a1a] rounded-xl overflow-hidden shadow-md
        hover:scale-[1.04] hover:shadow-xl transition-all duration-300">

                            <div class="relative">
                                <img src="/storage/fotos/{{ $fav->film->foto }}" class="w-full h-48 object-cover">

                                <div class="absolute top-2 left-2">
                                    <form action="{{ route('favorite.remove', $fav->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            onclick="return confirm('Yakin ingin menghapus film ini dari daftar favorit? 🥺')"
                                            class="bg-black/60 px-2 py-1 rounded-full backdrop-blur-sm hover:bg-black transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="#ff4b91" class="w-5 h-5"
                                                viewBox="0 0 24 24">
                                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5
                                        2 6 3.5 4 5.5 4c1.54 0 3.04.99 3.57 2.36h1.87C13.46 4.99
                                        14.96 4 16.5 4 18.5 4 20 6 20 8.5c0 3.78-3.4 6.86-8.55
                                        11.54L12 21.35z" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="p-3">
                                <h2 class="text-white text-sm font-semibold line-clamp-2 min-h-[36px]">
                                    {{ $fav->film->judul }}
                                </h2>

                                <p class="text-gray-400 text-[11px] mt-1 line-clamp-2 h-8">
                                    {{ $fav->film->deskripsi }}
                                </p>

                                <a href="/film/{{ $fav->film->slug }}"
                                    class="block text-center bg-blue-400 text-black text-xs font-semibold mt-3 py-1.5 rounded hover:bg-blue-300 transition">
                                    Lihat Detail
                                </a>
                            </div>

                        </div>
                    @endforeach


                </div>
            @endif

        </main>
    @endsection
