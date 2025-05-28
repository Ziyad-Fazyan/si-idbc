# Dokumentasi API Absensi Wajah

## Deskripsi

API ini menyediakan endpoint untuk autentikasi admin dan absensi wajah mahasiswa menggunakan kamera. API ini diintegrasikan dengan aplikasi Flutter untuk memudahkan proses absensi.

## Endpoint API

### Autentikasi

#### Login Admin

```
POST /api/login
```

**Request Body:**
```json
{
  "email": "email@example.com",
  "password": "password"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Login berhasil",
  "user": {
    "id": 1,
    "name": "Admin Name",
    "email": "email@example.com",
    "type": 2
  },
  "token": "token_value"
}
```

### Absensi

#### Absensi Wajah

```
POST /api/absensi/wajah
```

**Headers:**
```
Authorization: Bearer {token}
Accept: application/json
```

**Request Body (Form-Data):**
```
foto: [file gambar]
mahasiswa_id: 1
jadwal_id: 1
latitude: -6.123456 (opsional)
longitude: 106.123456 (opsional)
```

**Response:**
```json
{
  "success": true,
  "message": "Absensi berhasil disimpan",
  "data": {...}
}
```

#### Jadwal Hari Ini

```
GET /api/jadwal/hari-ini?mahasiswa_id=1
```

**Headers:**
```
Authorization: Bearer {token}
Accept: application/json
```

**Response:**
```json
{
  "success": true,
  "data": [...]
}
```

#### Riwayat Absensi

```
GET /api/absensi/riwayat?mahasiswa_id=1
```

**Headers:**
```
Authorization: Bearer {token}
Accept: application/json
```

**Response:**
```json
{
  "success": true,
  "data": {...}
}
```

## Cara Penggunaan

1. Pastikan server Laravel berjalan
2. Gunakan endpoint `/api/login` untuk mendapatkan token autentikasi
3. Gunakan token tersebut untuk mengakses endpoint absensi

## Integrasi dengan Flutter

Aplikasi Flutter telah diintegrasikan dengan API ini. Setelah login berhasil, pengguna akan diarahkan ke halaman absensi kamera yang terhubung dengan API Laravel.

### Fitur Aplikasi Flutter

1. Login admin
2. Absensi menggunakan kamera
3. Melihat jadwal hari ini
4. Geolokasi untuk mengetahui posisi saat absensi

### Cara Menjalankan Aplikasi Flutter

1. Pastikan server Laravel berjalan
2. Sesuaikan URL API di file login dan absensi jika diperlukan
3. Jalankan aplikasi Flutter dengan perintah `flutter run`

## Catatan Penting

- Pastikan izin kamera dan lokasi diaktifkan di perangkat
- Absensi hanya dapat dilakukan pada jadwal yang tersedia hari ini
- Absensi hanya dapat dilakukan dalam rentang waktu yang ditentukan (15 menit sebelum dan 30 menit setelah jadwal mulai)