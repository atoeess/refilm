@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Highlight Film</h5>
                <a href="{{ route('highlight.create') }}" class="btn btn-primary btn-sm">+ Tambah Highlight</a>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">
                                    Thumbnail</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Tagline
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Judul
                                    Film</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">
                                    Kategori</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($highlights as $highlight)
                                <tr>
                                    <td>
                                        @if ($highlight->thumbnail)
                                            <img src="{{ asset('storage/' . $highlight->thumbnail) }}" alt="thumbnail" width="100"
                                                class="rounded">
                                        @else
                                            <span class="text-muted">Tidak ada thumbnail</span>
                                        @endif
                                    </td>

                                    <td>{{ $highlight->tagline ?? '-' }}</td>
                                    <td>{{ $highlight->film ? $highlight->film->judul : 'Film tidak ditemukan' }}</td>
                                    <td>{{ $highlight->kategori ?? '-' }}</td>

                                    <td class="text-center">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('highlight.edit', ['id' => $highlight->id ]) }}"
                                            class="btn btn-warning">Edit</a>


                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('highlight.destroy', ['id' => $highlight->id]) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus highlight ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">
                                        Belum ada data highlight.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
