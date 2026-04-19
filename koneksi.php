<?php
// ============================================
// koneksi.php
// Jembatan antara PHP dan database MySQL
// ============================================

$host     = "localhost";
$user     = "root";       // user default XAMPP
$password = "";           // kosong di XAMPP lokal
$database = "spk_konseling";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die(json_encode([
        'status' => 'error',
        'message' => 'Koneksi database gagal: ' . mysqli_connect_error()
    ]));
}

mysqli_set_charset($conn, "utf8");
?>
