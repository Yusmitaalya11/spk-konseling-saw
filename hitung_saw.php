<?php
// ============================================
// hitung_saw.php
// Core perhitungan metode SAW
// Rumus: V = (0.4×R1) + (0.4×R2) + (0.2×R3)
// C1, C2 = benefit | C3 = cost
// ============================================

include 'koneksi.php';
header('Content-Type: application/json');

// -----------------------------------------------
// LANGKAH 1: Ambil semua data siswa + nilai
// -----------------------------------------------
$sql = "SELECT s.id, s.nama, s.kelas,
               n.c1_jumlah_nilai, n.c2_rata_rata, n.c3_pelanggaran
        FROM siswa s
        JOIN nilai_siswa n ON s.id = n.siswa_id
        ORDER BY s.id";

$res  = mysqli_query($conn, $sql);
$data = mysqli_fetch_all($res, MYSQLI_ASSOC);

if (empty($data)) {
    echo json_encode(['status' => 'error', 'message' => 'Data siswa kosong']);
    exit;
}

// -----------------------------------------------
// LANGKAH 2: Ambil bobot dari tabel kriteria
// -----------------------------------------------
$res_k   = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id");
$kriteria = mysqli_fetch_all($res_k, MYSQLI_ASSOC);

// Bobot: C1=0.4 (benefit), C2=0.4 (benefit), C3=0.2 (cost)
$bobot = [];
foreach ($kriteria as $k) {
    $bobot[$k['kode']] = [
        'bobot' => $k['bobot'],
        'tipe'  => $k['tipe'],
        'nama'  => $k['nama']
    ];
}

// -----------------------------------------------
// LANGKAH 3: Tentukan MAX/MIN untuk normalisasi
// -----------------------------------------------
$max_c1 = max(array_column($data, 'c1_jumlah_nilai')); // MAX benefit
$max_c2 = max(array_column($data, 'c2_rata_rata'));     // MAX benefit
$min_c3 = min(array_column($data, 'c3_pelanggaran'));   // MIN cost

// -----------------------------------------------
// LANGKAH 4: Normalisasi setiap alternatif
//   Benefit: Rij = Xij / max(Xj)
//   Cost:    Rij = min(Xj) / Xij
// -----------------------------------------------
$hasil = [];

foreach ($data as $row) {
    $r1 = $row['c1_jumlah_nilai'] / $max_c1;   // benefit
    $r2 = $row['c2_rata_rata']    / $max_c2;   // benefit
    $r3 = $min_c3 / $row['c3_pelanggaran'];    // cost

    // LANGKAH 5: Hitung skor akhir
    // V = (w1 × R1) + (w2 × R2) + (w3 × R3)
    $skor = ($bobot['C1']['bobot'] * $r1)
          + ($bobot['C2']['bobot'] * $r2)
          + ($bobot['C3']['bobot'] * $r3);

    // Tentukan status prioritas berdasarkan skor
    if ($skor >= 0.85) {
        $prioritas = 'Tinggi';
    } elseif ($skor >= 0.75) {
        $prioritas = 'Sedang';
    } else {
        $prioritas = 'Rendah';
    }

    $hasil[] = [
        'id'            => $row['id'],
        'nama'          => $row['nama'],
        'kelas'         => $row['kelas'],
        'c1'            => $row['c1_jumlah_nilai'],
        'c2'            => $row['c2_rata_rata'],
        'c3'            => $row['c3_pelanggaran'],
        'r1'            => round($r1, 4),
        'r2'            => round($r2, 4),
        'r3'            => round($r3, 4),
        'skor_akhir'    => round($skor, 4),
        'prioritas'     => $prioritas,
    ];
}

// -----------------------------------------------
// LANGKAH 6: Urutkan dari skor tertinggi
// -----------------------------------------------
usort($hasil, fn($a, $b) => $b['skor_akhir'] <=> $a['skor_akhir']);

// Tambahkan nomor peringkat
foreach ($hasil as $i => &$item) {
    $item['peringkat'] = $i + 1;
}
unset($item);

// -----------------------------------------------
// LANGKAH 7: Simpan hasil ke database hasil_saw
// -----------------------------------------------
mysqli_query($conn, "DELETE FROM hasil_saw"); // hapus hasil lama dulu

foreach ($hasil as $item) {
    $id      = $item['id'];
    $r1      = $item['r1'];
    $r2      = $item['r2'];
    $r3      = $item['r3'];
    $skor    = $item['skor_akhir'];
    $rank    = $item['peringkat'];
    $prior   = $item['prioritas'];

    mysqli_query($conn,
        "INSERT INTO hasil_saw (siswa_id, r1, r2, r3, skor_akhir, peringkat, prioritas)
         VALUES ($id, $r1, $r2, $r3, $skor, $rank, '$prior')"
    );
}

// -----------------------------------------------
// LANGKAH 8: Kirim hasil ke frontend sebagai JSON
// -----------------------------------------------
echo json_encode([
    'status'     => 'ok',
    'max_c1'     => $max_c1,
    'max_c2'     => $max_c2,
    'min_c3'     => $min_c3,
    'bobot'      => $bobot,
    'total_data' => count($hasil),
    'data'       => $hasil
]);
?>
