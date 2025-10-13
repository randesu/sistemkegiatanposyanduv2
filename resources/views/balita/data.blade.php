<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Data Balita</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6a89cc; /* Biru lembut */
            --secondary-color: #8A9FC7; /* Biru lebih gelap untuk gradien */
            --accent-color: #f7a4a4; /* Merah muda lembut untuk highlight/grafik */
            --background-light: #f4f7f6;
            --card-background: #ffffff;
            --text-dark: #333;
            --text-muted: #666;
            --border-light: #e0e6ed;
            --border-radius-main: 15px;
            --shadow-light: 0 6px 25px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-light);
            color: var(--text-dark);
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Mengatur item ke atas, bukan tengah vertikal */
            min-height: 100vh;
            box-sizing: border-box; /* Pastikan padding tidak menambah lebar */
        }

        .dashboard-container {
            max-width: 800px; /* Ukuran yang lebih besar untuk dashboard */
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 20px; /* Jarak antar bagian dashboard */
            padding: 20px 0; /* Padding vertikal untuk keseluruhan container */
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 2.5rem;
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 5px;
        }

        .header p {
            color: var(--text-muted);
            font-size: 1.1rem;
        }

        .card {
            background: var(--card-background);
            border-radius: var(--border-radius-main);
            padding: 2.5rem; /* Padding yang lebih besar */
            box-shadow: var(--shadow-light);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
        }

        .card h2, .card h3 {
            color: var(--primary-color);
            margin-top: 0;
            margin-bottom: 1.5rem;
            font-weight: 600;
            border-bottom: 2px solid var(--border-light); /* Garis bawah untuk judul */
            padding-bottom: 10px;
        }

        .data-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 8px;
            border-bottom: 1px dashed var(--border-light); /* Garis putus-putus */
        }
        .data-item:last-of-type {
            border-bottom: none; /* Hilangkan garis pada item terakhir */
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .data-item strong {
            color: var(--text-dark);
            font-weight: 500;
        }

        .data-item span {
            color: var(--text-muted);
            font-weight: 400;
        }

        /* Styling Tabel */
        .table-container {
            overflow-x: auto; /* Agar tabel responsif pada layar kecil */
            margin-top: 1.5rem;
        }
        table {
            width: 100%;
            border-collapse: separate; /* Gunakan separate untuk border-radius */
            border-spacing: 0; /* Hilangkan spasi antar sel */
            margin-top: 1rem;
            border-radius: 10px; /* Border radius untuk tabel keseluruhan */
            overflow: hidden; /* Penting untuk border-radius */
        }

        th, td {
            text-align: left;
            padding: 12px 15px; /* Padding yang lebih baik */
            border-bottom: 1px solid var(--border-light);
            border-right: 1px solid var(--border-light);
        }

        th:last-child, td:last-child {
            border-right: none; /* Hilangkan border kanan pada kolom terakhir */
        }

        th {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color)); /* Gradien header */
            color: var(--text-light);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            position: sticky; /* Sticky header untuk scroll horizontal */
            top: 0;
            z-index: 2;
        }

        tr:nth-child(even) {
            background-color: #f9fbfd; /* Latar belakang baris genap */
        }

        tr:hover td {
            background-color: #eef2f7; /* Efek hover pada baris tabel */
            cursor: pointer;
        }

        /* Link Kembali */
        .back-link-container {
            text-align: center;
            margin-top: 30px;
        }
        .back-link {
            display: inline-flex; /* Agar bisa rata tengah dengan margin auto */
            align-items: center;
            padding: 10px 20px;
            background: var(--primary-color);
            color: var(--text-light);
            text-decoration: none;
            border-radius: 30px; /* Bentuk pil */
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .back-link svg {
            margin-right: 8px;
            transition: transform 0.3s ease;
        }

        .back-link:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .back-link:hover svg {
            transform: translateX(-3px);
        }

        /* Responsif */
        @media (max-width: 768px) {
            .dashboard-container {
                padding: 10px 0;
            }
            .header h1 {
                font-size: 2rem;
            }
            .header p {
                font-size: 1rem;
            }
            .card {
                padding: 1.8rem;
            }
            .card h2, .card h3 {
                font-size: 1.4rem;
                margin-bottom: 1rem;
            }
            th, td {
                padding: 10px 12px;
                font-size: 0.85rem;
            }
            .back-link {
                padding: 8px 15px;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }
            .dashboard-container {
                gap: 15px;
            }
            .header h1 {
                font-size: 1.8rem;
            }
            .header p {
                font-size: 0.9rem;
            }
            .card {
                padding: 1.5rem;
            }
            .card h2, .card h3 {
                font-size: 1.2rem;
                margin-bottom: 0.8rem;
                padding-bottom: 5px;
            }
            .data-item strong, .data-item span {
                font-size: 0.9rem;
            }
            th, td {
                padding: 8px 10px;
                font-size: 0.8rem;
            }
            .back-link {
                padding: 7px 12px;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="header">
            <h1>Halo, {{ $balita->nama }}!</h1>
            <p>Berikut adalah ringkasan data kesehatan Anda.</p>
        </div>

        <div class="card">
            <h2>Informasi Balita</h2>
            <div class="data-item">
                <strong>Nama Lengkap:</strong>
                <span>{{ $balita->nama }}</span>
            </div>
            <div class="data-item">
                <strong>NIK:</strong>
                <span>{{ $balita->nik }}</span>
            </div>
            <div class="data-item">
                <strong>Orang Tua/Wali:</strong>
                <span>{{ $balita->orang_tua }}</span>
            </div>
            <div class="data-item">
                <strong>Tanggal Lahir:</strong>
                <span>{{ $balita->tanggal_lahir ?? 'Belum ada data' }}</span>
            </div>
            <div class="data-item">
                <strong>Jenis Kelamin:</strong>
                <span>{{ $balita->jenis_kelamin ?? 'Belum ada data' }}</span>
            </div>
        </div>

       <div class="card">
            <h3>Riwayat Pemeriksaan</h3>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Tanggal Periksa</th>
                            <th>Usia (Bulan)</th>
                            <th>Berat (kg)</th>
                            <th>Tinggi (cm)</th>
                            <th>Vaksin Diberikan</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($balita->hasilPemeriksaans->isNotEmpty())
                            @foreach ($balita->hasilPemeriksaans->sortByDesc('created_at') as $pemeriksaan)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($pemeriksaan->created_at)->format('d M Y') }}</td>
                                    <td>
                                        {{-- Hitung usia dalam bulan. Asumsi $balita memiliki tanggal_lahir --}}
                                        @if ($balita->tanggal_lahir)
                                            {{ \Carbon\Carbon::parse($balita->tanggal_lahir)->diffInMonths($pemeriksaan->created_at) }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $pemeriksaan->berat_badan }}</td>
                                    <td>{{ $pemeriksaan->tinggi }}</td>
                                    <td>
                                        @if ($pemeriksaan->vaksins->isNotEmpty())
                                            @foreach ($pemeriksaan->vaksins as $vaksin)
                                                {{ $vaksin->nama_vaksin }} (Dosis {{ $vaksin->pivot->dosis ?? '?' }})<br>
                                            @endforeach
                                        @else
                                            Tidak ada
                                        @endif
                                    </td>
                                    <td>{{ $pemeriksaan->catatan ?? '-' }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" style="text-align: center; color: var(--text-muted);">Belum ada riwayat pemeriksaan untuk balita ini.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="back-link-container">
            <a href="{{ route('balita.form') }}" class="back-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5a.5.5 0 0 0 .5-.5z"/>
                </svg>
                Cek ID Lain
            </a>
        </div>
    </div>
</body>
</html>