@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">
    Rating untuk: {{ $film->judul }}
</h2>

<table class="table-auto w-full bg-white rounded shadow">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2">User</th>
            <th class="px-4 py-2 text-center">Rating</th>
            <th class="px-4 py-2 text-center">Tanggal</th>
        </tr>
    </thead>
    <tbody>
         @if ($ratings->isEmpty())
            <tr>
                <td colspan="3" class="text-center py-4 text-gray-500">
                    Belum ada rating
                </td>
            </tr>
        @endif

        @foreach ($ratings as $rating)
            <tr class="border-b">
                <td class="px-4 py-3">{{ $rating->user->name ?? 'User Deleted' }}</td>
                <td class="px-4 py-3 text-center">{{ $rating->nilai_rating }}</td>
                <td class="px-4 py-3 text-center">{{ $rating->created_at->format('d M Y H:i') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('rating.index') }}"
   class="inline-block mt-4 px-4 py-2 bg-gray-600 text-white rounded">
   Kembali
</a>

@endsection
