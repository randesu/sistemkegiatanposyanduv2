<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pemeriksaan - {{ $balita->nama ?? 'Balita' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Menggunakan variabel warna dari tema dashboard utama */
        :root {
            --primary-color: #6a89cc; /* Biru lembut */
            --secondary-color: #8A9FC7; /* Biru lebih gelap untuk gradien */
            --background-light: #f4f7f6; /* Latar belakang body */
            --card-background: #ffffff;
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
            background-color: var(--card-background); /* Latar belakang frame */
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
        }

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
            text-decoration: none; /* Untuk kasus jika ini adalah <a> */
            transition: transform 0.2s ease;
        }
        .header-section .back-button:hover {
            transform: translateX(-5px);
        }

        .header-section h1 {
            font-size: 1.8rem;
            color: var(--text-dark);
            margin: 0;
            font-weight: 700;
        }

        .content-area {
            flex-grow: 1;
            padding: 20px 25px; /* Padding di sekitar konten */
            padding-bottom: 80px; /* Ruang untuk bottom nav (jika ada) atau tombol kembali */
        }

        /* ----- Accordion Card Styling ----- */
        .accordion-item {
            background: var(--card-background);
            border-radius: var(--border-radius-card);
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
            overflow: hidden; /* Penting untuk animasi */
        }

        .accordion-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 20px;
            cursor: pointer;
            background: var(--card-background);
            border-bottom: 1px solid #f0f0f0; /* Garis pemisah */
            transition: background-color 0.2s ease;
        }

        .accordion-header:hover {
            background-color: #f8faff;
        }

        .accordion-header h4 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .accordion-header .indicator {
            font-size: 1.2rem;
            color: var(--text-muted);
            transition: transform 0.3s ease;
        }

        .accordion-item.active .accordion-header .indicator {
            transform: rotate(180deg);
        }

        .accordion-content {
            padding: 0 20px;
            max-height: 0; /* Awalnya tersembunyi */
            overflow: hidden;
            transition: max-height 0.4s ease-out, padding 0.4s ease-out;
        }

        .accordion-item.active .accordion-content {
            max-height: 500px; /* Sesuaikan dengan tinggi maksimum konten Anda */
            padding: 15px 20px;
        }

        .content-detail-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 8px;
            border-bottom: 1px dashed #f0f0f0;
        }

        .content-detail-item:last-of-type {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .content-detail-item strong {
            color: var(--text-dark);
            font-weight: 500;
            font-size: 0.95rem;
        }

        .content-detail-item span {
            color: var(--text-muted);
            font-weight: 400;
            font-size: 0.95rem;
            text-align: right;
        }

        .content-detail-item.vaccine-list span {
            display: block; /* Agar vaksin tampil per baris */
            margin-top: 5px;
            font-size: 0.9rem;
        }

        /* No data message */
        .no-data-message {
            text-align: center;
            color: var(--text-muted);
            padding: 30px;
            background: var(--card-background);
            border-radius: var(--border-radius-card);
            box-shadow: var(--shadow-light);
            margin-top: 20px;
        }

        /* Tombol kembali ke dashboard */
        .bottom-action-area {
            padding: 20px 25px;
            text-align: center;
            background: var(--card-background);
            border-top: 1px solid #eee;
            box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.05);
            position: sticky; /* Sticky di bagian bawah mobile-frame */
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


        /* Responsif */
        @media (max-width: 400px) {
            .mobile-frame {
                max-width: 100%;
                border-radius: 0;
            }
            .header-section {
                padding: 20px;
                padding-top: 30px;
            }
            .header-section h1 {
                font-size: 1.5rem;
            }
            .content-area {
                padding: 15px;
                padding-bottom: 70px;
            }
            .accordion-header {
                padding: 15px;
            }
            .accordion-header h4 {
                font-size: 1rem;
            }
            .accordion-item.active .accordion-content {
                padding: 10px 15px;
            }
            .content-detail-item strong, .content-detail-item span {
                font-size: 0.85rem;
            }
            .content-detail-item.vaccine-list span {
                font-size: 0.8rem;
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
<form action="{{ route('balita.dashboard') }}" method="POST" style="display:inline;">
    @csrf
    <input type="hidden" name="nik" value="{{ $balita->nik }}">
    <button type="submit" class="back-button" style="border:none; background:none; cursor:pointer;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>

    </button>
</form>
            <h3>Riwayat Pemeriksaan</h3>
        </div>

        <div class="content-area">
            @if ($balita->hasilPemeriksaans->isNotEmpty())
                @foreach ($balita->hasilPemeriksaans->sortByDesc('created_at') as $pemeriksaan)
                    <div class="accordion-item">
                        <div class="accordion-header">
                            <h4>Pemeriksaan {{ \Carbon\Carbon::parse($pemeriksaan->created_at)->format('d M Y') }}</h4>
                            <span class="indicator">&#9660;</span> {{-- Panah ke bawah --}}
                        </div>
                        <div class="accordion-content">
    <div class="content-detail-item">
        <strong>Usia Balita:</strong>
        <span>
            @if ($balita->tanggal_lahir)
                {{ \Carbon\Carbon::parse($balita->tanggal_lahir)->diffInMonths($pemeriksaan->created_at) }} Bulan
            @else
                N/A
            @endif
        </span>
    </div>
    <div class="content-detail-item">
        <strong>Berat Badan:</strong>
        <span>{{ $pemeriksaan->berat_badan }} kg</span>
    </div>
    <div class="content-detail-item">
        <strong>Tinggi Badan:</strong>
        <span>{{ $pemeriksaan->tinggi }} cm</span>
    </div>
    <div class="content-detail-item vaccine-list">
        <strong>Vaksin Diberikan:</strong>
        <span>
            @if ($pemeriksaan->vaksins->isNotEmpty())
                @foreach ($pemeriksaan->vaksins as $vaksin)
                    {{ $vaksin->nama_vaksin }} (Dosis {{ $vaksin->pivot->dosis ?? '?' }})<br>
                @endforeach
            @else
                Tidak ada vaksin
            @endif
        </span>
    </div>

    {{-- BAGIAN BARU UNTUK VITAMIN --}}
    <div class="content-detail-item vitamin-list">
        <strong>Vitamin Diberikan:</strong>
        <span>
            {{-- Menggunakan relasi vitamins() dari model HasilPemeriksaan --}}
            @if ($pemeriksaan->vitamins->isNotEmpty())
                @foreach ($pemeriksaan->vitamins as $vitamin)
                    {{ $vitamin->nama_vitamin }}<br>
                @endforeach
            @else
                Tidak ada vitamin
            @endif
        </span>
    </div>
    {{-- AKHIR BAGIAN BARU --}}

    <div class="content-detail-item">
        <strong>Catatan Petugas:</strong>
        <span>{{ $pemeriksaan->catatan ?? '-' }}</span>
    </div>
</div>

                    </div>
                @endforeach
            @else
                <div class="no-data-message">
                    <p>Belum ada riwayat pemeriksaan untuk balita ini.</p>
                </div>
            @endif
        </div>

        <div class="bottom-action-area">
            <a href="{{ route('balita.dashboard', ['id' => $balita->id]) }}" class="back-to-dashboard-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5a.5.5 0 0 0 .5-.5z"/>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const accordionHeaders = document.querySelectorAll('.accordion-header');

            accordionHeaders.forEach(header => {
                header.addEventListener('click', function() {
                    const accordionItem = this.closest('.accordion-item');
                    accordionItem.classList.toggle('active');

                    const content = accordionItem.querySelector('.accordion-content');
                    if (accordionItem.classList.contains('active')) {
                        content.style.maxHeight = content.scrollHeight + "px"; // Mengatur tinggi sesuai konten
                    } else {
                        content.style.maxHeight = null;
                    }
                });
            });
        });
    </script>
</body>
</html>