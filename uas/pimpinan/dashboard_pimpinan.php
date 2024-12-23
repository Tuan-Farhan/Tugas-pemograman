<?php
session_start();
include 'koneksi.php'; // Pastikan ini ada sebelum melakukan query

// Cek apakah pengguna sudah login
if (!isset($_SESSION['pimpinan_logged_in']) || $_SESSION['pimpinan_logged_in'] !== true) {
    header("Location: login_pimpinan.php"); // Arahkan ke halaman login jika belum login
    exit;
}

// Ambil ID pimpinan dari session
$pimpinan_id = $_SESSION['pimpinan_id'];

// Koneksi ke database
include 'koneksi.php'; // Pastikan ini ada sebelum melakukan query
 
// Ambil data pimpinan dari database
$stmt = $pdo->prepare("SELECT * FROM Users WHERE id = :id");
$stmt->bindParam(':id', $pimpinan_id);
$stmt->execute();
$pimpinan = $stmt->fetch(PDO::FETCH_ASSOC); // Ambil hasil sebagai array asosiatif

// Cek apakah data pimpinan ditemukan
if (!$pimpinan) {
    echo "Data pimpinan tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pimpinan</title>
    <link rel="stylesheet" href="style.css"> <!-- Ganti dengan file CSS Anda -->
</head>
<body>
    <div class="dashboard-container">
        <h1>Selamat Datang, <?= htmlspecialchars($pimpinan['nama_lengkap']) ?></h1>
        <p>Ini adalah dashboard pimpinan.</p>

        <div class="menu">
    <a href="download_laporan.php" class="button">Download Laporan PDF</a>
    <a href="cetak_laporan.php" class="button">Cetak Laporan</a>
    <a href="logout.php" class="button logout">Logout</a>
</div>


        <h2>Informasi Pimpinan</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Tipe User</th>
            </tr>
            <tr>
                <td><?= htmlspecialchars($pimpinan['id']) ?></td>
                <td><?= htmlspecialchars($pimpinan['nama_lengkap']) ?></td>
                <td><?= htmlspecialchars($pimpinan['email']) ?></td>
                <td><?= htmlspecialchars($pimpinan['tipe_user']) ?></td>
            </tr>
        </table>
    </div ```php
</body>
</html>