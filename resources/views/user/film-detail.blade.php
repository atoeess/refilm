@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('storage/fotos/' . $film->foto) }}" class="img-fluid rounded" alt="{{ $film->judul }}">
            </div>
            <div class="col-md-8">
                <h2>{{ $film->judul }}</h2>
                <p>{{ $film->deskripsi }}</p>
                <p> <strong>Tahun:</strong>
                    @foreach ($film->genres as $genre)
                        <span>{{ $genre->nama_genre }},</span>
                    @endforeach
                </p>

                <p><strong>Tahun:</strong> {{ $film->tahun }}</p>
                <p><strong>Negara:</strong> {{ $film->negara->nama_negara }}</p>
                <p>{{ $film->sinopsis }}</p>
                <a href="{{ $film->trailer }}" target="_blank" class="btn btn-primary">Tonton Trailer</a>
            </div>
        </div>
    </div>
@endsection
