# TUGAS BESAR - Sistem Manajemen Akademik

**Anggota Tim:** 2472001 | 2472009 | 2472056

---

## 🔄 ALUR PROGRAM

### 1️⃣ **ALUR AWAL (Belum Login)**

```
index.php / login.php
    ↓
User masuk Username & Password
    ↓
Validasi di Database (koneksi.php)
    ↓
├─ ✅ Login Berhasil → Set Session → Arahkan sesuai Role
│
└─ ❌ Login Gagal → Tampilkan Error Message
```

---

### 2️⃣ **ALUR ADMIN**

```
LOGIN ADMIN
    ↓
admin/dashboard.php (Dashboard)
    ↓
MENU PILIHAN:
├─ 📊 DASHBOARD → Lihat Statistik
├─ 👨‍🏫 MANAJEMEN DOSEN
│  ├─ admin/dosen/index.php (Lihat daftar dosen)
│  ├─ admin/dosen/tambah.php (Form tambah dosen)
│  ├─ admin/dosen/simpan.php (Proses simpan ke DB)
│  ├─ admin/dosen/edit.php (Form edit dosen)
│  ├─ admin/dosen/update.php (Proses update ke DB)
│  ├─ admin/dosen/hapus.php (Proses hapus dari DB)
│  └─ admin/dosen/detail.php (Lihat detail dosen)
│
├─ 🎓 MANAJEMEN MAHASISWA
│  ├─ admin/mahasiswa/index.php (Lihat daftar mahasiswa)
│  ├─ admin/mahasiswa/tambah.php (Form tambah mahasiswa)
│  ├─ admin/mahasiswa/simpan.php (Proses simpan ke DB)
│  ├─ admin/mahasiswa/edit.php (Form edit mahasiswa)
│  ├─ admin/mahasiswa/update.php (Proses update ke DB)
│  ├─ admin/mahasiswa/hapus.php (Proses hapus dari DB)
│  └─ admin/mahasiswa/detail.php (Lihat detail mahasiswa)
│
├─ 🏢 MANAJEMEN FAKULTAS
│  ├─ admin/fakultas/index.php (Lihat daftar fakultas)
│  ├─ admin/fakultas/tambah.php (Form tambah fakultas)
│  ├─ admin/fakultas/simpan.php (Proses simpan ke DB)
│  ├─ admin/fakultas/edit.php (Form edit fakultas)
│  ├─ admin/fakultas/update.php (Proses update ke DB)
│  └─ admin/fakultas/hapus.php (Proses hapus dari DB)
│
├─ 📚 MANAJEMEN PRODI
│  ├─ admin/prodi/index.php (Lihat daftar prodi)
│  ├─ admin/prodi/tambah.php (Form tambah prodi)
│  ├─ admin/prodi/simpan.php (Proses simpan ke DB)
│  ├─ admin/prodi/edit.php (Form edit prodi)
│  ├─ admin/prodi/update.php (Proses update ke DB)
│  └─ admin/prodi/hapus.php (Proses hapus dari DB)
│
├─ 📖 MANAJEMEN MATA KULIAH
│  ├─ admin/matakuliah/index.php (Lihat daftar mata kuliah)
│  ├─ admin/matakuliah/tambah.php (Form tambah mata kuliah)
│  ├─ admin/matakuliah/simpan.php (Proses simpan ke DB)
│  ├─ admin/matakuliah/edit.php (Form edit mata kuliah)
│  ├─ admin/matakuliah/update.php (Proses update ke DB)
│  └─ admin/matakuliah/hapus.php (Proses hapus dari DB)
│
├─ 📅 MANAJEMEN JADWAL PERKULIAHAN
│  ├─ admin/jadwal/index.php (Lihat daftar jadwal)
│  ├─ admin/jadwal/tambah.php (Form tambah jadwal)
│  ├─ admin/jadwal/simpan.php (Proses simpan ke DB)
│  ├─ admin/jadwal/edit.php (Form edit jadwal)
│  ├─ admin/jadwal/update.php (Proses update ke DB)
│  └─ admin/jadwal/hapus.php (Proses hapus dari DB)
│
└─ 🚪 LOGOUT → Session dihapus → Kembali ke login.php
```

---

### 3️⃣ **ALUR DOSEN**

```
LOGIN DOSEN
    ↓
dosen/dashboard.php (Dashboard Dosen)
    ↓
MENU PILIHAN:
├─ 📊 DASHBOARD → Lihat Overview
├─ 📅 JADWAL MENGAJAR
│  └─ dosen/jadwal.php (Lihat jadwal kelas yang diampu)
│
├─ 📝 INPUT NILAI
│  ├─ dosen/pilih_matkul.php (Pilih mata kuliah)
│  ├─ dosen/nilai.php (Form input nilai)
│  ├─ dosen/simpan_nilai.php (Proses simpan nilai ke DB)
│  └─ dosen/nilai_akhir.php (Lihat nilai akhir)
│
├─ 📋 LEMBAR PENILAIAN
│  ├─ dosen/lembar_penilaian_kat.php (Input nilai KAT)
│  ├─ dosen/lembar_penilaian_uts.php (Input nilai UTS)
│  ├─ dosen/lembar_penilaian_uas.php (Input nilai UAS)
│  └─ dosen/simpan_penilaian.php (Proses simpan penilaian)
│
├─ 👤 PROFIL
│  ├─ dosen/profile.php (Lihat profil)
│  ├─ dosen/edit.php (Form edit profil)
│  └─ dosen/update.php (Proses update profil)
│
└─ 🚪 LOGOUT → Session dihapus → Kembali ke login.php
```

---

### 4️⃣ **ALUR MAHASISWA**

```
LOGIN MAHASISWA
    ↓
mahasiswa/dashboard.php (Dashboard Mahasiswa)
    ↓
MENU PILIHAN:
├─ 📊 DASHBOARD → Lihat Overview
├─ 📅 JADWAL PERKULIAHAN
│  └─ mahasiswa/jadwal_perkuliahan.php (Lihat jadwal kuliah)
│
├─ 📊 NILAI PERKULIAHAN
│  └─ mahasiswa/nilai_perkuliahan.php (Lihat nilai mata kuliah)
│
├─ 📄 TRANSKRIP NILAI
│  └─ mahasiswa/transkrip.php (Lihat transkrip akumulatif)
│
├─ 📋 DKBS (Data Kehadiran Bukti Studi)
│  └─ mahasiswa/dkbs.php (Lihat data kehadiran)
│
├─ 🎯 UJIAN
│  ├─ mahasiswa/ujian.php (Lihat daftar ujian)
│  ├─ mahasiswa/pendaftaran_ujian.php (Daftar ujian)
│  └─ mahasiswa/simpan_ujian.php (Proses pendaftaran)
│
├─ 👤 PROFIL
│  ├─ mahasiswa/profile.php (Lihat profil)
│  ├─ mahasiswa/edit_data.php (Form edit profil)
│  └─ mahasiswa/update_data.php (Proses update profil)
│
└─ 🚪 LOGOUT → Session dihapus → Kembali ke login.php
```

---

### 5️⃣ **ALUR REGISTRASI MAHASISWA BARU**

```
index.php (Halaman Utama)
    ↓
Klik "Daftar" / Registrasi
    ↓
registrasi/registrasi.php (Form registrasi)
    ↓
Input Data Calon Mahasiswa (Nama, NIM, Email, Password, dll)
    ↓
Validasi Form (koneksi.php)
    ↓
├─ ✅ Validasi Berhasil → Simpan ke DB → Redirect ke login.php
│
└─ ❌ Validasi Gagal → Tampilkan Error
```

---

### 6️⃣ **ALUR DATABASE FLOW**

```
User Input (Form)
    ↓
PHP Page (tambah.php / edit.php / dll)
    ↓
Validasi Data
    ↓
Query ke Database
    ├─ simpan.php (INSERT)
    ├─ update.php (UPDATE)
    ├─ hapus.php (DELETE)
    └─ index.php (SELECT)
    ↓
Response ke Browser
    ↓
├─ ✅ Berhasil → Redirect ke halaman list
└─ ❌ Gagal → Tampilkan pesan error
```

---

### 7️⃣ **ALUR FILE INCLUDE (REUSABLE COMPONENTS)**

```
admin/layout/header.php → Bagian atas halaman admin
admin/layout/sidebar.php → Menu navigasi admin
admin/layout/footer.php → Bagian bawah halaman

dosen/include/sidebar.php → Menu navigasi dosen

mahasiswa/include/sidebar.php → Menu navigasi mahasiswa
```

---

### 8️⃣ **ALUR STYLING**

```
css/
├─ admin.css → Styling untuk halaman admin
├─ dashboard.css → Styling dashboard
├─ login.css → Styling halaman login
├─ style.css → Styling global
├─ sidebar.css → Styling menu sidebar
└─ [style lainnya] → Styling per fitur
```

---

## 📌 RINGKASAN FLOW

| Fase | File | Fungsi |
|------|------|--------|
| **Login** | login.php | Autentikasi user |
| **Admin** | admin/dashboard.php | Menu utama admin |
| **Dosen** | dosen/dashboard.php | Menu utama dosen |
| **Mahasiswa** | mahasiswa/dashboard.php | Menu utama mahasiswa |
| **Koneksi** | koneksi.php | Hubung ke database |
| **Logout** | logout.php | Hapus session & keluar |

---

## 🚀 Panduan Instalasi dan Menjalankan Proyek

### 1. **Persiapan Database**

1. Buka **phpMyAdmin** di browser: `http://localhost/phpmyadmin`
2. Buat database baru dengan nama: `tugas_besar_akademik` (atau nama lain sesuai preferensi)
3. Import file SQL jika tersedia, atau buat tabel secara manual sesuai struktur aplikasi

### 2. **Konfigurasi Database**

1. Buka file [koneksi.php](koneksi.php)
2. Sesuaikan parameter koneksi database:
   ```php
   $server = "localhost";
   $user = "root";
   $password = "";
   $database = "tugas_besar_akademik";
   ```
3. Pastikan kredensial sesuai dengan konfigurasi MySQL Anda

### 3. **Menempatkan File Proyek**

1. Copy/paste seluruh folder proyek ke direktori:
   ```
   C:\xampp\htdocs\
   ```
   Struktur akhir:
   ```
   C:\xampp\htdocs\Tugas_Besar_2472001_2472009_2472056\
   ```

### 4. **Menjalankan Aplikasi**

1. **Pastikan XAMPP Berjalan:**
   - Buka XAMPP Control Panel
   - Klik tombol "Start" untuk Apache dan MySQL

2. **Akses Aplikasi:**
   - Buka browser dan masukkan URL: `http://localhost/Tugas_Besar_2472001_2472009_2472056/`
   - Atau langsung ke halaman login: `http://localhost/Tugas_Besar_2472001_2472009_2472056/login.php`

---

## 👥 Akun Login Default

Aplikasi menyediakan tiga tipe pengguna:

### 1. **Admin**
   - Username: `admin`
   - Password: `admin123`
   - Akses: Dashboard admin, manajemen data master (dosen, mahasiswa, fakultas, prodi, mata kuliah, jadwal)

### 2. **Dosen**
   - Username: `dosen1`
   - Password: `dosen123`
   - Akses: Dashboard dosen, input nilai, lembar penilaian (KAT, UTS, UAS)

### 3. **Mahasiswa**
   - Username: `mhs001`
   - Password: `mhs123`
   - Akses: Dashboard mahasiswa, lihat jadwal, lihat nilai, transkrip

---

## 📂 Struktur Folder

```
Tugas_Besar_2472001_2472009_2472056/
├── index.php                 # Halaman utama
├── login.php                 # Halaman login
├── logout.php                # Proses logout
├── koneksi.php              # Konfigurasi database
│
├── admin/                   # Modul admin
│   ├── dashboard.php
│   ├── dosen/              # Manajemen dosen
│   ├── mahasiswa/          # Manajemen mahasiswa
│   ├── fakultas/           # Manajemen fakultas
│   ├── prodi/              # Manajemen program studi
│   ├── matakuliah/         # Manajemen mata kuliah
│   ├── jadwal/             # Manajemen jadwal
│   └── layout/             # Template (header, sidebar, footer)
│
├── dosen/                   # Modul dosen
│   ├── dashboard.php
│   ├── jadwal.php
│   ├── nilai.php
│   ├── lembar_penilaian_*.php
│   └── include/            # Include files
│
├── mahasiswa/              # Modul mahasiswa
│   ├── dashboard.php
│   ├── jadwal_perkuliahan.php
│   ├── nilai_perkuliahan.php
│   ├── transkrip.php
│   └── include/            # Include files
│
├── registrasi/             # Modul registrasi
│
├── css/                    # File stylesheet
│
├── img/                    # Folder untuk gambar
│
└── README.md              # Dokumentasi ini
```

---

## ⚙️ Fitur Utama

### Admin
- ✅ Dashboard dengan statistik
- ✅ Manajemen Data Dosen
- ✅ Manajemen Data Mahasiswa
- ✅ Manajemen Fakultas
- ✅ Manajemen Program Studi (Prodi)
- ✅ Manajemen Mata Kuliah
- ✅ Manajemen Jadwal Perkuliahan

### Dosen
- ✅ Dashboard Dosen
- ✅ Lihat Jadwal Mengajar
- ✅ Input Nilai Mahasiswa
- ✅ Lembar Penilaian (KAT, UTS, UAS)
- ✅ Nilai Akhir Perkuliahan
- ✅ Edit Profil

### Mahasiswa
- ✅ Dashboard Mahasiswa
- ✅ Lihat Jadwal Perkuliahan
- ✅ Lihat Nilai Perkuliahan
- ✅ Lihat Transkrip Nilai
- ✅ Lihat DKBS (Data Kehadiran Bukti Studi)
- ✅ Pendaftaran Ujian
- ✅ Edit Profil

---

## 🔧 Troubleshooting

### Halaman Tidak Terbuka
- **Solusi:** Pastikan Apache dan MySQL di XAMPP sudah berjalan
- Cek URL di browser: `http://localhost/Tugas_Besar_2472001_2472009_2472056/`

### Koneksi Database Gagal
- **Solusi:** Periksa file [koneksi.php](koneksi.php)
- Pastikan MySQL sudah running
- Verifikasi kredensial database (username, password, nama database)

### Halaman Kosong atau Error 500
- **Solusi:** 
- Cek error log Apache di `C:\xampp\apache\logs\`
- Pastikan ekstensi PHP yang diperlukan aktif (mysqli, PDO)

### Session/Login Tidak Bekerja
- **Solusi:** Pastikan folder `sessions` (jika ada) memiliki permission write
- Atau gunakan database sessions jika dikonfigurasi

---

## 📝 Catatan Penting

- Jangan ubah struktur folder aplikasi setelah deployment
- Selalu backup database sebelum melakukan perubahan data
- Untuk production, ubah password default semua akun pengguna
- Pastikan file [koneksi.php](koneksi.php) tidak dapat diakses publik
