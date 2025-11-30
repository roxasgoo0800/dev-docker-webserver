# /Dockerfile

# Gunakan image resmi PHP 8.0 dengan Apache
FROM php:8.0-apache

# Set working directory di dalam container
WORKDIR /var/www/html

# 1. Instalasi dependensi sistem yang dibutuhkan Laravel & Node.js
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libpng-dev \
    libjpeg-dev \
libfreetype6-dev \
    libzip-dev \
    nodejs \
    npm \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Instalasi ekstensi PHP yang umum digunakan oleh Laravel
# (Kita tetap instal ini karena sangat umum digunakan di banyak proyek PHP)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo pdo_mysql gd zip bcmath

# 3. Instalasi Composer (dependency manager untuk PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Salin konfigurasi Apache untuk mengatur DocumentRoot ke /public
# (Asumsi DocumentRoot akan diarahkan ke /var/www/html/app/public)
# Path disesuaikan karena Dockerfile sekarang ada di root proyek
COPY webserver/000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# 4. Salin file konfigurasi PHP kustom ke dalam container
COPY webserver/php/custom.ini /usr/local/etc/php/conf.d/custom-php-settings.ini

# Pindah ke direktori aplikasi
WORKDIR /var/www/html/app

# 5. Salin seluruh kode aplikasi
COPY ./app .

# 6. Instal dependensi PHP dan Node.js
# Perintah ini akan membuat file .lock jika belum ada.
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev
RUN npm install

# 7. Salin script entrypoint dan berikan izin eksekusi
COPY webserver/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# 9. Expose port 80
EXPOSE 80

# Tambahkan health check untuk memastikan Apache berjalan dengan baik
HEALTHCHECK --interval=60s --timeout=3s --start-period=5s --retries=3 \
  CMD curl -f http://localhost/ || exit 1

# Jalankan entrypoint script saat container dimulai
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
