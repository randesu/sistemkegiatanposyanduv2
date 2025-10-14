<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Balita</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

            /* Warna untuk Chart */
            --chart-line-color-bb: #4CAF50; /* Hijau untuk Berat Badan */
            --chart-line-color-tb: #2196F3; /* Biru untuk Tinggi Badan */
            --chart-grid-color: rgba(0, 0, 0, 0.05);
            --chart-text-color: var(--text-muted);
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
            background-color: var(--card-background);
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

        .scrollable-content {
            flex-grow: 1;
            padding-bottom: 70px;
        }

        /* ----- Header Profil ----- */
        .profile-header {
            padding: 25px;
            padding-top: 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(135deg, #e0e9f8, #f0f4fa);
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
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: 3px solid var(--text-light);
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* ----- Info Balita Cepat ----- */
        .quick-info-card {
            background: var(--text-light);
            border-radius: var(--border-radius-card);
            margin: 0 25px 20px 25px;
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

        /* ----- Chart Card Styling ----- */
        .chart-card {
            background: white;
            border-radius: var(--border-radius-card);
            margin: 0 25px 20px 25px; /* Margin konsisten dengan quick-info-card */
            padding: 20px 25px;
            box-shadow: var(--shadow-light);
            /* min-height: 250px; Tambahkan tinggi minimum agar chart terlihat */
        }

        .chart-card h2 {
            font-size: 1.2rem;
            color: var(--primary-color);
            margin-top: 0;
            margin-bottom: 15px;
            font-weight: 600;
            text-align: center;
        }

        /* Adjust canvas size within card */
        .chart-container {
background-color: #f0f4fa;
            position: relative;
            height: 200px; /* Tinggi spesifik untuk chart */
            width: 100%;
        }

        /* ----- Menu Kartu ----- */
        .menu-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            padding: 0 25px;
            margin-bottom: 25px;
        }

        .menu-card {
            background-color: var(--card-bg-1);
            border-radius: var(--border-radius-card);
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            min-height: 120px;
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
            color: var(--text-light);
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
        .menu-card.medical-record .icon { color: var(--primary-color); }

        .menu-card.scheduled-visits { background-color: var(--card-bg-2); }
        .menu-card.scheduled-visits .icon { color: var(--text-light); }

        .menu-card.detailed-info { background-color: var(--card-bg-3); }
        .menu-card.detailed-info .icon { color: var(--text-dark); }

        .menu-card.vaccination-schedule { background-color: var(--card-bg-4); }
        .menu-card.vaccination-schedule .icon { color: var(--text-dark); }


        /* ----- Bottom Navigation (Updated) ----- */
        .bottom-nav {
            position: sticky;
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
            flex-shrink: 0;
            margin-top: auto;
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
                height: 90vh;
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
                max-width: 100%;
                border-radius: 0;
            }
            .profile-header {
                padding: 20px;
                padding-top: 30px;
            }
            .profile-info h1 {
                font-size: 2rem;
            }
            .quick-info-card, .chart-card, .menu-grid { /* Tambahkan chart-card di sini */
                margin: 0 15px 15px 15px;
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
            .chart-card h2 {
                font-size: 1rem;
            }
            .chart-container {
                height: 180px; /* Sesuaikan tinggi chart untuk mobile */
            }
        }
    </style>
</head>
<body>
    <div class="mobile-frame">
        <div class="scrollable-content"> {{-- Wrapper untuk konten yang bisa discroll --}}
            <div class="profile-header">
                <div class="profile-info">
                    <p style="margin: 0;padding: 0;">Selamat Datang,</p>
                    <h1>{{ $balita->nama ?? 'Nama Balita' }}</h1>
                </div>
                <div class="profile-avatar">
                    <img src="https://i.pinimg.com/736x/e8/ee/cc/e8eecc6d4b7ae9d42e8ef6cc0251230d.jpg" alt="Avatar Balita">
                </div>
            </div>

            <!-- <div class="quick-info-card">
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
            </div> -->

            <div class="chart-card">
                <h2>Grafik Pertumbuhan</h2>
                <div class="chart-container">
                    <canvas id="growthChart"></canvas>
                </div>
            </div>

            <div class="menu-grid">
                <!-- Bagian riwayat pemeriksaan -->
                <form id="medicalRecordForm" action="{{ route('balita.hasil-pemeriksaan') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="nik" value="{{ $balita->nik }}">
                </form>
                <a href="#" class="menu-card medical-record" onclick="document.getElementById('medicalRecordForm').submit(); return false;">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M17 17h.01" />
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
        <!-- <div class="bottom-nav">
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
        </div> -->
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Ambil data dari PHP
        // Pastikan variabel $balita->hasilPemeriksaans tidak null dan merupakan array/koleksi
        const pemeriksaanData = @json($balita->hasilPemeriksaans->sortBy('created_at')->values()->all() ?? []);

        const chartCard = document.querySelector('.chart-card');
        const chartContainer = document.querySelector('.chart-container');

        // 2. Cek apakah data ada
        if (!pemeriksaanData || pemeriksaanData.length === 0) {
            // Tampilkan pesan jika tidak ada data pemeriksaan
            if (chartCard) {
                chartCard.innerHTML = `
                    <h2 style="color: var(--primary-color);">Grafik Pertumbuhan</h2>
                    <p style="text-align: center; color: var(--text-muted); font-size: 0.9rem; padding: 10px 0;">
                        Belum ada data pemeriksaan untuk menampilkan grafik.
                    </p>
                `;
                // Atur tinggi card agar terlihat bagus
                chartCard.style.paddingTop = '30px';
                chartCard.style.paddingBottom = '30px';
            }
            return; // Hentikan eksekusi script jika tidak ada data
        }

        // 3. Jika data ada, siapkan data untuk Chart.js
        const labels = pemeriksaanData.map(p => {
            const date = new Date(p.created_at);
            // Gunakan 'id-ID' untuk format tanggal lokal
            return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
        });
        const beratBadanData = pemeriksaanData.map(p => p.berat_badan);
        const tinggiBadanData = pemeriksaanData.map(p => p.tinggi);

        // 4. Ambil nilai CSS (Jika Anda menggunakan variabel CSS di Chart.js)
        const style = getComputedStyle(document.documentElement);
        const chartLineColorBB = style.getPropertyValue('--chart-line-color-bb').trim();
        const chartLineColorTB = style.getPropertyValue('--chart-line-color-tb').trim();
        const chartGridColor = style.getPropertyValue('--chart-grid-color').trim();
        const chartTextColor = style.getPropertyValue('--chart-text-color').trim();
        
        // 5. Inisialisasi Chart
        const ctx = document.getElementById('growthChart').getContext('2d');
        const growthChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Berat Badan (kg)',
                        data: beratBadanData,
                        borderColor: chartLineColorBB, // Gunakan variabel JS
                        // backgroundColor: chartLineColorBB.replace(')', ', 0.1)').replace('rgb', 'rgba'), // Membuat background transparan
                        // borderWidth: 2,
                         borderDash: [5, 5],
                        fill: true,
                        tension: 0.4,
                        pointRadius: 5,
                        pointBackgroundColor: chartLineColorBB,
                        pointBorderColor: 'var(--text-light)',
                        pointHoverRadius: 7,
                    },
                    {
                        label: 'Tinggi Badan (cm)',
                        data: tinggiBadanData,
                        borderColor: chartLineColorTB, // Gunakan variabel JS
                        // backgroundColor: chartLineColorTB.replace(')', ', 0.1)').replace('rgb', 'rgba'),
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 5,
                        pointBackgroundColor: chartLineColorTB,
                        pointBorderColor: 'var(--text-light)',
                        pointHoverRadius: 7,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            font: { family: 'Poppins', size: 10 },
                            color: chartTextColor,
                            boxWidth: 15,
                            padding: 15
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0,0,0,0.8)',
                        titleFont: { family: 'Poppins', size: 12 },
                        bodyFont: { family: 'Poppins', size: 10 },
                        padding: 10,
                        displayColors: true,
                    }
                },
                scales: {
                    x: {
                        beginAtZero: false,
                        grid: {
                            display: true,
                            drawBorder: false,
                            color: chartGridColor
                        },
                        ticks: {
                            font: { family: 'Poppins', size: 10 },
                            color: chartTextColor
                        },
                        title: {
                            display: true,
                            text: 'Tanggal Pemeriksaan',
                            color: chartTextColor,
                            font: { family: 'Poppins', size: 11, weight: '500' }
                        }
                    },
                    y: {
                        beginAtZero: false,
                        grid: {
                            display: true,
                            drawBorder: false,
                            color: chartGridColor
                        },
                        ticks: {
                            font: { family: 'Poppins', size: 10 },
                            color: chartTextColor
                        },
                        title: {
                            display: true,
                            text: 'Berat (kg) / Tinggi (cm)',
                            color: chartTextColor,
                            font: { family: 'Poppins', size: 11, weight: '500' }
                        }
                    }
                }
            }
        });
    });
</script>
</body>
</html>