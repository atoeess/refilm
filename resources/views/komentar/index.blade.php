@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">Daftar Komentar Film</h2>

<table class="table-auto w-full bg-white rounded shadow">
    <thead class="bg-gray-200">
        <tr>
            <th class="px-4 py-2">Judul Film</th>
            <th class="px-4 py-2 text-center">Total Komentar</th>
            <th class="px-4 py-2 text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($films as $film)
            <tr class="border-b">
                <td class="px-4 py-3">{{ $film->judul }}</td>
                <td class="px-4 py-3 text-center">{{ $film->komentars_count }}</td>
                <td class="px-4 py-3 text-center">
                    <a href="{{ route('komentar.show', $film->id) }}" class="text-blue-500">
                        <!-- ICON MATA -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor"
                             class="w-6 h-6 mx-auto stroke-gray-600">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7C20.268 16.057 16.477 19 12 19S3.732 16.057 2.458 12z" />
                            <circle cx="12" cy="12" r="3" stroke-width="2" />
                        </svg>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
