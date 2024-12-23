<?php
include 'koneksi.php';
session_start();

// Periksa apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

// Periksa apakah ID pengguna ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data pengguna berdasarkan ID
    $stmt = $pdo->prepare("SELECT * FROM Users WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $user = $stmt->fetch();

    // Jika pengguna tidak ditemukan
    if (!$user) {
        echo "Pengguna dengan ID tersebut tidak ditemukan.";
        exit;
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Konfirmasi Hapus Pengguna</title>
</head>
<body>
    <h2>Konfirmasi Hapus Pengguna</h2>
    <p>Apakah Anda yakin ingin menghapus pengguna berikut?</p>

    <ul>
        <li>ID: <?= htmlspecialchars($user['id']); ?></li>
        <li>Nama Lengkap: <?= htmlspecialchars($user['nama_lengkap']); ?></li>
        <li>Email: <?= htmlspecialchars($user['email']); ?></li>
    </ul>

    <form action="delete.php" method="POST">
        <input type="hidden" name="id" value="<?= $user['id']; ?>">
        <button type="submit">Ya, Hapus Pengguna</button>
    </form>

    <br><a href="delete_data.php">Batal</a>
</body>
</html>
