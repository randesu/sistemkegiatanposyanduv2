{{-- resources/views/balita/detail.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Balita - {{ $balita->nama ?? 'Balita' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Menggunakan variabel warna dari tema dashboard utama */
        :root {
            --primary-color: #6a89cc; /* Biru lembut */
            --secondary-color: #8A9FC7; /* Biru lebih gelap untuk gradien */
            --background-light: #f4f7f6; /* Latar belakang body */
            --card-background: #ffffff; /* Latar belakang kartu dan mobile frame */
            --text-dark: #333;
            --text-muted: #666;
            --text-light: #fff;
            --border-radius-main: 25px; /* Radius untuk keseluruhan layout */
            --border-radius-card: 18px; /* Radius untuk kartu individu */
            --shadow-light: 0 8px 30px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 12px 40px rgba(0, 0, 0, 0.12);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-light);
            color: var(--text-dark);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Mengatur item ke atas */
            min-height: 100vh;
            box-sizing: border-box;
            overflow-y: auto; /* Izinkan scroll pada body */
            position: relative;
        }

        /* Latar belakang abstrak (sama seperti riwayat pemeriksaan) */
        body::before {
            content: '';
            position: absolute;
            top: -10%;
            left: -10%;
            width: 50%;
            height: 50%;
            background: radial-gradient(circle at 10% 20%, rgba(106, 137, 204, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            z-index: 0;
        }
        body::after {
            content: '';
            position: absolute;
            bottom: -10%;
            right: -10%;
            width: 40%;
            height: 40%;
            background: radial-gradient(circle at 90% 80%, rgba(164, 176, 190, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            z-index: 0;
        }

        .mobile-frame {
            background-color: var(--card-background); /* Latar belakang frame sama dengan kartu */
            border-radius: var(--border-radius-main);
            box-shadow: var(--shadow-light);
            width: 100%;
            max-width: 375px;
            height: 812px;
            overflow-y: auto;
            overflow-x: hidden;
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
        }

        /* Menggunakan kelas header-section dari riwayat pemeriksaan */
        .header-section {
            padding: 25px;
            padding-top: 40px; /* Padding atas lebih besar */
            background: linear-gradient(135deg, #e0e9f8, #f0f4fa); /* Gradien untuk header */
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .header-section .back-button {
            background: none;
            border: none;
            color: var(--primary-color);
            font-size: 1.5rem;
            cursor: pointer;
            margin-right: 15px;
            padding: 0;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: transform 0.2s ease;
        }
        .header-section .back-button:hover {
            transform: translateX(-5px);
        }

        .header-section h3 { /* Menggunakan h3 seperti di riwayat pemeriksaan */
            font-size: 1.8rem;
            color: var(--text-dark);
            margin: 0;
            font-weight: 700;
        }

        .content-area {
            flex-grow: 1;
            padding: 20px 25px; /* Padding di sekitar konten */
            padding-bottom: 80px; /* Ruang untuk bottom nav atau tombol kembali */
        }

        /* Styling untuk quick-info-card */
        .quick-info-card {
            background: var(--card-background); /* Menggunakan card-background */
            border-radius: var(--border-radius-card);
            margin-bottom: 20px;
            padding: 20px 25px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .quick-info-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 500;
        }

        .quick-info-item strong {
            display: block;
            color: var(--text-dark);
            font-size: 1.1rem;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .quick-info-item .icon {
            width: 30px;
            height: 30px;
            margin-bottom: 8px;
            color: var(--primary-color);
        }
        .quick-info-item .icon svg {
            width: 100%;
            height: 100%;
        }

        /* Styling untuk info tambahan yang lebih detail (detail-section) */
        .detail-section {
            background: var(--card-background); /* Menggunakan card-background */
            border-radius: var(--border-radius-card);
            padding: 20px 25px;
            margin-bottom: 20px;
            box-shadow: var(--shadow-light);
        }

        .detail-section h3 {
            font-size: 1.1rem;
            color: var(--primary-color);
            margin-top: 0;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px dashed #f0f0f0;
        }
        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-item .label {
            color: var(--text-muted);
            font-size: 0.9rem;
            font-weight: 400;
        }

        .detail-item .value {
            color: var(--text-dark);
            font-weight: 500;
            text-align: right;
            font-size: 0.95rem;
        }

        /* Tombol kembali ke dashboard (sama seperti riwayat pemeriksaan) */
        .bottom-action-area {
            padding: 20px 25px;
            text-align: center;
            background: var(--card-background);
            border-top: 1px solid #eee;
            box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.05);
            position: sticky;
            bottom: 0;
            z-index: 10;
        }

        .back-to-dashboard-btn {
            display: inline-flex;
            align-items: center;
            padding: 12px 25px;
            background: var(--primary-color);
            color: var(--text-light);
            text-decoration: none;
            border-radius: 30px;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .back-to-dashboard-btn svg {
            margin-right: 8px;
            transition: transform 0.3s ease;
        }

        .back-to-dashboard-btn:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .back-to-dashboard-btn:hover svg {
            transform: translateX(-3px);
        }

        /* Responsif (sama seperti riwayat pemeriksaan) */
        @media (max-width: 400px) {
            .mobile-frame {
                max-width: 100%;
                border-radius: 0;
            }
            .header-section {
                padding: 20px;
                padding-top: 30px;
            }
            .header-section h3 {
                font-size: 1.5rem;
            }
            .content-area {
                padding: 15px;
                padding-bottom: 70px;
            }
            .quick-info-card, .detail-section {
                padding: 15px 20px;
            }
            .detail-item .label, .detail-item .value {
                font-size: 0.85rem;
            }
            .bottom-action-area {
                padding: 15px;
            }
            .back-to-dashboard-btn {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="mobile-frame">
        <div class="header-section">
            {{-- Form untuk tombol kembali ke dashboard --}}
            <form action="{{ route('balita.dashboard') }}" method="POST" style="display:inline;">
                @csrf
                <input type="hidden" name="nik" value="{{ $balita->nik }}">
                <button type="submit" class="back-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </button>
            </form>
            <h3>Detail Balita</h3> {{-- Judul halaman --}}
        </div>

        <div class="content-area">
            {{-- QUICK INFO CARD --}}
            <div class="quick-info-card">
                <div class="quick-info-item">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.042 22.166v-1.47a3.75 3.75 0 00-3.75-3.75H9.25a3.75 3.75 0 00-3.75 3.75v1.47M19.5 12.75a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z" />
                        </svg>
                    </span>
                    <strong>{{ $balita->jenis_kelamin ?? '?' }}</strong>
                    <span>Jenis Kelamin</span>
                </div>
                <div class="quick-info-item">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </span>
                    <strong>{{ $balita->nik ?? '?' }}</strong>
                    <span>NIK</span>
                </div>
                <div class="quick-info-item">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5m18 7.5v-7.5" />
                        </svg>
                    </span>
                    <strong>{{ $balita->tanggal_lahir ? \Carbon\Carbon::parse($balita->tanggal_lahir)->translatedFormat('d F Y') : '?' }}</strong>
                    <span>Tgl Lahir</span>
                </div>
                <div class="quick-info-item">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5V19.5M12 4.5l6 6M12 4.5l-6 6" />
                        </svg>
                    </span>
                    <strong>{{ $balita->hasilPemeriksaans->isNotEmpty() ? $balita->hasilPemeriksaans->sortByDesc('created_at')->first()->berat_badan . ' kg' : '?' }}</strong>
                    <span>Berat Terakhir</span>
                </div>
            </div>

            {{-- SEKSI INFO LEBIH DETAIL --}}
            <div class="detail-section">
                <h3>Informasi Pribadi</h3>
                <div class="detail-item">
                    <span class="label">Nama Lengkap</span>
                    <span class="value">{{ $balita->nama ?? '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="label">Nama Orang Tua</span>
                    <span class="value">{{ $balita->orang_tua ?? '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="label">Tempat lahir</span>
                    <span class="value">{{ $balita->tempat_lahir ?? '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="label">Tanggal lahir</span>
                    <span class="value">{{ $balita->tanggal_lahir ? \Carbon\Carbon::parse($balita->tanggal_lahir)->translatedFormat('d F Y') : '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="label">Alamat</span>
                    <span class="value">{{ $balita->alamat ?? '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="label">Jenis Kelamin</span>
                    <span class="value">{{ $balita->jenis_kelamin ?? '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="label">Umur</span>
                    <span class="value">{{ $balita->tanggal_lahir ? \Carbon\Carbon::parse($balita->tanggal_lahir)->age . ' tahun' : '?' }}</span>
                </div>
            </div>
            {{-- Anda bisa menambahkan seksi detail lain di sini, misalnya riwayat vaksinasi singkat --}}
        </div>

        <!-- <div class="bottom-action-area">
            <a href="{{ route('balita.dashboard', ['nik' => $balita->nik]) }}" class="back-to-dashboard-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5a.5.5 0 0 0 .5-.5z"/>
                </svg>
                Kembali ke Dashboard
            </a>
        </div> -->
    </div>
</body>
</html>