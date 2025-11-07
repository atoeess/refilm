@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Tambah Highlight Baru</h2>

        {{-- Notifikasi sukses / error --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('highlight.store') }}" method="POST" enctype="multipart/form-data"
            class="p-4 border rounded shadow-sm bg-light">
            @csrf

            {{-- Thumbnail --}}
            <div class="mb-4">
                <label for="thumbnail" class="form-label fw-bold">Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" class="form-control" accept="image/*" required>
            </div>

            {{-- Tagline --}}
            <div class="mb-4">
                <label for="tagline" class="form-label fw-bold">Tagline</label>
                <input type="text" name="tagline" id="tagline" class="form-control"
                    placeholder="Masukkan tagline highlight">
            </div>

            {{-- Pilih Film --}}
            <div class="mb-4">
                <label for="id_film" class="form-label fw-bold">Pilih Film</label>
                <select name="id_film" id="id_film" class="form-select" required>
                    <option value="">-- Pilih Judul Film --</option>
                    @foreach ($films as $film)
                        <option value="{{ $film->id }}">{{ $film->judul }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Kategori --}}
            <div class="mb-4">
                <label for="kategori" class="form-label fw-bold">Kategori</label>
                <input type="text" name="kategori" id="kategori" class="form-control"
                    placeholder="Masukkan kategori highlight (misal: Trending, Terbaru, dll)">
            </div>

            {{-- Tombol Submit --}}
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('highlight.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
