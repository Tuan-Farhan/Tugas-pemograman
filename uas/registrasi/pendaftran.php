<?php
require 'config.php'; // Memanggil konfigurasi database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $posisi = $_POST['posisi'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "INSERT INTO users (nama, alamat, nomor_telepon, posisi, username, password, level_user) 
              VALUES (?, ?, ?, ?, ?, ?, 'calon')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssss", $nama, $alamat, $nomor_telepon, $posisi, $username, $password);

    if ($stmt->execute()) {
        echo "Pendaftaran berhasil. <a href='login.php'>Login sekarang</a>";
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; display: flex; justify-content: center; align-items: center; height: 100vh; }
        form { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        input, button { margin-bottom: 15px; width: 100%; padding: 10px; }
        button { background: #28a745; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #218838; }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Register</h2>
        <input type="text" name="nama" placeholder="Nama Lengkap" required>
        <input type="text" name="alamat" placeholder="Alamat" required>
        <input type="text" name="nomor_telepon" placeholder="Nomor Telepon" required>
        <input type="text" name="posisi" placeholder="Posisi Pekerjaan" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Daftar</button>
    </form>
</body>
</html>