# Ximilu Ammar — Petunjuk Instalasi

Panduan singkat untuk menyiapkan project Laravel ini pada mesin pengembangan lokal.

## Prasyarat

- PHP 8.2 atau lebih baru
- Composer (https://getcomposer.org)
- Node.js
- MySQL atau database lain
- Git

## Langkah Instalasi 

Jalankan perintah berikut di terminal:

```bash
# 1. Clone repo
git clone https://github.com/alfairuzirianto/ximilu-ammar
cd ximilu-ammar

# 2. Install dependensi PHP
composer install

# 3. Salin file environment dan generate app key
copy .env.example .env
php artisan key:generate

# 4. Atur database di file .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ximilu_ammar
DB_USERNAME=root
DB_PASSWORD=

# 5. Jalankan migrasi dan seeding
php artisan migrate --seed

# 6. Install dependensi JS dan build assets (development)
npm install
npm run dev

# 7. Buat symbolic link ke storage (jika diperlukan)
php artisan storage:link

# 8. Jalankan server development bawaan Laravel
php artisan serve
```