@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="row">
    <div class="col-md-5">
      <img src="{{ asset('storage/fotos/' . $film->foto) }}" class="img-fluid rounded" alt="{{ $film->judul }}">
    </div>
    <div class="col-md-7">
      <h2>{{ $film->judul }}</h2>
      <p><strong>Genre:</strong> {{ $film->genre->nama_genre ?? '-' }}</p>
      <p><strong>Tahun:</strong> {{ $film->tahun }}</p>
      <p><strong>Negara:</strong> {{ $film->negara }}</p>
      <p>{{ $film->sinopsis }}</p>
    </div>
  </div>
</div>
@endsection
