@extends('layouts.app')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="w-full px-6 py-6 mx-auto">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid border-gray-200 rounded-t-2xl">
                <h6 class="text-lg font-bold text-slate-700">Tambah Genre</h6>
            </div>
            <div class="flex-auto p-6">
                <form action="{{ route('genre.store') }}" method="POST">
                    @csrf

                    {{-- Nama genre --}}
                    <div class="mb-4">
                        <label for="nama_genre" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Nama
                            Genre</label>
                        <input type="text" name="nama_genre" id="nama_genre"
                            class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                            placeholder="Masukkan Nama genre">
                    </div>

                    {{-- Tombol Simpan --}}
                    <div class="flex justify-end mt-6">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-all">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </main>
@endsection
