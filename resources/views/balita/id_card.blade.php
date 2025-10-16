{{-- resources/views/balita/id_card.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID Card Balita - {{ $balita->nama ?? 'Balita' }}</title>
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

        /* Latar belakang abstrak */
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

        /* Header Section (sama seperti Detail Balita) */
        .header-section {
            padding: 25px;
            padding-top: 40px;
            background: linear-gradient(135deg, #e0e9f8, #f0f4fa);
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

        .header-section h3 {
            font-size: 1.8rem;
            color: var(--text-dark);
            margin: 0;
            font-weight: 700;
        }

        .content-area {
            flex-grow: 1;
            padding: 20px 25px;
            padding-bottom: 80px;
            display: flex;
            flex-direction: column;
            align-items: center; /* Pusatkan konten ID card */
            justify-content: center; /* Pusatkan secara vertikal jika cukup ruang */
        }

        /* ID Card Styling */
        .id-card-container {
            width: 100%;
            max-width: 300px; /* Lebar maksimum ID Card */
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: var(--border-radius-card);
            box-shadow: var(--shadow-hover);
            color: var(--text-light);
            padding: 25px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        /* Efek grafis pada ID Card */
        .id-card-container::before {
            content: '';
            position: absolute;
            top: -20px;
            left: -20px;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            filter: blur(15px);
            z-index: 0;
        }
        .id-card-container::after {
            content: '';
            position: absolute;
            bottom: -30px;
            right: -30px;
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            filter: blur(15px);
            z-index: 0;
        }

        .id-card-header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .id-card-header .logo {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }
        .id-card-header .logo svg {
            fill: var(--text-light);
        }

        .id-card-header h2 {
            margin: 0;
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--text-light);
        }

        .id-card-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid rgba(255, 255, 255, 0.5);
            margin: 0 auto 20px auto;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 1;
        }
        .id-card-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .id-card-body {
            position: relative;
            z-index: 1;
        }

        .id-card-body h1 {
            font-size: 1.8rem;
            margin: 0 0 10px 0;
            font-weight: 700;
            line-height: 1.2;
        }

        .id-card-body p {
            font-size: 0.95rem;
            margin: 5px 0;
            font-weight: 300;
            opacity: 0.9;
        }
        .id-card-body p strong {
            font-weight: 500;
        }
        .id-card-body .nik {
            font-size: 1.1rem;
            font-weight: 600;
            margin-top: 15px;
            margin-bottom: 20px;
            padding: 8px 15px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            display: inline-block;
            letter-spacing: 1px;
        }

        /* Detail baris pada ID card */
        .id-card-details {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px dashed rgba(255, 255, 255, 0.4);
            text-align: left;
        }

        .id-card-details .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 0.85rem;
        }
        .id-card-details .detail-row .label {
            font-weight: 300;
            opacity: 0.8;
        }
        .id-card-details .detail-row .value {
            font-weight: 500;
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
            .header-section h3 {
                font-size: 1.5rem;
            }
            .content-area {
                padding: 15px;
                padding-bottom: 70px;
            }
            .id-card-container {
                max-width: 90%; /* Sesuaikan lebar ID card di layar kecil */
                padding: 20px;
            }
            .id-card-header h2 {
                font-size: 1.2rem;
            }
            .id-card-avatar {
                width: 90px;
                height: 90px;
            }
            .id-card-body h1 {
                font-size: 1.6rem;
            }
            .id-card-body p {
                font-size: 0.9rem;
            }
            .id-card-body .nik {
                font-size: 1rem;
            }
            .id-card-details .detail-row {
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
            <h3>ID Card Balita</h3> {{-- Judul halaman --}}
        </div>

        <div class="content-area">
            <div class="id-card-container">
                <div class="id-card-header">
                    <span class="logo">
                        {{-- Contoh Logo, bisa diganti dengan SVG atau IMG lain --}}
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                        </svg>
                    </span>
                    <h2>KARTU IDENTITAS BALITA</h2>
                </div>

                <div class="id-card-avatar">
                    <img src="https://i.pinimg.com/736x/e8/ee/cc/e8eecc6d4b7ae9d42e8ef6cc0251230d.jpg" alt="Avatar Balita">
                </div>

                <div class="id-card-body">
                    <h1>{{ $balita->nama ?? 'Nama Balita' }}</h1>
                    <p>Putra/Putri dari <strong>{{ $balita->orang_tua ?? 'Orang Tua' }}</strong></p>
                    <span class="nik" id="nikText" style="cursor:pointer;" title="Klik untuk menampilkan QR Code">
                        {{ $balita->nik ?? 'NIK Balita' }}
                    </span>

                    <!-- QR Code Container -->
                    <div id="qrContainer" style="display:none; margin-top:20px; text-align:center;">
                        <div id="qrcode" style="display:inline-block;background-color:white;padding:10px;border-radius:5px;"></div>
                        <p style="font-size:0.85rem; color:white; margin-top:8px; opacity:0.9;">Klik NIK lagi untuk menutup QR</p>
                    </div>



                    <div class="id-card-details">
                        <div class="detail-row">
                            <span class="label">Jenis Kelamin</span>
                            <span class="value">{{ $balita->jenis_kelamin ?? '-' }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Tanggal Lahir</span>
                            <span class="value">{{ $balita->tanggal_lahir ? \Carbon\Carbon::parse($balita->tanggal_lahir)->translatedFormat('d F Y') : '-' }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Alamat</span>
                            <span class="value">{{ $balita->alamat ?? '-' }}</span>
                        </div>
                        {{-- Tambahkan detail lain yang relevan jika ada --}}
                    </div>
                    <div style="text-align:center; margin-top:25px;">
    <button id="downloadCardBtn" 
        style="padding:10px 20px;
               background: var(--secondary-color);
               border:none;
               border-radius: 25px;
               color:white;
               font-weight:600;
               cursor:pointer;
               box-shadow: 0 4px 10px rgba(0,0,0,0.1);
               transition:all 0.3s ease;">
        Unduh ID Card (JPG)
    </button>
</div>

                </div>
            </div>
        </div>

        <div class="bottom-action-area">
            <a href="{{ route('balita.dashboard', ['nik' => $balita->nik]) }}" class="back-to-dashboard-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5a.5.5 0 0 0 .5-.5z"/>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const downloadBtn = document.getElementById('downloadCardBtn');
        const idCard = document.querySelector('.id-card-container');

        downloadBtn.addEventListener('click', function () {
            downloadBtn.innerText = 'Memproses...';
            downloadBtn.disabled = true;

            setTimeout(() => {
                html2canvas(idCard, {
                    scale: 3,
                    backgroundColor: null,
                    useCORS: true,
                    logging: false
                }).then(canvas => {
                    canvas.toBlob(blob => {
                        if (window.navigator.msSaveOrOpenBlob) {
                            window.navigator.msSaveOrOpenBlob(blob, 'idcard.jpg');
                        } else {
                            const link = document.createElement('a');
                            link.href = URL.createObjectURL(blob);
                            const nama = "{{ Str::slug($balita->nama ?? 'balita', '_') }}";
                            link.download = `idcard_${nama}.jpg`;
                            document.body.appendChild(link);
                            link.click();
                            document.body.removeChild(link);
                            URL.revokeObjectURL(link.href);
                        }

                        downloadBtn.innerText = 'Unduh ID Card (JPG)';
                        downloadBtn.disabled = false;
                    }, 'image/jpeg', 1.0);
                }).catch(err => {
                    console.error('Gagal membuat gambar:', err);
                    alert('Terjadi kesalahan saat membuat ID Card. Coba lagi.');
                    downloadBtn.innerText = 'Unduh ID Card (JPG)';
                    downloadBtn.disabled = false;
                });
            }, 300);
        });
    });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const nikText = document.getElementById('nikText');
        const qrContainer = document.getElementById('qrContainer');
        const qrCodeDiv = document.getElementById('qrcode');
        let qrVisible = false;
        let qr = null;

        nikText.addEventListener('click', function() {
            const nik = "{{ $balita->nik }}";
            if (!qrVisible) {
                qrContainer.style.display = 'block';
                if (!qr) {
                    qr = new QRCode(qrCodeDiv, {
                        text: nik,
                        width: 160,
                        height: 160,
                        colorDark: "#000000",
                        colorLight: "transparent",
                        correctLevel: QRCode.CorrectLevel.H
                    });
                }
            } else {
                qrContainer.style.display = 'none';
                qrCodeDiv.innerHTML = "";
                qr = null;
            }
            qrVisible = !qrVisible;
        });
    });
    </script>

</body>
</html>