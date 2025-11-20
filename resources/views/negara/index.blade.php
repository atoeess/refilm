@extends('layouts.app')

@section('content')
<main class="main-content" style="min-height: 100vh; padding-top: 20px; background: linear-gradient(180deg, #F0E68C 0%, #D2B48C 100%); font-family: sans-serif;">

    <!-- Navbar -->
    <nav style="display: flex; margin-left: 20px; margin-right: 20px; justify-content: space-between; align-items: center; padding: 10px 20px; background: rgba(255,255,255,0.8); border-radius: 8px; margin-bottom: 20px;">
        <div>
            <h6 style="margin: 0; font-weight: bold;">Negara</h6>
        </div>
    </nav>

    <div style="padding: 0 20px;">
        <div style="background: #fff; border-radius: 12px; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">

            <!-- Header -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h6 style="text-transform: uppercase; color: #888;">Country Table</h6>
                <a href="{{ route('negara.create') }}" style="background: #333; color: #fff; padding: 10px 25px; font-weight: bold; border-radius: 8px; text-decoration: none;">
                    + Tambah Negara
                </a>
            </div>

            <!-- Table -->
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #f5f5f5; text-align: left;">
                            <th style="padding: 10px;">Nama Negara</th>
                            <th style="padding: 10px; text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($negaras as $negara)
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td style="padding: 10px;">{{ $negara->nama_negara }}</td>
                            <td style="padding: 10px; text-align: center;">
                                <a href="{{ route('negara.edit', $negara->id) }}"
                                    style="background: #f0ad4e; color: #fff; padding: 6px 12px; border-radius: 8px; text-decoration: none; font-weight: 600; margin-right: 5px;">
                                    Edit
                                </a>
                                <form action="{{ route('negara.destroy', $negara->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="background: #d9534f; color: #fff; padding: 6px 12px; border-radius: 8px; font-weight: 600; border: none; cursor: pointer;"
                                        onclick="return confirm('Yakin ingin menghapus negara ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" style="text-align: center; color: #999; padding: 20px;">
                                Belum ada data negara.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer style="text-align: center; padding: 20px; color: #555;">© {{ date('Y') }}</footer>
</main>
@endsection
