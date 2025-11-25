@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">
    Komentar untuk: {{ $film->judul }}
</h2>

<table class="table-auto w-full bg-white rounded shadow">
    <thead class="bg-gray-200">
        <tr>
            <th class="px-4 py-2">User</th>
            <th class="px-4 py-2">Komentar</th>
            <th class="px-4 py-2 text-center">Tanggal</th>
        </tr>
    </thead>
    <tbody>

        @if ($komentars->isEmpty())
            <tr>
                <td colspan="3" class="text-center py-4 text-gray-500">
                    Belum ada komentar
                </td>
            </tr>
        @endif

        @foreach ($komentars as $komentar)
            <tr class="border-b">
                <td class="px-4 py-3">{{ $komentar->user->name ?? 'User Deleted' }}</td>
                <td class="px-4 py-3">{{ $komentar->komentar }}</td>
                <td class="px-4 py-3 text-center">{{ $komentar->created_at->format('d M Y H:i') }}</td>
            </tr>
        @endforeach

    </tbody>
</table>

<a href="{{ route('komentar.index') }}"
   class="inline-block mt-4 px-4 py-2 bg-gray-600 text-white rounded">
   Kembali
</a>

@endsection
