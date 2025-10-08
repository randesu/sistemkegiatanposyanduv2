<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Balita</title>
    <style>
        body { font-family: sans-serif; background: #f8fafc; padding: 2rem; }
        .card { background: white; border-radius: 10px; padding: 1.5rem; max-width: 600px; margin: 0 auto; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h2 { margin-bottom: 1rem; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background: #007bff; color: white; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Data Balita</h2>
        <p><strong>Nama:</strong> {{ $balita->nama }}</p>
        <p><strong>NIK:</strong> {{ $balita->nik }}</p>
        <p><strong>Orang Tua:</strong> {{ $balita->orang_tua }}</p>

        <h3>Riwayat Pemeriksaan</h3>
        

        <a href="{{ route('balita.form') }}">← Cek ID Lain</a>
    </div>
</body>
</html>
