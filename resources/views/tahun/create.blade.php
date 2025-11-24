@extends('layouts.app')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
<div class="w-full px-6 py-6 mx-auto">
    <div class="flex flex-col bg-white shadow-xl rounded-2xl">
        <div class="p-6 border-b border-gray-200">
            <h6 class="text-lg font-bold">Tambah Tahun</h6>
        </div>

        <div class="p-6">
            <form action="{{ route('tahun.store') }}" method="POST">
                @csrf

                <label class="font-bold text-xs mb-2 block">Tahun</label>
                <input type="text" name="tahun"
                    class="w-full border rounded-lg px-3 py-2"
                    placeholder="Masukkan Tahun">

                <div class="flex justify-end mt-6">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
</main>
@endsection
