<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('product.store') }}" method="post">
        @csrf

        <label for="nama">Nama Produk</label>
        <br>
        <input id="nama" name="nama" type="text">

        <br><br>

        <label for="nama">Deskripsi</label>
        <br>
        <textarea name="deskripsi" id="" cols="30" rows="10"></textarea>

        <br><br>
        <label for="nama_pelanggan">Nama Pelanggan</label>
        <br>
        <input name="nama_pelanggan" id="nama_pelanggan"></input>

        <br><br>
        <label for="alamat">Alamat</label>
        <br>
        <textarea name="alamat" id="alamat" cols="30" rows="10"></textarea>

        <br><br>
        <label for="email">Email</label>
        <br>
        <input type="email" name="email" id="email"></input>

        <br>
        <button type="submit">Submit</button>
    </form>
</body>

</html>
