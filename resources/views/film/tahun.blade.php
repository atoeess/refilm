@extends('layouts.user')

@section('content')
<main class="p-6">

    <h1 class="text-xl text-white font-bold mb-6">
        Tahun: {{ $tahun }}
    </h1>

    @include('film.partials.dropdown')  {{-- dropdown genre, negara, tahun --}}

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-5 mt-6">
        @foreach($films as $film)
            <a href="{{ route('film.detail', $film->slug) }}" class="block">
                <img src="/storage/fotos/{{ $film->foto }}" class="w-full h-48 object-cover rounded-lg">
                <p class="text-white mt-2 text-sm">{{ $film->judul }}</p>
            </a>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $films->links() }}
    </div>

</main>
@endsection
