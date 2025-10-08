<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Balita</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Poppins', sans-serif; }

        body {
            background: #f9fafb;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background: white;
            padding: 2rem;
            width: 90%;
            max-width: 360px;
            border-radius: 1rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 1.5rem;
        }

        input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ccc;
            border-radius: 0.6rem;
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        input:focus {
            outline: none;
            border-color: #007bff;
        }

        button {
            width: 100%;
            background: #007bff;
            border: none;
            color: white;
            padding: 0.8rem;
            font-size: 1rem;
            border-radius: 0.6rem;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .error {
            color: #dc3545;
            margin-top: 0.5rem;
            font-size: 0.9rem;
        }

        footer {
            margin-top: 2rem;
            color: #888;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login Balita</h2>
        <form action="{{ route('balita.authenticate') }}" method="POST">
            @csrf
            <input type="text" name="balita_id" placeholder="Masukkan ID Balita" required autofocus>

            <button type="submit">Masuk</button>

            @error('balita_id')
                <div class="error">{{ $message }}</div>
            @enderror
        </form>

        <footer>© {{ date('Y') }} Posyandu Digital</footer>
    </div>
</body>
</html>
