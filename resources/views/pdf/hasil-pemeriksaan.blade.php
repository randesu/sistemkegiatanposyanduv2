<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hasil Pemeriksaan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h1 { font-size: 18px; margin-bottom: 10px; }
        .section { margin-bottom: 8px; }
        .label { font-weight: bold; width: 150px; display: inline-block; }
    </style>
</head>
<body>
    <h1>Hasil Pemeriksaan</h1>

    <div class="section">
        <span class="label">Balita:</span>
        {{ $hasil->balita->nama ?? '-' }}
    </div>

    <div class="section">
        <span class="label">Petugas:</span>
        {{ $hasil->petugas->name ?? '-' }}
    </div>

    <div class="section">
        <span class="label">Tinggi (cm):</span>
        {{ $hasil->tinggi }}
    </div>

    <div class="section">
        <span class="label">Berat (kg):</span>
        {{ $hasil->berat_badan }}
    </div>

    <div class="section">
        <span class="label">Vaksin:</span>
        {{ $hasil->vaksins->pluck('nama_vaksin')->join(', ') ?: '-' }}
    </div>

    <div class="section">
        <span class="label">Vitamin:</span>
        {{ $hasil->vitamins->pluck('nama_vitamin')->join(', ') ?: '-' }}
    </div>

    <div class="section">
        <span class="label">Catatan:</span>
        {{ $hasil->catatan ?: '-' }}
    </div>

    <div class="section">
        <span class="label">Tanggal Pemeriksaan:</span>
        {{ $hasil->created_at?->format('d-m-Y H:i') }}
    </div>
</body>
</html>
