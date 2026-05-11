<?php
// ============================================
// integrasi.php
// PERTEMUAN 9: Integrasi PHP + MySQL + FastAPI ML
// Tujuan: PHP mengambil data dari MySQL,
//         kirim ke API ML, gabungkan skor SAW + ML
//         → ranking hybrid
// ============================================

include 'koneksi.php';
header('Content-Type: application/json');

// -----------------------------------------------
// LANGKAH 1: Ambil semua data siswa dari database
// -----------------------------------------------
$sql = "SELECT s.id, s.nama,
               n.c1_jumlah_nilai, n.c2_rata_rata, n.c3_pelanggaran
        FROM siswa s
        JOIN nilai_siswa n ON s.id = n.siswa_id
        ORDER BY s.id";
$res  = mysqli_query($conn, $sql);
$data = mysqli_fetch_all($res, MYSQLI_ASSOC);

if (empty($data)) {
    echo json_encode(['status' => 'error', 'message' => 'Data siswa kosong.']);
    exit;
}

// -----------------------------------------------
// LANGKAH 2: Siapkan payload untuk dikirim ke API ML
// -----------------------------------------------
$payload = array_map(fn($d) => [
    'nama'         => $d['nama'],
    'jumlah_nilai' => (float) $d['c1_jumlah_nilai'],
    'rata_rata'    => (float) $d['c2_rata_rata'],
    'pelanggaran'  => (int)   $d['c3_pelanggaran'],
], $data);

// -----------------------------------------------
// LANGKAH 3: Kirim request ke FastAPI via cURL
// FastAPI berjalan di http://127.0.0.1:8000
// -----------------------------------------------
$ch = curl_init("http://127.0.0.1:8000/prediksi-batch");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json'
]);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$response  = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curl_error = curl_error($ch);
curl_close($ch);

if ($curl_error) {
    echo json_encode([
        'status'  => 'error',
        'message' => 'Tidak dapat terhubung ke API ML. Pastikan FastAPI sudah berjalan.',
        'detail'  => $curl_error,
        'cara'    => 'Jalankan: uvicorn api_ml:app --reload --port 8000'
    ]);
    exit;
}

if ($http_code !== 200) {
    echo json_encode(['status' => 'error', 'message' => "API ML error: HTTP $http_code"]);
    exit;
}

// -----------------------------------------------
// LANGKAH 4: Parse hasil prediksi dari API ML
// -----------------------------------------------
$api_result = json_decode($response, true);
$prediksi   = $api_result['hasil'];

// -----------------------------------------------
// LANGKAH 5: Hitung skor SAW untuk setiap siswa
// -----------------------------------------------
$max_c1 = max(array_column($data, 'c1_jumlah_nilai')); // MAX benefit
$max_c2 = max(array_column($data, 'c2_rata_rata'));     // MAX benefit
$min_c3 = min(array_column($data, 'c3_pelanggaran'));   // MIN cost

$w1 = 0.4; // bobot C1
$w2 = 0.4; // bobot C2
$w3 = 0.2; // bobot C3

// Bobot kontribusi hybrid
$bobot_saw = 0.7; // SAW berkontribusi 70% ke skor akhir
$bobot_ml  = 0.3; // ML berkontribusi 30% ke skor akhir

// -----------------------------------------------
// LANGKAH 6: Gabungkan skor SAW + ML (Hybrid SPK)
// Skor Hybrid = (0.7 × Skor SAW) + (0.3 × Probabilitas ML)
// -----------------------------------------------
$hasil_hybrid = [];

foreach ($data as $i => $row) {
    // Normalisasi SAW
    $r1 = $row['c1_jumlah_nilai'] / $max_c1;
    $r2 = $row['c2_rata_rata']    / $max_c2;
    $r3 = $min_c3 / $row['c3_pelanggaran'];

    // Skor SAW
    $skor_saw = ($w1 * $r1) + ($w2 * $r2) + ($w3 * $r3);

    // Ambil hasil prediksi ML untuk siswa ini
    $proba_ml = $prediksi[$i]['proba_prio']; // probabilitas label=1 (prioritas)
    $label_ml = $prediksi[$i]['label'];

    // Skor Hybrid: 70% SAW + 30% probabilitas ML
    $skor_hybrid = ($bobot_saw * $skor_saw) + ($bobot_ml * $proba_ml);

    // Tentukan prioritas berdasarkan skor hybrid
    if ($skor_hybrid >= 0.85)      $prioritas = 'Tinggi';
    elseif ($skor_hybrid >= 0.70)  $prioritas = 'Sedang';
    else                           $prioritas = 'Rendah';

    $hasil_hybrid[] = [
        'nama'         => $row['nama'],
        'r1'           => round($r1, 4),
        'r2'           => round($r2, 4),
        'r3'           => round($r3, 4),
        'skor_saw'     => round($skor_saw, 4),
        'prediksi_ml'  => $label_ml ? 'Prioritas' : 'Tidak',
        'proba_ml'     => round($proba_ml, 4),
        'skor_hybrid'  => round($skor_hybrid, 4),
        'prioritas'    => $prioritas,
    ];
}

// -----------------------------------------------
// LANGKAH 7: Ranking berdasarkan skor hybrid
// -----------------------------------------------
usort($hasil_hybrid, fn($a, $b) => $b['skor_hybrid'] <=> $a['skor_hybrid']);

foreach ($hasil_hybrid as $rank => &$item) {
    $item['peringkat'] = $rank + 1;
}
unset($item);

// -----------------------------------------------
// LANGKAH 8: Kembalikan hasil sebagai JSON
// -----------------------------------------------
echo json_encode([
    'status'     => 'ok',
    'total'      => count($hasil_hybrid),
    'bobot_saw'  => $bobot_saw,
    'bobot_ml'   => $bobot_ml,
    'rumus'      => 'Skor Hybrid = (0.7 × Skor SAW) + (0.3 × Probabilitas ML)',
    'ranking'    => $hasil_hybrid,
]);
?>
