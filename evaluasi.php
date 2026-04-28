<?php
// ============================================
// evaluasi.php
// PERTEMUAN 7: Evaluasi dan Peningkatan Kinerja SPK
// Tujuan: Mengukur seberapa akurat keputusan SPK
//         dibandingkan rekomendasi pakar (ground truth)
// Metode: Spearman Rank Correlation + Akurasi Top-N
// ============================================

include 'koneksi.php';
header('Content-Type: application/json');

// -----------------------------------------------
// GROUND TRUTH dari Guru BK / Pakar Konseling
// Ranking manual berdasarkan penilaian pakar
// (1 = paling prioritas mendapat konseling)
// -----------------------------------------------
$ground_truth = [
    'Muhammad Davin Julyawan'          => 1,
    'Maria Azzija Alaa'                => 2,
    'Rizky Fadhil Ramadhan'            => 3,
    'Aqilla Jeza Putri Rafin'          => 4,
    'Ahmad Sofiyyul Mundir'            => 5,
    'Mohamad Riski Tri Ardiansyah'     => 6,
    'Dava Alifiano Putra'              => 7,
    'Alin Rahma Aulia'                 => 8,
    'Muhammad Alim Khaidawulan Alhaq'  => 9,
    'Aprillia Annisa Puteri'           => 10,
    'Nino Ramadhan Putra Wibiastono'   => 11,
    'Agista Rezky Ramadhan'            => 12,
    'Muh Zaidan Aditya Ramadhani'      => 13,
    'Moch Habibi Pratama'              => 14,
    'Muhammad Aldan Oky Muzafi'        => 15,
    'Raka Alamsyah'                    => 16,
    'Zidan Arkana Putra Kurnia'        => 17,
    'Satria Saktiawan'                 => 18,
    'Bima Aditya'                      => 19,
    'Marvel Adriansyah Putra'          => 20,
    'Dioktavino Putra Anggoro'         => 21,
    'Erlangga'                         => 22,
    'Achmad Zacky Wudanarrohman'       => 23,
    'Muhammad Aldan Oky Muzafi'        => 24,
    'Dimaz Ihtisyama Atsaal'           => 25,
    'Aditya Nur Pamungkas'             => 26,
    'Luqman Bintang Alamsyah'          => 27,
    'Febriansyah Irvanda Mohamad'      => 28,
    'Muhamad Syahrul Syafiil'          => 29,
    'Ahzani Fiqri Maulana'             => 30,
    'Andika Bayu Firmansyah'           => 31,
    'Bayu Widodo'                      => 32,
    'Erick Pratama'                    => 33,
    'Singgih Banyu Winarko'            => 34,
    'Syair Banyu Biru Akbar Dharmawan' => 35,
    'Alif Atha Al Zhafar'              => 36,
];

// -----------------------------------------------
// AMBIL HASIL SPK DARI DATABASE
// -----------------------------------------------
$sql = "SELECT s.nama, h.peringkat, h.skor_akhir, h.prioritas
        FROM hasil_saw h
        JOIN siswa s ON h.siswa_id = s.id
        ORDER BY h.peringkat ASC";
$res   = mysqli_query($conn, $sql);
$hasil = mysqli_fetch_all($res, MYSQLI_ASSOC);

if (empty($hasil)) {
    echo json_encode([
        'status'  => 'error',
        'message' => 'Belum ada hasil SAW. Jalankan hitung_saw.php terlebih dahulu.'
    ]);
    exit;
}

// -----------------------------------------------
// HITUNG SPEARMAN RANK CORRELATION
// Rumus: rs = 1 - (6 x sumD2) / (n x (n^2 - 1))
// -----------------------------------------------
$sum_d2 = 0;
$detail = [];

foreach ($hasil as $item) {
    $nama       = $item['nama'];
    $rank_spk   = (int) $item['peringkat'];
    $rank_pakar = $ground_truth[$nama] ?? null;

    if ($rank_pakar !== null) {
        $d       = $rank_spk - $rank_pakar;
        $d2      = $d * $d;
        $sum_d2 += $d2;
        $detail[] = [
            'nama'       => $nama,
            'rank_spk'   => $rank_spk,
            'rank_pakar' => $rank_pakar,
            'd'          => $d,
            'd2'         => $d2,
            'skor'       => $item['skor_akhir'],
            'prioritas'  => $item['prioritas'],
        ];
    }
}

$n  = count($detail);
$rs = round(1 - (6 * $sum_d2) / ($n * ($n * $n - 1)), 4);

// Interpretasi Spearman
if      ($rs >= 0.90) $interpretasi = 'Sangat Kuat — SPK sangat sesuai penilaian pakar';
elseif  ($rs >= 0.70) $interpretasi = 'Kuat — SPK cukup sesuai penilaian pakar';
elseif  ($rs >= 0.50) $interpretasi = 'Sedang — Bobot kriteria perlu dievaluasi';
else                  $interpretasi = 'Lemah — Bobot kriteria harus direvisi ulang';

// -----------------------------------------------
// AKURASI TOP-1, TOP-3, TOP-5
// -----------------------------------------------
$names_spk = array_column($hasil, 'nama');

// Top-1
$top1_spk   = $names_spk[0];
$top1_pakar = array_search(1, $ground_truth);
$akurasi_top1 = ($top1_spk === $top1_pakar) ? 100 : 0;

// Top-3
$top3_spk   = array_slice($names_spk, 0, 3);
$top3_pakar = array_keys(array_filter($ground_truth, fn($v) => $v <= 3));
$cocok3     = count(array_intersect($top3_spk, $top3_pakar));
$akurasi_top3 = round(($cocok3 / 3) * 100, 2);

// Top-5
$top5_spk   = array_slice($names_spk, 0, 5);
$top5_pakar = array_keys(array_filter($ground_truth, fn($v) => $v <= 5));
$cocok5     = count(array_intersect($top5_spk, $top5_pakar));
$akurasi_top5 = round(($cocok5 / 5) * 100, 2);

// -----------------------------------------------
// REKOMENDASI PERBAIKAN OTOMATIS
// -----------------------------------------------
$rekomendasi = [];

if ($rs >= 0.90) {
    $rekomendasi[] = 'Model SPK sudah sangat baik. Pertahankan bobot saat ini dan lakukan evaluasi ulang setiap semester baru.';
} elseif ($rs >= 0.70) {
    $rekomendasi[] = 'Model SPK cukup baik. Pertimbangkan penambahan data historis absensi untuk meningkatkan akurasi.';
} else {
    $rekomendasi[] = 'Bobot kriteria perlu dievaluasi ulang. Coba naikkan bobot C3 (Pelanggaran) menjadi 0.3 dan turunkan C1 atau C2.';
    $rekomendasi[] = 'Pertimbangkan menambahkan kriteria baru seperti frekuensi ketidakhadiran atau catatan konseling sebelumnya.';
}

if ($akurasi_top3 < 66.67) {
    $rekomendasi[] = 'Akurasi Top-3 masih rendah. Diskusikan kembali ground truth dengan Guru BK untuk memastikan keselarasan penilaian.';
}

// -----------------------------------------------
// KIRIM HASIL SEBAGAI JSON
// -----------------------------------------------
echo json_encode([
    'status'        => 'ok',
    'total_data'    => $n,
    'sum_d2'        => $sum_d2,
    'spearman_rs'   => $rs,
    'interpretasi'  => $interpretasi,
    'akurasi'       => [
        'top1' => $akurasi_top1 . '%',
        'top3' => $akurasi_top3 . '%',
        'top5' => $akurasi_top5 . '%',
    ],
    'top1_spk'      => $top1_spk,
    'top1_pakar'    => $top1_pakar,
    'rekomendasi'   => $rekomendasi,
    'detail'        => $detail,
]);
?>
