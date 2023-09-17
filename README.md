<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## FLOW DIAGRAM

<p align="center"><a href="" target="_blank"><img src="https://raw.githubusercontent.com/imam-f-gund/inventory/master/public/images/flowdiagram.jpg" width="400"></a></p>

## ERD

<p align="center"><a href="" target="_blank"><img src="https://raw.githubusercontent.com/imam-f-gund/inventory/master/public/images/erd.jpg" width="400"></a></p>

## Cara Install

### Ekstrak File dan Buka Terminal di dalam Forder Project

Download file project, ekstrak terlebih dahulu kemudian masuk ke dalam folder project dan buka terminal / cmd / git ataupun software sejenis. Pastikan terminal sudah mengarah ke folder project.

### Install Semua Dependensi yang Dibutuhkan

```bash
composer install
```

### Buat Database Baru

Buat database sebagai tempat penyimpanan aplikasi ini

### Copy .env.example to .env

Copy file .env.example ke .env

```bash
cp .env.example .env
```

### Setting Database di File .env

```bash
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nama_database
DB_USERNAME=username
DB_PASSWORD=password
```

### Migrasi Database

Migrasi semua table dan data yang sudah disediakan

```bash
php artisan migrate:fresh --seed
```

### Generate Key Aplikasi

```bash
php artisan key:generate
```

### Jalankan Aplikasi

```bash
php artisan serve
```

Akses menggunakan link berikut

```bash
http://127.0.0.1:8000
```

## Informasi Login Pengguna

| Username   | Password |
| ---------- | -------- |
| superadmin | password |

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
"# Repository-Baru" 
"# init" 
