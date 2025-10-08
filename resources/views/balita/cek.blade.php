<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Data Balita</title>
    <style>
        body { display:flex; align-items:center; justify-content:center; height:100vh; font-family:sans-serif; background:#f5f5f5; }
        form { background:white; padding:2rem; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.1); }
        input, button { width:100%; padding:10px; margin-top:10px; }
        button { background:#007bff; color:white; border:none; border-radius:5px; cursor:pointer; }
        button:hover { background:#0056b3; }
    </style>
</head>
<body>
    <form action="{{ route('balita.data') }}" method="POST">
        @csrf
        <h2>Cek Data Balita</h2>
        <input type="number" name="balita_id" placeholder="Masukkan ID Balita" required>
        @error('balita_id')
            <p style="color:red">{{ $message }}</p>
        @enderror
        <button type="submit">Lihat Data</button>
    </form>
</body>
</html>
