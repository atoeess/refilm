@extends('layouts.app')

@section('content')
<div class="mt-6 px-6">

    <div class="bg-white shadow-xl rounded-xl border border-gray-200">

        <!-- HEADER -->
        <div class="flex justify-between items-center border-b border-gray-200 px-6 py-4">
            <h5 class="text-lg font-semibold text-gray-700">Daftar Highlight Film</h5>

            <a href="{{ route('highlight.create') }}"
               class="px-4 py-2 bg-gray-900 hover:bg-black text-white text-sm font-semibold rounded-lg shadow">
                + Tambah Highlight
            </a>
        </div>

        <!-- TABLE WRAPPER -->
        <div class="overflow-x-auto">
            <table class="min-w-full text-left">

                <!-- TABLE HEAD -->
                <thead>
                    <tr class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider">
                        <th class="py-3 px-4">Thumbnail</th>
                        <th class="py-3 px-4">Tagline</th>
                        <th class="py-3 px-4">Judul Film</th>
                        <th class="py-3 px-4">Kategori</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <!-- TABLE BODY -->
                <tbody class="text-sm text-gray-700">

                    @forelse ($highlights as $highlight)
                    <tr class="border-b hover:bg-gray-50 transition">

                        <!-- THUMBNAIL -->
                        <td class="py-3 px-4">
                            @if ($highlight->thumbnail)
                                <img src="{{ asset('storage/' . $highlight->thumbnail) }}"
                                     class="w-24 h-16 object-cover rounded-lg shadow">
                            @else
                                <span class="text-gray-400 text-sm italic">Tidak ada thumbnail</span>
                            @endif
                        </td>

                        <!-- TAGLINE -->
                        <td class="py-3 px-4">
                            {{ $highlight->tagline ?? '-' }}
                        </td>

                        <!-- JUDUL FILM -->
                        <td class="py-3 px-4 font-semibold text-gray-800">
                            {{ $highlight->film ? $highlight->film->judul : 'Film tidak ditemukan' }}
                        </td>

                        <!-- KATEGORI -->
                        <td class="py-3 px-4 capitalize">
                            {{ $highlight->kategori ?? '-' }}
                        </td>

                        <!-- ACTION -->
                        <td class="py-3 px-4 text-center flex justify-center gap-2">

                            <!-- EDIT -->
                            <a href="{{ route('highlight.edit', ['id' => $highlight->id]) }}"
                               class="px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white rounded-md text-xs font-semibold shadow">
                                Edit
                            </a>

                            <!-- DELETE -->
                            <form action="{{ route('highlight.destroy', ['id' => $highlight->id]) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus highlight ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-md text-xs font-semibold shadow">
                                    Hapus
                                </button>
                            </form>

                        </td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-500 italic">
                            Belum ada data highlight.
                        </td>
                    </tr>
                    @endforelse

                </tbody>

            </table>
        </div>

    </div>

</div>
@endsection
