-- ============================================
-- DATABASE SPK PRIORITAS KONSELING SISWA
-- Yusmita Alya Melanie - 235150601111027
-- Universitas Brawijaya 2026
-- ============================================

CREATE DATABASE IF NOT EXISTS spk_konseling;
USE spk_konseling;

-- Tabel data siswa (alternatif)
CREATE TABLE IF NOT EXISTS siswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(150) NOT NULL,
    kelas VARCHAR(20),
    tahun_ajaran VARCHAR(10) DEFAULT '2025/2026'
);

-- Tabel kriteria
CREATE TABLE IF NOT EXISTS kriteria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode VARCHAR(10) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    bobot FLOAT NOT NULL,
    tipe ENUM('benefit','cost') NOT NULL
);

-- Tabel nilai per siswa per kriteria
CREATE TABLE IF NOT EXISTS nilai_siswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    siswa_id INT NOT NULL,
    c1_jumlah_nilai FLOAT NOT NULL,   -- Benefit
    c2_rata_rata FLOAT NOT NULL,       -- Benefit
    c3_pelanggaran INT NOT NULL,       -- Cost
    FOREIGN KEY (siswa_id) REFERENCES siswa(id) ON DELETE CASCADE
);

-- Tabel hasil perhitungan SAW
CREATE TABLE IF NOT EXISTS hasil_saw (
    id INT AUTO_INCREMENT PRIMARY KEY,
    siswa_id INT NOT NULL,
    r1 FLOAT,
    r2 FLOAT,
    r3 FLOAT,
    skor_akhir FLOAT,
    peringkat INT,
    prioritas ENUM('Tinggi','Sedang','Rendah'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (siswa_id) REFERENCES siswa(id) ON DELETE CASCADE
);

-- ============================================
-- INSERT DATA KRITERIA
-- ============================================
INSERT INTO kriteria (kode, nama, bobot, tipe) VALUES
('C1', 'Jumlah Nilai Akademik', 0.4, 'benefit'),
('C2', 'Nilai Rata-rata Akademik', 0.4, 'benefit'),
('C3', 'Jumlah Poin Pelanggaran', 0.2, 'cost');

-- ============================================
-- INSERT DATA SISWA (36 siswa dari data project)
-- ============================================
INSERT INTO siswa (nama, kelas, tahun_ajaran) VALUES
('Achmad Zacky Wudanarrohman', 'X-TI', '2025/2026'),
('Aditya Nur Pamungkas', 'X-TI', '2025/2026'),
('Agista Rezky Ramadhan', 'X-TI', '2025/2026'),
('Ahmad Sofiyyul Mundir', 'X-TI', '2025/2026'),
('Ahzani Fiqri Maulana', 'X-TI', '2025/2026'),
('Alif Atha Al Zhafar', 'X-TI', '2025/2026'),
('Alin Rahma Aulia', 'X-TI', '2025/2026'),
('Andika Bayu Firmansyah', 'X-TI', '2025/2026'),
('Aprillia Annisa Puteri', 'X-TI', '2025/2026'),
('Aqilla Jeza Putri Rafin', 'X-TI', '2025/2026'),
('Bayu Widodo', 'X-TI', '2025/2026'),
('Bima Aditya', 'X-TI', '2025/2026'),
('Dava Alifiano Putra', 'X-TI', '2025/2026'),
('Dimaz Ihtisyama Atsaal', 'X-TI', '2025/2026'),
('Dioktavino Putra Anggoro', 'X-TI', '2025/2026'),
('Erick Pratama', 'X-TI', '2025/2026'),
('Erlangga', 'X-TI', '2025/2026'),
('Febriansyah Irvanda Mohamad', 'X-TI', '2025/2026'),
('Luqman Bintang Alamsyah', 'X-TI', '2025/2026'),
('Marchel Heydie Nottisa Yunior', 'X-TI', '2025/2026'),
('Maria Azzija Alaa', 'X-TI', '2025/2026'),
('Marvel Adriansyah Putra', 'X-TI', '2025/2026'),
('Moch Habibi Pratama', 'X-TI', '2025/2026'),
('Mohamad Riski Tri Ardiansyah', 'X-TI', '2025/2026'),
('Muh Zaidan Aditya Ramadhani', 'X-TI', '2025/2026'),
('Muhamad Syahrul Syafiil', 'X-TI', '2025/2026'),
('Muhammad Aldan Oky Muzafi', 'X-TI', '2025/2026'),
('Muhammad Alim Khaidawulan Alhaq', 'X-TI', '2025/2026'),
('Muhammad Davin Julyawan', 'X-TI', '2025/2026'),
('Nino Ramadhan Putra Wibiastono', 'X-TI', '2025/2026'),
('Raka Alamsyah', 'X-TI', '2025/2026'),
('Rizky Fadhil Ramadhan', 'X-TI', '2025/2026'),
('Satria Saktiawan', 'X-TI', '2025/2026'),
('Singgih Banyu Winarko', 'X-TI', '2025/2026'),
('Syair Banyu Biru Akbar Dharmawan', 'X-TI', '2025/2026'),
('Zidan Arkana Putra Kurnia', 'X-TI', '2025/2026');

-- ============================================
-- INSERT DATA NILAI SISWA (C1, C2, C3)
-- ============================================
INSERT INTO nilai_siswa (siswa_id, c1_jumlah_nilai, c2_rata_rata, c3_pelanggaran) VALUES
(1,  1042,    80.15, 128),
(2,  1020.03, 78.46, 115),
(3,  1090.74, 83.90, 63),
(4,  1119.23, 86.09, 42),
(5,  1020,    78.46, 58),
(6,  708.42,  54.49, 176),
(7,  1096,    84.31, 39),
(8,  1010,    77.69, 87),
(9,  1103,    84.85, 90),
(10, 1132.03, 87.08, 55),
(11, 1018,    78.31, 140),
(12, 1035,    79.62, 69),
(13, 1119.35, 86.10, 48),
(14, 1021,    78.54, 118),
(15, 1044,    80.31, 125),
(16, 1011,    77.77, 108),
(17, 1039,    79.92, 94),
(18, 1026,    78.92, 183),
(19, 1023,    78.69, 146),
(20, 778.19,  59.86, 146),
(21, 1131.52, 87.04, 27),
(22, 1039.52, 79.96, 34),
(23, 1060,    81.54, 33),
(24, 1099.42, 84.57, 54),
(25, 1075.97, 82.77, 66),
(26, 1015,    78.08, 87),
(27, 1041,    80.08, 104),
(28, 1108.61, 85.28, 52),
(29, 1156.68, 88.98, 6),
(30, 1102,    84.77, 60),
(31, 1045,    80.38, 110),
(32, 1142.23, 87.86, 33),
(33, 1034,    79.54, 52),
(34, 1000,    76.92, 178),
(35, 1034.9,  79.61, 139),
(36, 1040,    80.00, 66);
