<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Balita</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f4f8;
            padding: 2rem;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        form {
            margin-top: 1.5rem;
        }
        button {
            background: #dc3545;
            color: white;
            border: none;
            padding: 0.7rem 1.2rem;
            border-radius: 0.6rem;
            cursor: pointer;
        }
        button:hover {
            background: #b02a37;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Selamat Datang, {{ Auth::user()->nama_balita ?? 'Balita' }} 👶</h2>
        <p>ID Balita: {{ Auth::user()->id }}</p>

        <form action="{{ route('balita.logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</body>
</html>
