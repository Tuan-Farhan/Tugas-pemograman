<?php
include 'koneksi.php';
session_start();

// Periksa apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

// Periksa apakah ID pengguna ada di POST request
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Hapus pengguna dari database
    $stmt = $pdo->prepare("DELETE FROM Users WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "Pengguna berhasil dihapus.";
    } else {
        echo "Terjadi kesalahan saat menghapus pengguna.";
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}
?>

<br><a href="delete_data.php">Kembali ke Daftar Pengguna</a>
