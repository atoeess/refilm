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

    <form action="{{ route('product.update', $pelanggan->id) }}" method="post">
        @csrf
        @method('PUT')

        <br><br>
        <label for="nama_pelanggan">Nama Pelanggan</label>
        <br>
        <input name="nama_pelanggan" id="nama_pelanggan" value="{{ $pelanggan->nama_pelanggan }}" />

        <br><br>
        <label for="alamat">Alamat</label>
        <br>
        <textarea name="alamat" id="alamat" cols="30" rows="10">{{ $pelanggan->alamat }}</textarea>

        <br><br>
        <label for="email">Email</label>
        <br>
        <select name="user_id" id="email">
            @forelse ($users as $user)
                <option value="{{ $user->id }}" {{ $user->id == $pelanggan->user_id ? 'selected' : '' }}>
                    {{ $user->email }}</option>
            @empty
            @endforelse
        </select>

        <br>
        <button type="submit">Submit</button>
    </form>
</body>

</html>
