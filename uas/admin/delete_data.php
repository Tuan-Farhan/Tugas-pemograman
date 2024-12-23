<?php
include 'koneksi.php';
session_start();

// Periksa apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

// Ambil semua data pengguna dari database
$stmt = $pdo->prepare("SELECT * FROM Users");
$stmt->execute();
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hapus Data Pengguna</title>
</head>
<body>
    <h2>Daftar Pengguna</h2>

    <form action="delete_form.php" method="GET">
        <label for="id">Pilih ID pengguna yang ingin dihapus:</label>
        <select id="id" name="id">
            <?php foreach ($users as $user): ?>
                <option value="<?= htmlspecialchars($user['id']); ?>">
                    <?= htmlspecialchars($user['id']) . " - " . htmlspecialchars($user['nama_lengkap']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Hapus</button>
    </form>

    <br><a href="dashboard.php">Kembali ke Dashboard</a>
</body>
</html>
