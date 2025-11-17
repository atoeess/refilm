@extends('layouts.app')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Film</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Edit Film</h6>
            </nav>
        </div>
    </nav>

    <div class="w-full px-6 py-6 mx-auto">
        <div class="relative bg-white shadow-xl rounded-2xl">

            {{-- HEADER --}}
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <h6 class="text-lg font-bold text-slate-700">Edit Data Film</h6>
                <a href="{{ route('film.index') }}"
                    class="bg-gradient-secondary text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-600">
                    Kembali
                </a>
            </div>

            {{-- FORM --}}
            <div class="p-6">

                <form action="{{ route('film.update', $film->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- POSTER --}}
                    <div class="mb-4">
                        <label class="form-label font-semibold">Poster</label>
                        <input type="file" name="foto" accept="image/*"
                            class="form-control border rounded-lg p-2"
                            onchange="previewEditImage(event)">
                    </div>

                    {{-- BEFORE / AFTER --}}
                    <div class="flex gap-6 mt-3">
                        <div class="text-center">
                            <p class="text-sm text-gray-500 mb-1">Before</p>
                            <img src="{{ asset('storage/fotos/' . $film->foto) }}"
                                class="w-40 h-56 object-cover rounded-lg border">
                        </div>

                        <div class="text-center">
                            <p class="text-sm text-gray-500 mb-1">After</p>
                            <img id="previewEdit"
                                class="hidden w-40 h-56 object-cover rounded-lg border" />
                        </div>
                    </div>

                    {{-- JUDUL --}}
                    <div class="mb-4">
                        <label class="font-bold text-xs text-slate-700">Judul</label>
                        <input type="text" name="judul"
                            value="{{ old('judul', $film->judul) }}"
                            class="form-control border rounded-lg p-2"
                            placeholder="Masukkan Judul">
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="mb-4">
                        <label class="font-bold text-xs text-slate-700">Deskripsi</label>
                        <input type="text" name="deskripsi"
                            value="{{ old('deskripsi', $film->deskripsi) }}"
                            class="form-control border rounded-lg p-2"
                            placeholder="Masukkan Deskripsi">
                    </div>

                    {{-- GENRE --}}
                    <div class="mb-4">
                        <label class="font-bold text-xs text-slate-700">Genre</label>
                        <select name="genre[]" multiple class="form-control border rounded-lg">
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}"
                                    {{ $film->genres->contains($genre->id) ? 'selected' : '' }}>
                                    {{ $genre->nama_genre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- TAHUN --}}
                    <div class="mb-4">
                        <label class="font-bold text-xs text-slate-700">Tahun</label>
                        <input type="text" name="tahun"
                            value="{{ old('tahun', $film->tahun) }}"
                            class="form-control border rounded-lg p-2"
                            placeholder="Contoh: 2024">
                    </div>

                    {{-- NEGARA --}}
                    <div class="mb-4">
                        <label class="font-bold text-xs text-slate-700">Negara</label>
                        <select name="negara" class="form-control border rounded-lg">
                            @foreach ($negaras as $negara)
                                <option value="{{ $negara->id }}"
                                    {{ $film->id_negara == $negara->id ? 'selected' : '' }}>
                                    {{ $negara->nama_negara }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- SINOPSIS --}}
                    <div class="mb-4">
                        <label class="font-bold text-xs text-slate-700">Sinopsis</label>
                        <input type="text" name="sinopsis"
                            value="{{ old('sinopsis', $film->sinopsis) }}"
                            class="form-control border rounded-lg p-2"
                            placeholder="Masukkan Sinopsis">
                    </div>

                    {{-- TRAILER --}}
                    <div class="mb-6">
                        <label class="font-bold text-xs text-slate-700">Trailer</label>
                        <input type="text" name="trailer"
                            value="{{ old('trailer', $film->trailer) }}"
                            class="form-control border rounded-lg p-2"
                            placeholder="Masukkan URL Trailer">
                    </div>

                    {{-- BUTTONS --}}
                    <div class="flex justify-between">
                        <button type="button" onclick="history.back()"
                            class="bg-gray-300 hover:bg-gray-400 text-black font-semibold py-2 px-4 rounded-lg">
                            Kembali
                        </button>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-lg">
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
        const reader = new FileReader();
        reader.onload = e => {
            const preview = document.getElementById('previewEdit');
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
