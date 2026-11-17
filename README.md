
# NewsAPI REST Client

Aplikasi REST Client sederhana berbasis PHP yang menggunakan
cURL untuk mengambil dan menampilkan berita teknologi dari
Public API NewsAPI.org.

## Fitur Aplikasi

- Mengambil data berita menggunakan HTTP GET Request.
- Menggunakan cURL PHP untuk komunikasi dengan API.
- Mengolah response JSON menggunakan json_decode().
- Menampilkan judul berita.
- Menampilkan sumber berita.
- Menampilkan deskripsi berita.
- Menampilkan gambar berita jika tersedia.
- Menyediakan tombol untuk membaca berita lengkap.
- Menangani kesalahan request API.

## Teknologi yang Digunakan

- PHP
- HTML
- Bootstrap 5
- cURL
- NewsAPI.org
- XAMPP

## Struktur Folder

rest-client-news/
│
├── assets/
│
├── config/
│   ├── curl.php
│   └── config.php
│
├── index.php
└── README.md

## Persyaratan

- XAMPP
- PHP dengan ekstensi cURL aktif
- Koneksi internet
- API Key dari NewsAPI.org

## Cara Instalasi

1. Download atau clone repository ini.
2. Letakkan folder project di dalam htdocs.
3. Buka folder config.
4. Masukkan API Key NewsAPI pada config.php.
5. Pastikan ekstensi cURL PHP sudah aktif.
6. Jalankan Apache melalui XAMPP.
7. Buka browser dan akses:

http://localhost/rest-client-news/

## Endpoint API

GET https://newsapi.org/v2/top-headlines

### Parameter

| Parameter | Value |
|-----------|-------|
| country | us |
| category | technology |
| apiKey | API Key NewsAPI |

## Pengujian

Pengujian awal aplikasi meliputi:

- Membuka halaman aplikasi.
- Mengambil berita dari NewsAPI.
- Memeriksa judul dan sumber berita.
- Membuka tautan berita.
- Memeriksa tampilan artikel.

## Author

Muhammad Fajjar Fauzani

Sistem Informasi
Universitas Nusantara PGRI Kediri