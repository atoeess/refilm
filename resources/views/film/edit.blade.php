@extends('layouts.app')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Film</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Edit film</h6>
                </nav>
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="w-full px-6 py-6 mx-auto">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                <div
                    class="p-6 pb-0 mb-0 border-b-0 border-b-solid border-gray-200 rounded-t-2xl flex justify-between items-center">
                    <h6 class="text-lg font-bold text-slate-700">Edit Data film</h6>
                    <a href="{{ route('film.index') }}"
                        class="bg-gradient-secondary text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-600 transition-all">
                        Kembali
                    </a>
                </div>

                <div class="flex-auto p-6">
                    <form action="{{ route('film.update', $films->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Judul --}}
                        {{-- Upload poster --}}
                        <div class="mb-4">
                            <label for="foto" class="form-label font-semibold">Poster</label>
                            <input type="file" name="foto" id="foto" accept="image/*"
                                class="form-control border border-gray-300 rounded-lg p-2 w-full"
                                onchange="previewEditImage(event)">
                        </div>

                        {{-- Before & After preview --}}
                        <div class="flex gap-6 mt-3">
                            <div class="text-center">
                                <p class="text-sm text-gray-500 mb-1">Before</p>
                                <img src="{{ asset('storage/fotos/' . $films->foto) }}" alt="Foto Lama"
                                    class="w-40 h-56 object-cover rounded-lg border">
                            </div>

                            <div class="text-center">
                                <p class="text-sm text-gray-500 mb-1">After</p>
                                <img id="previewEdit" class="hidden w-40 h-56 object-cover rounded-lg border"
                                >
                            </div>
                        </div>


                        <div class="mb-4">
                            <label for="judul" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">
                                Judul
                            </label>
                            <input type="text" name="judul" id="judul" value="{{ old('judul', $films->judul) }}"
                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                placeholder="Masukkan Judul">
                        </div>
                        <div class="mb-4">
                            <label for="deskripsi" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">
                                Deskripsi
                            </label>
                            <input type="text" name="deskripsi" id="deskripsi"
                                value="{{ old('deskripsi', $films->deskripsi) }}"
                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                placeholder="Masukkan Deskripsi">
                        </div>
                        <div class="mb-4">
                            <label for="genre"
                                class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Genre</label>
                            <select name="genre[]" id="genre" multiple class="focus:shadow-primary-outline ...">
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre->id }}"
                                        {{ $films->genres->contains($genre->id) ? 'selected' : '' }}>
                                        {{ $genre->nama_genre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="tahun" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">
                                Tahun
                            </label>
                            <input type="text" name="tahun" id="tahun" value="{{ old('tahun', $films->tahun) }}"
                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                placeholder="Masukkan Nama film">
                        </div>
                        <div class="mb-4">
                            <label for="negara"
                                class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Negara</label>
                            <select name="negara" id="negara" class="focus:shadow-primary-outline ...">
                                @foreach ($negaras as $negara)
                                    <option value="{{ $negara->id }}"
                                        {{ $films->id_negara == $negara->id ? 'selected' : '' }}>
                                        {{ $negara->nama_negara }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="sinopsis" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">
                                Sinopsis
                            </label>
                            <input type="text" name="sinopsis" id="sinopsis"
                                value="{{ old('sinopsis', $films->sinopsis) }}"
                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                placeholder="Masukkan Nama film">
                        </div>
                        <div class="mb-4">
                            <label for="trailer" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">
                                trailer
                            </label>
                            <input type="text" name="trailer" id="trailer"
                                value="{{ old('trailer', $films->trailer) }}"
                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                placeholder="Masukkan Nama film">
                        </div>


                        {{-- Tombol Update --}}
                        <div class="flex justify-between mt-6">
                            <button type="button" onclick="history.back()"
                                class="bg-gray-300 hover:bg-gray-400 text-black font-semibold py-2 px-4 rounded-lg transition duration-200">
                                Kembali
                            </button>
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded-lg transition-all text-white">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        function previewEditImage(event) {
            const input = event.target;
            const preview = document.getElementById('previewEdit');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
