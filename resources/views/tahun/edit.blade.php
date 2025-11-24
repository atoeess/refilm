@extends('layouts.app')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">

<div class="w-full px-6 py-6 mx-auto">
    <div class="bg-white shadow-xl rounded-2xl">
        <div class="p-6 border-b flex justify-between">
            <h6 class="text-lg font-bold">Edit Tahun</h6>
            <a href="{{ route('tahun.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg">Kembali</a>
        </div>

        <div class="p-6">
            <form action="{{ route('tahun.update', $tahun->id) }}" method="POST">
                @csrf
                @method('PUT')

                <label class="font-bold text-xs mb-2 block">Tahun</label>
                <input type="text" name="tahun" value="{{ $tahun->tahun }}"
                    class="w-full border rounded-lg px-3 py-2">

                <div class="flex justify-end mt-6">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

</main>
@endsection
