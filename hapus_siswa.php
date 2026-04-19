<?php
// ============================================
// hapus_siswa.php
// Endpoint AJAX untuk menghapus data siswa
// ============================================

include 'koneksi.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    if ($id <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
        exit;
    }

    // Hapus hasil saw dulu (foreign key)
    mysqli_query($conn, "DELETE FROM hasil_saw WHERE siswa_id = $id");
    // Hapus nilai siswa (foreign key)
    mysqli_query($conn, "DELETE FROM nilai_siswa WHERE siswa_id = $id");
    // Hapus siswa
    $ok = mysqli_query($conn, "DELETE FROM siswa WHERE id = $id");

    if ($ok) {
        echo json_encode(['status' => 'ok', 'message' => 'Data siswa berhasil dihapus.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus: ' . mysqli_error($conn)]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Method tidak valid.']);
}
?>
