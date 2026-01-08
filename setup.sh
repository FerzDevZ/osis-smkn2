#!/bin/bash

# Clear screen
clear

echo "======================================================"
echo "      OSIS SMKN 2 - Ultimate Setup (Linux/macOS)      "
echo "======================================================"

# 1. Check for .env file
if [ ! -f .env ]; then
    echo "[1/7] Menyiapkan file konfigurasi (.env)..."
    cp .env.example .env
else
    echo "[1/7] File .env sudah ada."
fi

# 2. Install PHP Dependencies
echo "[2/7] Menginstal dependensi PHP (Composer)..."
composer install

# 3. Install JS Dependencies
echo "[3/7] Menginstal dependensi JS (NPM)..."
npm install

# 4. Generate App Key
echo "[4/7] Menyiapkan kunci aplikasi..."
php artisan key:generate

# 5. Database Initialization
echo "[5/7] Melakukan migrasi database dan seeding..."

# Try to create MySQL database if connection is mysql
if grep -q "DB_CONNECTION=mysql" .env; then
    echo "Mendeteksi koneksi MySQL. Mencoba membuat database..."
    DB_NAME=$(grep "DB_DATABASE=" .env | cut -d '=' -f2)
    DB_USER=$(grep "DB_USERNAME=" .env | cut -d '=' -f2)
    DB_PASS=$(grep "DB_PASSWORD=" .env | cut -d '=' -f2)
    
    if [ -z "$DB_PASS" ]; then
        mysql -u "$DB_USER" -e "CREATE DATABASE IF NOT EXISTS $DB_NAME;" 2>/dev/null
    else
        mysql -u "$DB_USER" -p"$DB_PASS" -e "CREATE DATABASE IF NOT EXISTS $DB_NAME;" 2>/dev/null
    fi

    if [ $? -eq 0 ]; then
        echo "[v] Database '$DB_NAME' siap/sudah ada."
    else
        echo "[!] Gagal membuat database otomatis. Pastikan MySQL sudah aktif."
        echo "[!] Silakan buat database '$DB_NAME' secara manual jika diperlukan."
    fi
fi

echo "PERINGATAN: Ini akan mereset database Anda!"
php artisan migrate:fresh --seed

# 6. Create Storage Link
echo "[6/7] Menyiapkan tautan penyimpanan (storage link)..."
php artisan storage:link

# 7. Compile Assets
echo "[7/7] Membangun aset frontend..."
npm run build

echo ""
echo "======================================================"
echo "          INSTALASI BERHASIL DISELESAIKAN!          "
echo "======================================================"
echo "Admin Email    : admin@gmail.com"
echo "Admin Password : ferdinand123"
echo ""
echo "Menjalankan server pengembangan..."
php artisan serve
