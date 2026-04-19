# SPK PRIORITAS KONSELING SISWA
### Yusmita Alya Melanie | 235150601111027 | Universitas Brawijaya 2026

---

## 📁 STRUKTUR FILE

```
spk_konseling/
├── database.sql        → Script SQL (jalankan pertama kali di phpMyAdmin)
├── koneksi.php         → Koneksi PHP ke MySQL
├── index.php           → Frontend utama (halaman utama aplikasi)
├── hitung_saw.php      → Core perhitungan SAW (dipanggil via AJAX)
├── tambah_siswa.php    → Endpoint AJAX tambah data siswa
├── hapus_siswa.php     → Endpoint AJAX hapus data siswa
└── README.md           → Panduan ini
```

---

## 🚀 CARA MENJALANKAN DI XAMPP

### Langkah 1 — Persiapan
1. Install XAMPP (pastikan Apache + MySQL aktif)
2. Buka XAMPP Control Panel → Start **Apache** dan **MySQL**

### Langkah 2 — Copy File
1. Copy seluruh folder `spk_konseling` ke:
   ```
   C:\xampp\htdocs\spk_konseling\
   ```

### Langkah 3 — Import Database
1. Buka browser → http://localhost/phpmyadmin
2. Klik **"New"** di sidebar kiri
3. Atau langsung klik tab **SQL**
4. Copy-paste seluruh isi file `database.sql`
5. Klik **"Go"** / **Execute**
6. Database `spk_konseling` akan terbuat beserta semua tabelnya

### Langkah 4 — Jalankan Aplikasi
1. Buka browser
2. Akses: **http://localhost/spk_konseling/index.php**

---

## ⚙️ KONFIGURASI DATABASE

Jika password MySQL kamu bukan kosong, edit file `koneksi.php`:

```php
$host     = "localhost";
$user     = "root";
$password = "";          // ganti jika ada password
$database = "spk_konseling";
```

---

## 📊 STUDI KASUS

**Tujuan:** Menentukan siswa yang perlu diprioritaskan mendapat layanan konseling BK

### Kriteria SAW:
| Kode | Nama | Bobot | Tipe |
|------|------|-------|------|
| C1 | Jumlah Nilai Akademik | 0.4 | Benefit |
| C2 | Nilai Rata-rata Akademik | 0.4 | Benefit |
| C3 | Poin Pelanggaran | 0.2 | Cost |

### Rumus Normalisasi:
- **Benefit:** Rij = Xij / max(Xj)
- **Cost:** Rij = min(Xj) / Xij

### Rumus Skor Akhir:
```
V = (0.4 × R1) + (0.4 × R2) + (0.2 × R3)
```

### Klasifikasi Prioritas:
- 🔴 **TINGGI** → V ≥ 0.85
- 🟡 **SEDANG** → 0.75 ≤ V < 0.85
- 🟢 **RENDAH** → V < 0.75

---

## 💡 FITUR APLIKASI

- ✅ Tampil data 36 siswa + nilai kriteria
- ✅ Hitung SAW secara otomatis (klik 1 tombol)
- ✅ Tampilkan ranking + skor + status prioritas
- ✅ Tambah data siswa baru via form
- ✅ Hapus data siswa
- ✅ Simpan hasil ke database `hasil_saw`
- ✅ Tampilkan info kriteria & bobot
- ✅ UI modern dark theme + responsive

---

## 🐛 TROUBLESHOOTING

| Masalah | Solusi |
|---------|--------|
| Halaman putih kosong | Cek error PHP di XAMPP error log |
| "Koneksi database gagal" | Pastikan MySQL aktif di XAMPP, cek password di koneksi.php |
| Data tidak tampil | Pastikan sudah import database.sql di phpMyAdmin |
| Tombol SAW tidak merespons | Cek apakah file hitung_saw.php ada di folder yang sama |
