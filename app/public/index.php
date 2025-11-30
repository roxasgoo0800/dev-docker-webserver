<?php
// 1. Muat autoloader Composer untuk bisa menggunakan library 'Carbon'
require_once __DIR__ . '/../vendor/autoload.php';

// 2. Gunakan komponen dari Composer (Carbon)
use Carbon\Carbon;

// Set timezone ke Asia/Jakarta
$nowInJakarta = Carbon::now('Asia/Jakarta');
$formattedDate = $nowInJakarta->isoFormat('dddd, D MMMM YYYY, HH:mm:ss');

// 3. Ambil semua environment variables yang kita butuhkan
$env_vars = [
    'DB_CONNECTION'  => getenv('DB_CONNECTION'),
    'DB_HOST'        => getenv('DB_HOST'),
    'DB_PORT'        => getenv('DB_PORT'),
    'DB_DATABASE'    => getenv('DB_DATABASE'),
    'DB_USERNAME'    => getenv('DB_USERNAME'),
    'DB_PASSWORD'    => getenv('DB_PASSWORD'),
    'APACHE_LOG_DIR' => getenv('APACHE_LOG_DIR'),
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi PHP Sederhana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; align-items: center; justify-content: center; min-height: 100vh; }
    </style>
</head>
<body class="bg-light">

<div class="container text-center">
    <div class="card shadow-sm p-4">
        <h1 class="mb-3">Halo dari Docker!</h1>
        <p class="lead">Ini adalah aplikasi PHP sederhana tanpa framework.</p>
        
        <div class="alert alert-info">
            <p class="mb-0">Waktu server saat ini (menggunakan <strong>Carbon</strong> dari Composer):</p>
            <p class="fw-bold"><?php echo $formattedDate; ?></p>
        </div>

        <div class="alert alert-secondary mt-3 text-start">
            <p class="mb-2 fw-bold">Environment Variables dari Docker:</p>
            <ul class="list-group">
                <?php foreach ($env_vars as $key => $value): ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong><?php echo htmlspecialchars($key); ?>:</strong>
                        
                        <span><?php echo htmlspecialchars($value ?: '(tidak di-set)'); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <button id="confetti-btn" class="btn btn-primary btn-lg mt-3">
            Klik Saya untuk Confetti! (menggunakan <strong>canvas-confetti</strong> dari NPM)
        </button>
    </div>
</div>

<!-- 3. Muat komponen dari NPM (canvas-confetti) -->
<script type="module">
    // Import fungsi confetti dari file yang ada di node_modules
    import confetti from '../node_modules/canvas-confetti/dist/confetti.module.mjs';

    // Tambahkan event listener ke tombol
    document.getElementById('confetti-btn').addEventListener('click', () => {
        confetti({
            particleCount: 150,
            spread: 180,
            origin: { y: 0.6 }
        });
    });
</script>

</body>
</html>
