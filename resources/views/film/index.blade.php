@extends('layouts.app')

@section('content')

<div class="px-6 py-4">

    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">📽️ Daftar Film</h1>
            <p class="text-sm text-gray-500">Kelola semua film yang ada dalam sistem</p>
        </div>

        <a href="{{ route('film.create') }}"
            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-xl transition-all shadow">
            <i class="fas fa-plus"></i> Tambah Film
        </a>
    </div>

    <!-- Card Container -->
    <div class="bg-white/70 backdrop-blur shadow rounded-xl overflow-hidden border border-gray-200">

        <!-- TABLE -->
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase">Poster</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase">Judul</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase w-64">Deskripsi</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase">Genre</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase">Tahun</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase">Negara</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase">Trailer</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse ($films as $film)
                        <tr class="hover:bg-gray-50/60 transition">
                            <!-- Poster -->
                            <td class="px-4 py-3">
                                @if ($film->foto)
                                    <img src="{{ asset('storage/fotos/' . $film->foto) }}"
                                        class="w-20 h-28 object-cover rounded-lg shadow-sm border"
                                        alt="poster">
                                @else
                                    <span class="text-sm text-gray-400">Tidak ada poster</span>
                                @endif
                            </td>

                            <!-- Judul -->
                            <td class="px-4 py-3">
                                <p class="font-medium text-gray-800">{{ $film->judul }}</p>
                            </td>

                            <!-- Deskripsi -->
                            <td class="px-4 py-3 text-gray-600 text-sm leading-relaxed">
                                <p class="line-clamp-3">{{ $film->deskripsi }}</p>
                            </td>

                            <!-- Genre -->
                            <td class="px-4 py-3">
                                @foreach ($film->genres as $item)
                                    <span class="inline-block bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-lg mr-1 mb-1">
                                        {{ $item->nama_genre }}
                                    </span>
                                @endforeach
                            </td>

                            <!-- Tahun -->
                            <td class="px-4 py-3">
                                <span class="font-semibold text-gray-700">{{ $film->tahun }}</span>
                            </td>

                            <!-- Negara -->
                            <td class="px-4 py-3">
                                <span class="text-gray-700">{{ $film->negara->nama_negara }}</span>
                            </td>

                            <!-- Trailer -->
                            <td class="px-4 py-3">
                                <a href="{{ $film->trailer }}" target="_blank"
                                    class="text-blue-600 hover:underline text-sm">
                                    Lihat
                                </a>
                            </td>

                            <!-- Actions -->
                            <td class="px-4 py-3 text-center flex gap-2 justify-center">

                                <!-- EDIT -->
                                <a href="{{ route('film.edit', $film->id) }}"
                                    class="px-3 py-1.5 rounded-lg bg-yellow-400 hover:bg-yellow-500 text-white text-xs font-semibold shadow">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>

                                <!-- DELETE -->
                                <form action="{{ route('film.destroy', $film->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus film ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="px-3 py-1.5 rounded-lg bg-red-500 hover:bg-red-600 text-white text-xs font-semibold shadow">
                                        <i class="fas fa-trash mr-1"></i> Hapus
                                    </button>
                                </form>

                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-6 text-gray-500">
                                Belum ada data film.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>

@endsection
