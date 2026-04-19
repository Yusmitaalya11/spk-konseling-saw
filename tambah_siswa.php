<?php
// ============================================
// tambah_siswa.php
// Endpoint AJAX untuk menambah data siswa baru
// ============================================

include 'koneksi.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama        = mysqli_real_escape_string($conn, trim($_POST['nama']));
    $kelas       = mysqli_real_escape_string($conn, trim($_POST['kelas']));
    $c1          = floatval($_POST['c1_jumlah_nilai']);
    $c2          = floatval($_POST['c2_rata_rata']);
    $c3          = intval($_POST['c3_pelanggaran']);
    $tahun       = mysqli_real_escape_string($conn, trim($_POST['tahun_ajaran'] ?? '2025/2026'));

    // Validasi input
    if (empty($nama) || $c1 <= 0 || $c2 <= 0 || $c3 < 0) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap atau tidak valid!']);
        exit;
    }

    // Insert ke tabel siswa
    $sql_siswa = "INSERT INTO siswa (nama, kelas, tahun_ajaran)
                  VALUES ('$nama', '$kelas', '$tahun')";
    $ok = mysqli_query($conn, $sql_siswa);

    if (!$ok) {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data siswa: ' . mysqli_error($conn)]);
        exit;
    }

    $siswa_id = mysqli_insert_id($conn);

    // Insert ke tabel nilai
    $sql_nilai = "INSERT INTO nilai_siswa (siswa_id, c1_jumlah_nilai, c2_rata_rata, c3_pelanggaran)
                  VALUES ($siswa_id, $c1, $c2, $c3)";
    $ok2 = mysqli_query($conn, $sql_nilai);

    if (!$ok2) {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan nilai: ' . mysqli_error($conn)]);
        exit;
    }

    echo json_encode([
        'status'  => 'ok',
        'message' => "Data siswa '$nama' berhasil ditambahkan!",
        'id'      => $siswa_id
    ]);

} else {
    echo json_encode(['status' => 'error', 'message' => 'Method tidak valid.']);
}
?>
