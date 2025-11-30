# Proyek Aplikasi PHP & JavaScript dengan Docker

Selamat datang di proyek aplikasi PHP & JavaScript sederhana yang sepenuhnya dikemas dalam kontainer menggunakan Docker. Proyek ini dirancang sebagai fondasi yang solid untuk pengembangan aplikasi web modern, dengan semua konfigurasi yang diperlukan untuk lingkungan pengembangan dan produksi.

## Fitur Utama

- **Lingkungan Terisolasi**: Menggunakan Docker untuk memastikan lingkungan pengembangan yang konsisten dan terisolasi.
- **PHP 8.0 & Apache**: Dijalankan di atas image resmi PHP 8.0 dengan server web Apache.
- **Manajemen Dependensi**: Menggunakan **Composer** untuk dependensi PHP dan **NPM** untuk dependensi JavaScript.
- **Build Teroptimasi**: `Dockerfile` dirancang untuk memanfaatkan *build cache* Docker, membuat proses build ulang lebih cepat.
- **Konfigurasi Kustom**: Termasuk konfigurasi kustom untuk PHP (`custom.ini`) dan Apache (`000-default.conf`).
- **Manajemen Sumber Daya**: `docker-compose.yaml` dikonfigurasi untuk membatasi penggunaan CPU (2 core) dan RAM (1 GB).
- **Health Check**: Dilengkapi dengan `HEALTHCHECK` untuk memonitor kondisi server web di dalam kontainer.
- **Siap Produksi**: Kode aplikasi "dipanggang" langsung ke dalam image, membuatnya portabel dan siap untuk di-deploy.

---

## Prasyarat

Pastikan Anda telah menginstal perangkat lunak berikut di mesin Anda:

- Docker
- Docker Compose

---

## Cara Menjalankan Proyek

Ikuti langkah-langkah sederhana ini untuk membangun image dan menjalankan kontainer.

### 1. Clone atau Unduh Proyek

Jika ini adalah repositori Git, clone repositori ini. Jika tidak, pastikan semua file berada dalam satu direktori proyek.

```bash
# Contoh jika ini adalah repositori Git
git clone <url-repositori-anda>
cd docker-webserver
```

### 2. Bangun dan Jalankan Kontainer

Buka terminal di direktori root proyek (`docker-webserver`) dan jalankan perintah berikut:

```bash
# Perintah ini akan membangun image Docker sesuai Dockerfile
# dan menjalankan layanan yang didefinisikan di docker-compose.yaml
# di latar belakang (-d).
docker-compose up --build -d
```

### 3. Akses Aplikasi

Setelah kontainer berhasil berjalan, buka browser Anda dan akses alamat berikut:

**http://localhost:8080**

Anda akan melihat halaman `index.php` dari aplikasi Anda.

### 4. Menghentikan Aplikasi

Untuk menghentikan dan menghapus kontainer, jalankan perintah berikut:

```bash
docker-compose down
```

---

## Struktur Proyek

```
docker-webserver/
├── app/                # Direktori utama untuk semua kode aplikasi Anda (PHP, JS, CSS)
│   ├── index.php
│   ├── composer.json
│   └── package.json
├── webserver/          # Direktori untuk file konfigurasi server
│   ├── 000-default.conf  # Konfigurasi VirtualHost Apache
│   ├── entrypoint.sh     # Skrip yang dijalankan saat kontainer start
│   └── php/
│       └── custom.ini    # Konfigurasi kustom PHP
├── Dockerfile          # Blueprint untuk membangun image aplikasi
├── docker-compose.yaml # File untuk mendefinisikan dan menjalankan layanan Docker
└── README.md           # File ini
```

---

## Catatan Tambahan

Setiap kali Anda membuat perubahan pada kode di dalam direktori `app/` atau file konfigurasi apa pun (`Dockerfile`, `*.conf`, `*.ini`), Anda perlu membangun ulang image agar perubahan tersebut diterapkan.

```bash
docker-compose build
```