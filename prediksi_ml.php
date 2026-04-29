<?php
// ============================================
// prediksi_ml.php
// PERTEMUAN 8: Integrasi Machine Learning ke Web
// ============================================

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $jumlah_nilai = floatval($_POST['jumlah_nilai'] ?? 0);
    $rata_rata    = floatval($_POST['rata_rata']    ?? 0);
    $pelanggaran  = intval($_POST['pelanggaran']   ?? 0);
    $nama         = trim($_POST['nama']            ?? 'Siswa Baru');

    if ($jumlah_nilai <= 0 || $rata_rata <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap!']);
        exit;
    }

    // Path Python lengkap agar PHP bisa menemukannya
    $python_path = 'C:\\Users\\hp\\AppData\\Local\\Programs\\Python\\Python314\\python.exe';
    $script_path = __DIR__ . '\\prediksi_siswa.py';

    $cmd    = '"' . $python_path . '" "' . $script_path . '"'
            . ' ' . escapeshellarg($jumlah_nilai)
            . ' ' . escapeshellarg($rata_rata)
            . ' ' . escapeshellarg($pelanggaran)
            . ' 2>&1';

    $output = shell_exec($cmd);
    $result = json_decode($output, true);

    if (!$result) {
        echo json_encode([
            'status'  => 'error',
            'message' => 'Gagal menjalankan model ML.',
            'raw'     => $output
        ]);
        exit;
    }

    $result['nama']   = $nama;
    $result['status'] = 'ok';
    echo json_encode($result);

} else {
    echo json_encode(['status' => 'error', 'message' => 'Method tidak valid.']);
}
?>
