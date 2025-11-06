<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Data Product</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <a href="{{ route('product.create') }}">Tambah Product</a>

    <table style="border: 1px solid black;">
        <thead>
            <tr>
                <th style="border: 1px solid black;">Nama</th>
                <th style="border: 1px solid black;">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td style="border: 1px solid black;">{{ $product->nama }}</td>
                    <td style="border: 1px solid black;">{{ $product->deskripsi }}</td>
                </tr>
            @empty
                <tr>
                    <td style="border: 1px solid black;" colspan="2">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h1>Data Pelanggan</h1>
    <table style="border: 1px solid black;">
        <thead>
            <tr>
                <th style="border: 1px solid black;">Nama Pelanggan</th>
                <th style="border: 1px solid black;">Alamat</th>
                <th style="border: 1px solid black;">Email</th>
                <th style="border: 1px solid black;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pelanggans as $pelanggan)
                <tr>
                    <td style="border: 1px solid black;">{{ $pelanggan->nama_pelanggan }}</td>
                    <td style="border: 1px solid black;">{{ $pelanggan->alamat }}</td>
                    <td style="border: 1px solid black;">{{ $pelanggan->user->email }}</td>
                    <td style="border: 1px solid black;">
                        <a href="{{ route('product.edit', $pelanggan->id) }}">
                            Edit
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td style="border: 1px solid black;" colspan="2">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
