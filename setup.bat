@echo off
setlocal enabledelayedexpansion

echo ======================================================
echo       OSIS SMKN 2 - Ultimate Setup (Windows)
echo ======================================================

:: 1. Check for .env file
if not exist .env (
    echo [1/7] Menyiapkan file konfigurasi (.env)...
    copy .env.example .env
) else (
    echo [1/7] File .env sudah ada.
)

:: 2. Install PHP Dependencies
echo [2/7] Menginstal dependensi PHP (Composer)...
call composer install

:: 3. Install JS Dependencies
echo [3/7] Menginstal dependensi JS (NPM)...
call npm install

:: 4. Generate App Key if empty
echo [4/7] Menyiapkan kunci aplikasi...
call php artisan key:generate

:: 5. Database Initialization
echo [5/7] Melakukan migrasi database dan seeding...

:: Check if using MySQL
findstr /C:"DB_CONNECTION=mysql" .env >nul
if errorlevel 1 goto skip_db_creation

echo Mendeteksi koneksi MySQL. Mencoba membuat database...
for /f "tokens=2 delims==" %%a in ('findstr /C:"DB_DATABASE=" .env') do set DB_NAME=%%a
for /f "tokens=2 delims==" %%a in ('findstr /C:"DB_USERNAME=" .env') do set DB_USER=%%a
for /f "tokens=2 delims==" %%a in ('findstr /C:"DB_PASSWORD=" .env') do set DB_PASS=%%a

:: Cleaning variable values (remove possible spaces)
set DB_NAME=!DB_NAME: =!
set DB_USER=!DB_USER: =!
set DB_PASS=!DB_PASS: =!

if "!DB_PASS!"=="" goto db_no_pass

:db_with_pass
mysql -u !DB_USER! -p!DB_PASS! -e "CREATE DATABASE IF NOT EXISTS !DB_NAME!;" 2>nul
if errorlevel 1 goto db_error
goto db_success

:db_no_pass
mysql -u !DB_USER! -e "CREATE DATABASE IF NOT EXISTS !DB_NAME!;" 2>nul
if errorlevel 1 goto db_error
goto db_success

:db_error
echo [!] Gagal membuat database otomatis. Pastikan MySQL XAMPP sudah aktif dan perintah 'mysql' terdaftar di PATH.
echo [!] Jika gagal, buatlah database '!DB_NAME!' secara manual di phpMyAdmin.
goto skip_db_creation

:db_success
echo [v] Database '!DB_NAME!' siap/sudah ada.

:skip_db_creation
echo PERINGATAN: Ini akan mereset database Anda!
call php artisan migrate:fresh --seed

:: 6. Create Storage Link
echo [6/7] Menyiapkan tautan penyimpanan (storage link)...
call php artisan storage:link

:: 7. Compile Assets
echo [7/7] Membangun aset frontend...
call npm run build

echo.
echo ======================================================
echo           INSTALASI BERHASIL DISELESAIKAN!
echo ======================================================
echo Admin Email    : admin@gmail.com
echo Admin Password : ferdinand123
echo.
echo Menjalankan server pengembangan...
call php artisan serve
pause
