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
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Negara</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Edit Negara</h6>
            </nav>
        </div>
    </nav>
    <!-- End Navbar -->

    <div class="w-full px-6 py-6 mx-auto">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid border-gray-200 rounded-t-2xl flex justify-between items-center">
                <h6 class="text-lg font-bold text-slate-700">Edit Data Negara</h6>
                <a href="{{ route('negara.index') }}"
                   class="bg-gradient-secondary text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-600 transition-all">
                    Kembali
                </a>
            </div>

            <div class="flex-auto p-6">
                <form action="{{ route('negara.update', $negara->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nama Negara --}}
                    <div class="mb-4">
                        <label for="nama_negara" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">
                            Nama Negara
                        </label>
                        <input type="text" name="nama_negara" id="nama_negara"
                            value="{{ old('nama_negara', $negara->nama_negara) }}"
                            class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                            placeholder="Masukkan Nama Negara">
                    </div>

                    {{-- Tombol Update --}}
                    <div class="flex justify-end mt-6">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-all">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
