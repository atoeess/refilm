@extends('layouts.app')

@section('content')
<div style="max-width: 700px; margin: 50px auto; padding: 20px; background: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); font-family: sans-serif;">

    <h2 style="margin-bottom: 30px; font-weight: bold; color: #333;">Tambah Highlight Baru</h2>

    {{-- Notifikasi sukses / error --}}
    @if (session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('highlight.store') }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 20px;">
        @csrf

        {{-- Thumbnail --}}
        <div style="display: flex; flex-direction: column;">
            <label for="thumbnail" style="font-weight: bold; margin-bottom: 6px;">Thumbnail</label>
            <input type="file" name="thumbnail" id="thumbnail" accept="image/*" required
                style="padding: 10px; border-radius: 8px; border: 1px solid #ccc;">
        </div>

        {{-- Tagline --}}
        <div style="display: flex; flex-direction: column;">
            <label for="tagline" style="font-weight: bold; margin-bottom: 6px;">Tagline</label>
            <input type="text" name="tagline" id="tagline" placeholder="Masukkan tagline highlight"
                style="padding: 10px; border-radius: 8px; border: 1px solid #ccc;">
        </div>

        {{-- Pilih Film --}}
        <div style="display: flex; flex-direction: column;">
            <label for="id_film" style="font-weight: bold; margin-bottom: 6px;">Pilih Film</label>
            <select name="id_film" id="id_film" required
                style="padding: 10px; border-radius: 8px; border: 1px solid #ccc;">
                <option value=""> Pilih Judul Film </option>
                @foreach ($films as $film)
                    <option value="{{ $film->id }}">{{ $film->judul }}</option>
                @endforeach
            </select>
        </div>

        {{-- Kategori --}}
        <div style="display: flex; flex-direction: column;">
            <label for="kategori" style="font-weight: bold; margin-bottom: 6px;">Kategori</label>
            <input type="text" name="kategori" id="kategori" placeholder="Masukkan kategori highlight (misal: Trending, Terbaru, dll)"
                style="padding: 10px; border-radius: 8px; border: 1px solid #ccc;">
        </div>

        {{-- Tombol --}}
        <div style="display: flex; gap: 15px;">
            <button type="submit" style="flex: 1; padding: 12px; background-color: #4a90e2; color: #fff; border: none; border-radius: 8px; font-weight: bold; cursor: pointer;">
                Simpan
            </button>
            <a href="{{ route('highlight.index') }}" style="flex: 1; padding: 12px; background-color: #aaa; color: #fff; text-align: center; text-decoration: none; border-radius: 8px; font-weight: bold;">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection
