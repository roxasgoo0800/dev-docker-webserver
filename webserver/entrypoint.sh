#!/bin/bash

# Hentikan eksekusi skrip jika ada perintah yang gagal
set -e

# Set direktori kerja
cd /var/www/html/app

echo ">>> Menjalankan Apache Server..."
apache2-foreground
