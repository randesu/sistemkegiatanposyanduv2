<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Data Balita</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6a89cc;
            --secondary-color: #a4b0be;
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
            overflow: hidden;
            position: relative;
        }

        body::before, body::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            z-index: 0;
        }

        body::before {
            top: -20%;
            left: -20%;
            width: 80%;
            height: 80%;
            background: radial-gradient(circle at 10% 20%, rgba(106, 137, 204, 0.2) 0%, transparent 80%);
        }

        body::after {
            bottom: -20%;
            right: -20%;
            width: 70%;
            height: 70%;
            background: radial-gradient(circle at 90% 80%, rgba(164, 176, 190, 0.2) 0%, transparent 80%);
        }

        form {
            background: var(--text-light);
            padding: 3rem;
            border-radius: var(--border-radius-main);
            box-shadow: var(--shadow-light);
            max-width: 400px;
            width: 90%;
            text-align: center;
            position: relative;
            z-index: 1;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        form:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        h2 {
            font-size: 1.8rem;
            color: var(--primary-color);
            font-weight: 600;
        }

        input[type="text"] {
            width: calc(100% - 30px);
            padding: 12px 15px;
            margin-bottom: 1.5rem;
            border: 1px solid #e0e6ed;
            border-radius: 8px;
            font-size: 1rem;
            color: var(--text-dark);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="text"]::placeholder {
            color: var(--secondary-color);
        }

        input[type="text"]:focus {
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
    </style>
</head>
<body>
    <form action="<?php echo e(route('balita.dashboard')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <h2>Portal Kesehatan</h2>
        <h2>Posyandu Bunga Tulip</h2>
        
       <input type="text" name="nik" placeholder="Masukkan NIK Balita">
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <p class="error-message"><?php echo e($message); ?></p>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <button type="submit">Lihat Data</button>
    </form>
</body>
</html>
<?php /**PATH /home/cyrene/Documents/sistemkegiatanposyanduv2/resources/views/balita/cek.blade.php ENDPATH**/ ?>