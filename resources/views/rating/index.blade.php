@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Daftar Rating Film</h2>

    <table class="table-auto w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Judul Film</th>
                <th class="px-6 py-2 text-center">Jumlah Rating</th>
                <th class="px-4 py-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($films as $film)
                <tr class="border-b">
                    <td class="px-4 py-3">{{ $film->judul }}</td>
                    <td class="px-4 py-4 text-center">{{ $film->ratings_count }}</td>
                    <td class=" text-center">
                        <a href="{{ route('rating.show', $film->id) }}"
                            class="inline-flex items-center justify-center text-gray-500 hover:text-gray-800 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            </a>


                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
