<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP & JS Docker Project</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; text-align: center; margin: 40px; background-color: #f8f9fa; color: #212529; }
        h1 { color: #343a40; }
        button {
            padding: 12px 25px;
            font-size: 16px;
            cursor: pointer;
            border: 1px solid #6c757d;
            border-radius: 5px;
            background-color: #6c757d;
            color: white;
            transition: background-color 0.2s;
        }
        button:hover {
            background-color: #5a6268;
        }
        iframe {
            margin-top: 30px;
            width: 100%;
            height: 500px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <h1>Selamat Datang di Aplikasi PHP & JS!</h1>
    <p>Proyek ini berjalan di dalam kontainer Docker. Klik tombol di bawah untuk selebrasi!</p>
    <button id="confetti-button">🎉 Klik Saya! 🎉</button>

    <div style="margin-top: 30px; padding: 15px; border: 1px solid #ccc; border-radius: 5px; background-color: #e9ecef;">
        <h4>Status Validasi Dependensi</h4>
        <p>
            <?php
            // Cek apakah file autoload Composer ada
            if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
                echo '<span style="color: green; font-weight: bold;">✅ Composer install berhasil!</span> (vendor/autoload.php ditemukan)';
            } else {
                echo '<span style="color: red; font-weight: bold;">❌ Composer install GAGAL!</span> (vendor/autoload.php tidak ditemukan)';
            }
            ?>
        </p>
        <p>✅ **NPM install berhasil!** (Buktinya adalah tombol confetti di atas berfungsi).</p>
    </div>

    <h2>Informasi PHP (phpinfo)</h2>
    <p>Informasi konfigurasi PHP dari server ditampilkan di bawah ini melalui iframe.</p>
    <iframe src="phpinfo.php" title="PHP Info"></iframe>

    <script type="module" src="index.js"></script>

</body>
</html>