@extends('layouts.app')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">

    <div class="w-full px-6 py-6 mx-auto">

        <div class="bg-white shadow-xl border border-gray-100 rounded-2xl overflow-hidden">

            <div class="px-8 py-6 border-b border-gray-200 bg-gray-50">
                <h2 class="text-2xl font-bold text-slate-700">Tambah Film</h2>
                <p class="text-sm text-gray-500 mt-1">Lengkapi data film dengan benar.</p>
            </div>

            <div class="px-8 py-8">

                <form action="{{ route('film.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        {{-- Poster --}}
                        <div class="md:col-span-2">
                            <label class="block mb-2 text-sm font-semibold text-slate-700">Poster Film</label>
                            <input type="file" name="foto" id="foto"
                                class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm"
                            >
                            <img id="preview" class="hidden w-48 mt-4 rounded-xl border shadow">
                        </div>

                        {{-- Judul --}}
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700">Judul</label>
                            <input type="text" name="judul" class="w-full rounded-xl border px-4 py-3 text-sm"
                                placeholder="Masukkan Judul Film">
                        </div>

                        {{-- Tahun --}}
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700">Tahun</label>
                            <select name="tahun" class="w-full rounded-xl border px-4 py-3 text-sm">
                                @foreach ($tahuns as $tahun)
                                    <option value="{{ $tahun->id }}">{{ $tahun->tahun }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Negara --}}
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700">Negara</label>
                            <select name="negara" class="w-full rounded-xl border px-4 py-3 text-sm">
                                @foreach ($negaras as $negara)
                                    <option value="{{ $negara->id }}">{{ $negara->nama_negara }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Genre --}}
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700">Genre</label>

                            <div class="grid grid-cols-2 gap-2 p-3 border rounded-xl max-h-52 overflow-y-auto">

                                @foreach ($genres as $genre)
                                    <label class="flex items-center gap-2 text-sm">
                                        <input
                                            type="checkbox"
                                            name="genre[]"
                                            value="{{ $genre->id }}"
                                            class="w-4 h-4 text-blue-600"
                                        >
                                        {{ $genre->nama_genre }}
                                    </label>
                                @endforeach

                            </div>
                        </div>

                        {{-- Trailer --}}
                        <div class="md:col-span-2">
                            <label class="block mb-2 text-sm font-semibold">Trailer</label>
                            <input type="text" name="trailer"
                                class="w-full rounded-xl border px-4 py-3 text-sm"
                                placeholder="https://youtube.com/...">
                        </div>

                        {{-- Deskripsi --}}
                        <div class="md:col-span-2">
                            <label class="block mb-2 text-sm font-semibold">Deskripsi</label>
                            <textarea name="deskripsi" rows="3"
                                class="w-full rounded-xl border px-4 py-3 text-sm"></textarea>
                        </div>

                        {{-- Sinopsis --}}
                        <div class="md:col-span-2">
                            <label class="block mb-2 text-sm font-semibold">Sinopsis</label>
                            <textarea name="sinopsis" rows="4"
                                class="w-full rounded-xl border px-4 py-3 text-sm"></textarea>
                        </div>

                    </div>

                    <div class="flex justify-between mt-10">
                        <button type="button" onclick="history.back()"
                            class="px-5 py-3 rounded-xl bg-gray-200 text-gray-800">
                            Kembali
                        </button>

                        <button type="submit"
                            class="px-5 py-3 rounded-xl bg-blue-600 text-white font-bold">
                            Simpan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>

<script>
    document.getElementById('foto').addEventListener('change', e => {
        const file = e.target.files[0];
        const preview = document.getElementById('preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = ev => {
                preview.src = ev.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection
