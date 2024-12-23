<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

include 'koneksi.php';

// Ambil semua data user
$stmt = $pdo->query("SELECT * FROM Users WHERE tipe_user != 'Admin'");

echo "<h2>Kelola Data Pengguna</h2>";

echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>";

while ($user = $stmt->fetch()) {
    echo "<tr>
            <td>{$user['id']}</td>
            <td>{$user['nama_lengkap']}</td>
            <td>{$user['email']}</td>
            <td>
                <a href='update.php?id={$user['id']}'>Edit</a> | 
                <a href='delete.php?id={$user['id']}'>Hapus</a>
            </td>
          </tr>";
}

echo "</table>";
?>
