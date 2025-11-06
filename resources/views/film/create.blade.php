@extends('layouts.app')

@section('content')
    {{-- <!-- Tambahkan Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script> --}}

    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <div class="w-full px-6 py-6 mx-auto">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid border-gray-200 rounded-t-2xl">
                    <h6 class="text-lg font-bold text-slate-700">Tambah Film</h6>
                </div>

                <div class="flex-auto p-6">
                    <form action="{{ route('film.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Poster (dengan preview) --}}
                        <div class="mb-4">
                            <label for="foto" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">
                                Poster
                            </label>
                            <input type="file" name="foto" id="foto"
                                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500 focus:outline-none">

                            <!-- Tempat preview gambar -->
                            <div class="mt-3">
                                <img id="preview" src="#" alt="Preview Poster"
                                    class="hidden w-40 h-auto rounded-lg border border-gray-300 shadow-sm">
                            </div>
                        </div>

                        {{-- Judul --}}
                        <div class="mb-4">
                            <label for="judul"
                                class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Judul</label>
                            <input type="text" name="judul" id="judul"
                                class="focus:shadow-primary-outline text-sm block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-gray-700 outline-none transition-all focus:border-blue-500"
                                placeholder="Masukkan Judul Film">
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-4">
                            <label for="deskripsi"
                                class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="3"
                                class="focus:shadow-primary-outline text-sm block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-gray-700 outline-none transition-all focus:border-blue-500"
                                placeholder="Masukkan Deskripsi Film"></textarea>
                        </div>

                        {{-- Genre --}}
                        <div class="mb-4">
                            <label for="genre"
                                class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Genre</label>
                            <select name="genre[]" id="genre" multiple
                                class="focus:shadow-primary-outline text-sm block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-gray-700 outline-none transition-all focus:border-blue-500">
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre->id }}">{{ $genre->nama_genre }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tahun --}}
                        <div class="mb-4">
                            <label for="tahun"
                                class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Tahun</label>
                            <input type="text" name="tahun" id="tahun"
                                class="focus:shadow-primary-outline text-sm block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-gray-700 outline-none transition-all focus:border-blue-500"
                                placeholder="Masukkan Tahun Film">
                        </div>

                        {{-- Negara --}}
                        <div class="mb-4">
                            <label for="negara"
                                class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Negara</label>
                            <select name="negara" id="negara"
                                class="focus:shadow-primary-outline text-sm block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-gray-700 outline-none transition-all focus:border-blue-500">
                                @foreach ($negaras as $negara)
                                    <option value="{{ $negara->id }}">{{ $negara->nama_negara }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Sinopsis --}}
                        <div class="mb-4">
                            <label for="sinopsis"
                                class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Sinopsis</label>
                            <textarea name="sinopsis" id="sinopsis" rows="3"
                                class="focus:shadow-primary-outline text-sm block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-gray-700 outline-none transition-all focus:border-blue-500"
                                placeholder="Masukkan Sinopsis Film"></textarea>
                        </div>

                        {{-- Trailer --}}
                        <div class="mb-4">
                            <label for="trailer"
                                class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Trailer</label>
                            <input type="text" name="trailer" id="trailer"
                                class="focus:shadow-primary-outline text-sm block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-gray-700 outline-none transition-all focus:border-blue-500"
                                placeholder="Masukkan URL Trailer Film">
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex justify-between mt-6">
                            <!-- Tombol Kembali -->
                            <button type="button" onclick="history.back()"
                                class="bg-gray-300 hover:bg-gray-400 text-black font-semibold py-2 px-4 rounded-lg transition duration-200">
                                Kembali
                            </button>

                            <!-- Tombol Simpan -->
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-black font-semibold py-2 px-4 rounded-lg transition duration-200">
                                Simpan
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- Script untuk preview gambar -->
    <script>
        document.getElementById('foto').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('preview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    preview.src = event.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.classList.add('hidden');
            }
        });
    </script>
@endsection
