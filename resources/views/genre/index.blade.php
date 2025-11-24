@extends('layouts.app')

@section('content')

<main class="main-content" style="min-height: 100vh; padding-top: 20px; background: linear-gradient(180deg, #ececec 0%, #ececec 100%); font-family: sans-serif;">

    <!-- NAVBAR -->
     <nav style="display: flex; margin-left: 20px; margin-right: 20px; justify-content: space-between; align-items: center; padding: 10px 20px; background: rgba(255,255,255,0.8); border-radius: 8px; margin-bottom: 20px;">
        <div>
            <h6 style="margin: 0; font-weight: bold;">Genre</h6>
        </div>
    </nav>


        <!-- Right Side -->
        {{-- <div class="flex items-center gap-4">

            <!-- Settings -->
            <button class="text-gray-700 hover:text-black">
                <i class="fa fa-cog text-lg"></i>
            </button>

            <!-- Notification -->
            <button class="text-gray-700 hover:text-black">
                <i class="fa fa-bell text-lg"></i>
            </button>

        </div> --}}
    </nav>

    <!-- CONTENT -->
    <div style="padding: 0 20px;">
        <div style="background: #fff; border-radius: 12px; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">

            <!-- Header -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h6 style="text-transform: uppercase; color: #888;">Genre Table</h6>
                <a href="{{ route('genre.create') }}" style="background: #333; color: #fff; padding: 10px 25px; font-weight: bold; border-radius: 8px; text-decoration: none;">
                    + Tambah Genre
                </a>
            </div>


            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">

                    <thead>
                        <tr class="bg-gray-100 text-gray-600 uppercase text-xs">
                            <th class="py-3 px-4 text-left">Nama Genre</th>
                            <th class="py-3 px-4 text-center w-40">Action</th>
                        </tr>
                    </thead>

                    <tbody class="text-sm text-gray-700">

                        @forelse ($genres as $genre)
                            <tr class="border-b hover:bg-gray-50 transition">

                                <!-- Nama Genre -->
                                <td class="py-3 px-4 font-medium">
                                    {{ $genre->nama_genre }}
                                </td>

                                <!-- Action -->
                                <td class="py-3 px-4 flex justify-center gap-2">

                                    {{-- EDIT --}}
                                    <a href="{{ route('genre.edit', $genre->id) }}"
                                       class="px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white rounded-md text-xs font-semibold shadow">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>

                                    {{-- DELETE --}}
                                    <form action="{{ route('genre.destroy', $genre->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            onclick="return confirm('Yakin ingin menghapus genre ini?')"
                                            class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-md text-xs font-semibold shadow">
                                            <i class="fas fa-trash-alt mr-1"></i> Hapus
                                        </button>
                                    </form>

                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="2" class="py-6 text-center text-gray-500">
                                    Belum ada data genre.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

        </div>

    </div>

</main>

@endsection
