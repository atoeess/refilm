@extends('layouts.app')

@section('content')
<main style="min-height: 100vh; padding: 40px 20px; background: linear-gradient(180deg, #F0E68C 0%, #D2B48C 100%); font-family: sans-serif;">

    <div style="max-width: 700px; margin: 0 auto; background: #fff; border-radius: 12px; box-shadow: 0 6px 20px rgba(0,0,0,0.1); overflow: hidden;">

        <!-- Header -->
        <div style="background: linear-gradient(90deg, #f6c23e, #f0b90a); color: #fff; padding: 15px 20px;">
            <h5 style="margin: 0; font-weight: bold;">Edit Highlight</h5>
        </div>

        <!-- Body -->
        <div style="padding: 25px;">
            <form action="{{ route('highlight.update', $highlight->id) }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 20px;">
                @csrf
                @method('PUT')

                <!-- Thumbnail -->
                <div style="display: flex; flex-direction: column;">
                    <label style="font-weight: bold; margin-bottom: 6px;">Thumbnail Saat Ini</label>
                    @if($highlight->thumbnail && file_exists(storage_path('app/public/' . $highlight->thumbnail)))
                        <img src="{{ asset('storage/' . $highlight->thumbnail) }}" width="150" style="border-radius: 8px; margin-bottom: 10px;">
                    @else
                        <p style="color: #777; margin-bottom: 10px;">Belum ada thumbnail</p>
                    @endif
                    <input type="file" name="thumbnail" style="padding: 10px; border-radius: 8px; border: 1px solid #ccc;">
                </div>

                <!-- Tagline -->
                <div style="display: flex; flex-direction: column;">
                    <label style="font-weight: bold; margin-bottom: 6px;">Tagline</label>
                    <input type="text" name="tagline" value="{{ old('tagline', $highlight->tagline) }}" required
                        style="padding: 10px; border-radius: 8px; border: 1px solid #ccc;">
                </div>

                <!-- Pilih Film -->
                <div style="display: flex; flex-direction: column;">
                    <label style="font-weight: bold; margin-bottom: 6px;">Pilih Film</label>
                    <select name="id_film" required style="padding: 10px; border-radius: 8px; border: 1px solid #ccc;">
                        <option value="">-- Pilih Film --</option>
                        @foreach ($films as $film)
                            <option value="{{ $film->id }}" {{ $highlight->id_film == $film->id ? 'selected' : '' }}>
                                {{ $film->judul }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Kategori -->
                <div style="display: flex; flex-direction: column;">
                    <label style="font-weight: bold; margin-bottom: 6px;">Kategori</label>
                    <input type="text" name="kategori" value="{{ old('kategori', $highlight->kategori) }}" required
                        style="padding: 10px; border-radius: 8px; border: 1px solid #ccc;">
                </div>

                <!-- Tombol -->
                <div style="display: flex; justify-content: flex-end; gap: 10px;">
                    <a href="{{ route('highlight.index') }}" style="padding: 10px 20px; background: #aaa; color: #fff; text-decoration: none; border-radius: 8px; font-weight: bold;">Kembali</a>
                    <button type="submit" style="padding: 10px 20px; background: #f6c23e; color: #fff; border: none; border-radius: 8px; font-weight: bold; cursor: pointer;">Update Highlight</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
