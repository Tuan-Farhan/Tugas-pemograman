<?php
session_start();
include 'koneksi.php'; // Koneksi ke database

// Cek apakah pengguna sudah login
if (!isset($_SESSION['pimpinan_logged_in']) || $_SESSION['pimpinan_logged_in'] !== true) {
    header("Location: login_pimpinan.php"); // Arahkan ke halaman login jika belum login
    exit;
}

// Ambil semua data user dari tabel `users`
$stmt = $pdo->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC); // Ambil semua hasil

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan</title>
    <link rel="stylesheet" href="style.css"> <!-- Ganti dengan file CSS Anda -->
</head>
<body>
    <div class="laporan-container">
        <h1>Laporan Data Pengguna</h1>

        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Nomor Telepon</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Tipe User</th>
            </tr>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['id']) ?></td>
                <td><?= htmlspecialchars($user['nama_lengkap']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['nomor_telepon']) ?></td>
                <td><?= htmlspecialchars($user['jenis_kelamin']) ?></td>
                <td><?= htmlspecialchars($user['tanggal_lahir']) ?></td>
                <td><?= htmlspecialchars($user['tipe_user']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

        <br>
        <button onclick="window.print();">Cetak Laporan</button>
    </div>
</body>
</html>
