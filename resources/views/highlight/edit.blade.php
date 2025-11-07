@extends('layouts.app')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg"
    style="background: linear-gradient(180deg, #F0E68C 0%, #D2B48C 100%);">

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-gradient-warning text-white">
                        <h5 class="mb-0">Edit Highlight</h5>
                    </div>
                    <div class="card-body p-4">

                        <form action="{{ route('highlight.update', $highlight->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Thumbnail -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Thumbnail Saat Ini</label><br>
                                @if($highlight->thumbnail)
                                    <img src="{{ asset('storage/thumbnails/' . $highlight->thumbnail) }}" width="150" class="rounded mb-2">
                                @else
                                    <p class="text-muted">Belum ada thumbnail</p>
                                @endif
                                <input type="file" name="thumbnail" class="form-control mt-2">
                            </div>

                            <!-- Tagline -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tagline</label>
                                <input type="text" name="tagline" class="form-control" value="{{ old('tagline', $highlight->tagline) }}" required>
                            </div>

                            <!-- Pilih Film -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Pilih Film</label>
                                <select name="id_film" class="form-select" required>
                                    <option value="">-- Pilih Film --</option>
                                    @foreach ($films as $film)
                                        <option value="{{ $film->id }}" {{ $highlight->id_film == $film->id ? 'selected' : '' }}>
                                            {{ $film->judul }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Kategori -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Kategori</label>
                                <input type="text" name="kategori" class="form-control" value="{{ old('kategori', $highlight->kategori) }}" required>
                            </div>

                            <!-- Tombol -->
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('highlight.index') }}" class="btn btn-secondary me-2">Kembali</a>
                                <button type="submit" class="btn btn-warning text-white fw-bold">Update Highlight</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
