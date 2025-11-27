@extends('layouts.app')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">

        <div class="w-full px-6 py-6 mx-auto">

            <div class="bg-white shadow-xl border border-gray-100 rounded-2xl overflow-hidden">

                <div class="px-8 py-6 border-b bg-gray-50">
                    <h2 class="text-2xl font-bold text-slate-700">Edit Film</h2>
                </div>

                <div class="px-8 py-8">

                    <form action="{{ route('film.update', $film->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                            {{-- Poster --}}
                            <div class="md:col-span-2">
                                <label class="block mb-2 text-sm font-semibold">Poster Film</label>

                                <input type="file" name="foto" class="w-full rounded-xl border px-4 py-3 text-sm"
                                    onchange="previewEdit(event)">

                                <div class="flex gap-10 mt-4">

                                    <div>
                                        <p class="text-xs mb-1">Sebelumnya</p>
                                        <img src="{{ asset('storage/fotos/' . $film->foto) }}"
                                            class="w-40 rounded-xl border shadow">
                                    </div>

                                    <div>
                                        <p class="text-xs mb-1">Baru</p>
                                        <img id="previewEdit" class="hidden w-40 rounded-xl border shadow">
                                    </div>

                                </div>
                            </div>

                            {{-- Judul --}}
                            <div>
                                <label class="block mb-2 text-sm font-semibold">Judul</label>
                                <input type="text" name="judul" value="{{ $film->judul }}"
                                    class="w-full rounded-xl border px-4 py-3 text-sm">
                            </div>

                            {{-- Tahun --}}
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-slate-700">Tahun</label>
                                <select name="tahun" class="w-full rounded-xl border px-4 py-3 text-sm">
                                    @foreach ($tahuns as $tahun)
                                        <option value="{{ $tahun->tahun }}"
                                            {{ $film->tahun == $tahun->tahun ? 'selected' : '' }}>
                                            {{ $tahun->tahun }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            {{-- Negara --}}
                            <div>
                                <label class="block mb-2 text-sm font-semibold">Negara</label>
                                <select name="negara" class="w-full rounded-xl border px-4 py-3 text-sm">
                                    @foreach ($negaras as $negara)
                                        <option value="{{ $negara->id }}"
                                            {{ $film->id_negara == $negara->id ? 'selected' : '' }}>
                                            {{ $negara->nama_negara }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Genre --}}
                            <div>
                                <label class="block mb-2 text-sm font-semibold">Genre</label>

                                <div class="grid grid-cols-2 gap-2 p-3 border rounded-xl max-h-52 overflow-y-auto">

                                    @foreach ($genres as $genre)
                                        <label class="flex items-center gap-2 text-sm">
                                            <input type="checkbox" name="genre[]" value="{{ $genre->id }}"
                                                {{ in_array($genre->id, $film->genres->pluck('id')->toArray()) ? 'checked' : '' }}
                                                class="w-4 h-4 text-blue-600">
                                            {{ $genre->nama_genre }}
                                        </label>
                                    @endforeach

                                </div>
                            </div>

                            {{-- Trailer --}}
                            <div class="md:col-span-2">
                                <label class="block mb-2 text-sm font-semibold">Trailer</label>
                                <input type="text" name="trailer" value="{{ $film->trailer }}"
                                    class="w-full rounded-xl border px-4 py-3 text-sm">
                            </div>

                            {{-- Deskripsi --}}
                            <div class="md:col-span-2">
                                <label class="block mb-2 text-sm font-semibold">Deskripsi</label>
                                <textarea name="deskripsi" rows="3" class="w-full rounded-xl border px-4 py-3 text-sm">{{ $film->deskripsi }}</textarea>
                            </div>

                            {{-- Sinopsis --}}
                            <div class="md:col-span-2">
                                <label class="block mb-2 text-sm font-semibold">Sinopsis</label>
                                <textarea name="sinopsis" rows="4" class="w-full rounded-xl border px-4 py-3 text-sm">{{ $film->sinopsis }}</textarea>
                            </div>

                        </div>

                        <div class="flex justify-between mt-10">
                            <button type="button" onclick="history.back()"
                                class="px-5 py-3 rounded-xl bg-gray-200 text-gray-800">
                                Kembali
                            </button>

                            <button type="submit" class="px-5 py-3 rounded-xl bg-blue-600 text-white font-bold shadow">
                                Update
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </main>

    <script>
        function previewEdit(event) {
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
