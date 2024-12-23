<?php
session_start();
include 'koneksi.php'; // Sambungkan ke database

// Cek apakah pengguna sudah login
if (isset($_SESSION['pimpinan_logged_in']) && $_SESSION['pimpinan_logged_in'] === true) {
    $pimpinan_id = $_SESSION['pimpinan_id'];

    // Catat aktivitas logout ke dalam database
    $stmt = $pdo->prepare("INSERT INTO Log (user_id, action, timestamp) VALUES (:user_id, 'Logout', NOW())");
    $stmt->bindParam(':user_id', $pimpinan_id);
    $stmt->execute();

    // Hapus semua session
    session_destroy();
}

// Redirect ke halaman login
header("Location: login_pimpinan.php");
exit;
?>