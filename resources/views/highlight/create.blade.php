@extends('layouts.app')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="w-full px-6 py-6 mx-auto">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid border-gray-200 rounded-t-2xl">
                <h6 class="text-lg font-bold text-slate-700">Tambah Highlight</h6>
            </div>
            <div class="flex-auto p-6">
                <form action="{{ route('highlight.store') }}" method="POST">
                    @csrf

                    {{-- THUMBNAIL --}}
                    <div class="mb-4">
                        <label for="thumbnail" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Thumbnail</label>
                        <input type="text" name="thumbnail" id="thumbnail"
                            class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                            placeholder="Masukkan Nama genre">
                    </div>
                    <div class="mb-4">
                        <label for="status" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Status</label>
                        <input type="text" name="status" id="status"
                            class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                            placeholder="Masukkan Nama genre">
                    </div>
                    <div class="mb-4">
                        <label for="kategori_highlight" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Kategori</label>
                        <input type="text" name="kategori_highlight" id="kategori_highlight"
                            class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                            placeholder="Masukkan Nama genre">
                    </div>
                    <div class="mb-4">
                        <label for="judul" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Judul film</label>
                        <input type="text" name="judul" id="judul"
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
