@extends('layouts.app')

@section('content')
<main class="main-content" style="min-height: 100vh; padding-top: 20px; background: #ececec;">

    <nav style="display: flex; margin: 20px; justify-content: space-between; padding: 10px 20px; background: #fff; border-radius: 8px;">
        <h6 style="margin: 0; font-weight: bold;">Tahun</h6>
    </nav>

    <div style="padding: 0 20px;">
        <div style="background: #fff; border-radius: 12px; padding: 20px;">

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h6 style="text-transform: uppercase; color: #888;">Tabel Tahun</h6>
                <a href="{{ route('tahun.create') }}" style="background: #333; color: #fff; padding: 10px 25px; border-radius: 8px;">
                    + Tambah Tahun
                </a>
            </div>

            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f5f5f5;">
                        <th style="padding: 10px;">Tahun</th>
                        <th style="padding: 10px; text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tahuns as $tahun)
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td style="padding: 10px;">{{ $tahun->tahun }}</td>
                        <td style="padding: 10px; text-align: center;">
                            <a href="{{ route('tahun.edit', $tahun->id) }}"
                                style="background: #f0ad4e; color: #fff; padding: 6px 12px; border-radius: 8px;">
                                Edit
                            </a>

                            <form action="{{ route('tahun.destroy', $tahun->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus tahun ini?')" style="background: #d9534f; color:#fff; padding:6px 12px; border-radius:8px;">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" style="text-align: center; padding: 20px;">Belum ada data tahun.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</main>
@endsection
