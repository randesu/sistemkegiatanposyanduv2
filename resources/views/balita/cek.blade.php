<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Data Balita</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6a89cc; /* Biru lembut */
            --secondary-color: #a4b0be; /* Abu-abu kebiruan */
            --background-light: #f4f7f6;
            --text-dark: #333;
            --text-light: #fff;
            --border-radius-main: 12px;
            --shadow-light: 0 4px 20px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 6px 25px rgba(0, 0, 0, 0.12);
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-light);
            color: var(--text-dark);
            overflow: hidden; /* Mencegah scroll yang tidak diinginkan */
            position: relative;
        }

        /* Desain latar belakang abstrak */
        body::before {
            content: '';
            position: absolute;
            top: -20%;
            left: -20%;
            width: 80%;
            height: 80%;
            background: radial-gradient(circle at 10% 20%, rgba(106, 137, 204, 0.2) 0%, transparent 80%);
            border-radius: 50%;
            z-index: 0;
        }
        body::after {
            content: '';
            position: absolute;
            bottom: -20%;
            right: -20%;
            width: 70%;
            height: 70%;
            background: radial-gradient(circle at 90% 80%, rgba(164, 176, 190, 0.2) 0%, transparent 80%);
            border-radius: 50%;
            z-index: 0;
        }

        form {
            background: var(--text-light);
            padding: 3rem;
            border-radius: var(--border-radius-main);
            box-shadow: var(--shadow-light);
            max-width: 400px;
            width: 90%; /* Menggunakan persentase agar adaptif */
            text-align: center;
            position: relative;
            z-index: 1; /* Pastikan form di atas latar belakang */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        form:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        h2 {
            font-size: 1.8rem;
            color: var(--primary-color);
            margin-bottom: 2rem;
            font-weight: 600;
        }

        input[type="number"] {
            width: calc(100% - 30px); /* Adjust width to account for padding */
            padding: 12px 15px;
            margin-bottom: 1.5rem;
            border: 1px solid #e0e6ed;
            border-radius: 8px;
            font-size: 1rem;
            color: var(--text-dark);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="number"]::placeholder {
            color: var(--secondary-color);
        }

        input[type="number"]:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(106, 137, 204, 0.2);
        }

        button {
            width: 100%;
            padding: 12px 20px;
            background: linear-gradient(45deg, var(--primary-color), #8a9fc7);
            color: var(--text-light);
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        button:hover {
            background: linear-gradient(45deg, #8a9fc7, var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        button:active {
            transform: translateY(0);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: -1rem;
            margin-bottom: 1rem;
            font-weight: 400;
        }

        /* Responsif untuk layar lebih kecil */
        @media (max-width: 600px) {
            form {
                padding: 2.5rem 2rem; /* Sedikit kurangi padding vertikal dan horizontal */
                width: calc(100% - 40px); /* Berikan margin 20px di kiri dan kanan */
                margin: 0 20px; /* Tambahkan margin horizontal */
            }
            h2 {
                font-size: 1.6rem;
                margin-bottom: 1.8rem;
            }
            input[type="number"] {
                width: calc(100% - 24px); /* Sesuaikan lebar input dengan padding baru */
                padding: 10px 12px;
                font-size: 0.95rem;
            }
            button {
                padding: 11px 18px;
                font-size: 1.05rem;
            }
        }

        @media (max-width: 400px) { /* Khusus untuk layar sangat kecil */
            form {
                padding: 2rem 1.5rem; /* Kurangi padding lebih lanjut */
                width: calc(100% - 30px); /* Margin 15px di kiri dan kanan */
                margin: 0 15px;
            }
            h2 {
                font-size: 1.4rem;
                margin-bottom: 1.5rem;
            }
            input[type="number"] {
                width: calc(100% - 20px); /* Sesuaikan lebar input dengan padding baru */
                padding: 9px 10px;
                font-size: 0.9rem;
            }
            button {
                padding: 10px 15px;
                font-size: 1rem;
            }
            .error-message {
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <form action="{{ route('balita.data') }}" method="POST">
        @csrf
        <h2>Cek Data Balita</h2>
        <input type="number" name="balita_id" placeholder="Masukkan ID Balita" required>
        @error('balita_id')
            <p class="error-message">{{ $message }}</p>
        @enderror
        <button type="submit">Lihat Data</button>
    </form>
</body>
</html>