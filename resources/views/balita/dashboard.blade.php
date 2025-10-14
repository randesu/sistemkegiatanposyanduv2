<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Balita</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6a89cc; /* Biru lembut */
            --secondary-color: #8A9FC7; /* Biru lebih gelap untuk gradien */
            --card-bg-1: #dbe4f3; /* Warna kartu 1 (biru muda) */
            --card-bg-2: #c4b6e7; /* Warna kartu 2 (ungu muda) */
            --card-bg-3: #e6e6e6; /* Warna kartu 3 (abu-abu terang) */
            --card-bg-4: #f7d7ca; /* Warna kartu 4 (peach) */
            --background-light: #f4f7f6; /* Latar belakang body */
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
            align-items: center;
            min-height: 100vh;
            box-sizing: border-box;
            overflow: hidden; /* Mengunci scroll body */
            position: relative;
        }

        /* Latar belakang abstrak (sama seperti sebelumnya, disesuaikan) */
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
            background-color: var(--card-background); /* Menggunakan warna card untuk frame */
            border-radius: var(--border-radius-main);
            box-shadow: var(--shadow-light);
            width: 100%;
            max-width: 375px; /* Ukuran umum layar ponsel */
            height: 812px; /* Tinggi umum layar ponsel */
            overflow-y: auto; /* Memungkinkan scroll di dalam frame */
            overflow-x: hidden;
            position: relative;
            z-index: 1; /* Agar di atas latar belakang abstrak */
            display: flex;
            flex-direction: column;
            /* Hapus padding-bottom: 70px; karena bottom-nav sekarang sticky di dalam */
        }

        /* Konten utama yang bisa discroll */
        .scrollable-content {
            flex-grow: 1; /* Memastikan konten mengisi sisa ruang */
            padding-bottom: 70px; /* Tambahkan padding agar konten tidak tertutup bottom-nav */
        }

        /* ----- Header Profil ----- */
        .profile-header {
            padding: 25px;
            padding-top: 40px; /* Padding atas lebih besar */
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(135deg, #e0e9f8, #f0f4fa); /* Gradien untuk header */
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .profile-info {
            flex-grow: 1;
        }

        .profile-info .date {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 5px;
        }

        .profile-info h1 {
            font-size: 2.2rem;
            color: var(--text-dark);
            margin: 0;
            font-weight: 700;
        }

        .profile-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    overflow: hidden; /* Penting agar bagian gambar yang terpotong tidak terlihat */
    /* margin-left: 20px; */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border: 3px solid var(--text-light);
}

.profile-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* <--- Tambahkan atau pastikan ini ada */
    display: block; /* Opsional: Menghilangkan sedikit spasi di bawah gambar */
}

        /* ----- Info Balita Cepat ----- */
        .quick-info-card {
            background: var(--text-light);
            border-radius: var(--border-radius-card);
            margin: 0 25px 20px 25px; /* Margin horizontal konsisten */
            padding: 20px 25px;
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* 2 kolom */
            gap: 15px 10px; /* Jarak antar item */
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
            color: var(--primary-color); /* Warna ikon */
        }
        /* Menggunakan SVG dari Heroicons atau ikon library lain */
        .quick-info-item .icon svg {
            width: 100%;
            height: 100%;
        }

        /* ----- Menu Kartu ----- */
        .menu-grid {
            display: grid;
            grid-template-columns: 1fr 1fr; /* 2 kolom */
            gap: 15px;
            padding: 0 25px; /* Padding horizontal konsisten */
            margin-bottom: 25px;
        }

        .menu-card {
            background-color: var(--card-bg-1); /* Default background */
            border-radius: var(--border-radius-card);
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            min-height: 120px; /* Tinggi minimum kartu */
            text-decoration: none;
            color: var(--text-dark);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .menu-card .icon {
            width: 45px;
            height: 45px;
            margin-bottom: 15px;
            color: var(--text-light); /* Ikon putih default */
        }
        .menu-card .icon svg {
            width: 100%;
            height: 100%;
        }

        .menu-card span {
            font-weight: 500;
            font-size: 0.95rem;
            color: var(--text-dark);
        }

        /* Warna spesifik untuk kartu menu */
        .menu-card.medical-record { background-color: var(--card-bg-1); }
        .menu-card.medical-record .icon { color: var(--primary-color); } /* Ubah warna ikon menjadi primary */

        .menu-card.scheduled-visits { background-color: var(--card-bg-2); }
        .menu-card.scheduled-visits .icon { color: var(--text-light); } /* Ikon putih */

        .menu-card.detailed-info { background-color: var(--card-bg-3); }
        .menu-card.detailed-info .icon { color: var(--text-dark); } /* Ikon hitam */

        .menu-card.vaccination-schedule { background-color: var(--card-bg-4); }
        .menu-card.vaccination-schedule .icon { color: var(--text-dark); } /* Ikon hitam */


        /* ----- Bottom Navigation (Updated) ----- */
        .bottom-nav {
            position: sticky; /* Kunci perubahan utama */
            bottom: 0;
            width: 100%;
            background: var(--text-light);
            border-top: 1px solid #eee;
            box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            z-index: 10;
            flex-shrink: 0; /* Mencegah shrink ketika konten lain flex-grow */
            margin-top: auto; /* Pastikan menempel di bagian bawah flex container */
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--text-muted);
            font-size: 0.75rem;
            font-weight: 500;
            padding: 5px;
            transition: color 0.2s ease;
        }

        .nav-item .icon {
            width: 24px;
            height: 24px;
            margin-bottom: 4px;
        }

        .nav-item .icon svg {
            width: 100%;
            height: 100%;
        }

        .nav-item.active {
            color: var(--primary-color);
        }

        /* Responsif untuk tinggi frame mobile */
        @media (max-height: 850px) {
            .mobile-frame {
                height: 90vh; /* Sesuaikan tinggi agar tidak terpotong */
            }
        }
        @media (max-height: 700px) {
            .mobile-frame {
                height: 95vh;
            }
        }

        /* Responsif untuk lebar layar */
        @media (max-width: 400px) {
            .mobile-frame {
                max-width: 100%; /* Mengisi penuh lebar */
                border-radius: 0; /* Tanpa radius jika mengisi penuh */
            }
            .profile-header {
                padding: 20px;
                padding-top: 30px;
            }
            .profile-info h1 {
                font-size: 2rem;
            }
            .quick-info-card, .menu-grid {
                margin: 0 15px 15px 15px;
                /* padding: 0 15px; Sesuaikan padding grid juga */
            }
            .menu-grid {
                gap: 10px;
            }
            .menu-card {
                padding: 15px;
                min-height: 100px;
            }
            .menu-card .icon {
                width: 40px;
                height: 40px;
                margin-bottom: 10px;
            }
            .menu-card span {
                font-size: 0.9rem;
            }
            .bottom-nav {
                max-width: 100%;
                border-radius: 0;
            }
        }
    </style>
</head>
<body>
    <div class="mobile-frame">
        <div class="scrollable-content"> {{-- Wrapper untuk konten yang bisa discroll --}}
            <div class="profile-header">
                <div class="profile-info">
                    <span class="date">{{ \Carbon\Carbon::now()->format('d M, Y') }}</span>
                    <h1>{{ $balita->nama ?? 'Nama Balita' }}</h1>
                </div>
                <div class="profile-avatar">
                    <img src="https://i.pinimg.com/736x/e8/ee/cc/e8eecc6d4b7ae9d42e8ef6cc0251230d.jpg" alt="Avatar Balita">
                </div>
            </div>

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
                    <strong>{{ $balita->tanggal_lahir ? \Carbon\Carbon::parse($balita->tanggal_lahir)->format('d.m.y') : '?' }}</strong>
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

            <div class="menu-grid">
                <a href="{{ route('balita.hasil-pemeriksaan', ['id' => $balita->id]) }}" class="menu-card medical-record">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </span>
                    <span>Riwayat Pemeriksaan</span>
                </a>
                <a href="#" class="menu-card scheduled-visits">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h.01M7 12h.01M7 15h.01M7 18h.01M16 12h.01M16 15h.01M16 18h.01M3 20h18a2 2 0 002-2V8a2 2 0 00-2-2H3a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </span>
                    <span>Jadwal Kunjungan</span>
                </a>
                <a href="#" class="menu-card detailed-info">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    <span>Info Detail Balita</span>
                </a>
                <a href="#" class="menu-card vaccination-schedule">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    <span>Jadwal Vaksinasi</span>
                </a>
            </div>
        </div> {{-- End of scrollable-content --}}

        {{-- Bottom Navigation --}}
        <div class="bottom-nav">
            <a href="{{ route('balita.dashboard', $balita->id) }}" class="nav-item active">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L8.707 1.5Z"/>
                        <path d="m8 3.207 6.646 6.647-.708.708L8 4.707V14.5a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-9.293L1.354 10.56.646 9.854 8 2.5Z"/>
                    </svg>
                </span>
                <span>Home</span>
            </a>
            <a href="#" class="nav-item">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </span>
                <span>Notifikasi</span>
            </a>
            <a href="#" class="nav-item">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </span>
                <span>Pengaturan</span>
            </a>
        </div>
    </div>
</body>
</html>