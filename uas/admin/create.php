<?php
session_start();
include 'koneksi.php';

// Periksa apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $tipe_user = $_POST['tipe_user'];

    // Periksa apakah ada foto yang diupload
    if ($_FILES['foto_profil']['error'] === UPLOAD_ERR_OK) {
        $foto_profil = 'uploads/' . $_FILES['foto_profil']['name'];
        move_uploaded_file($_FILES['foto_profil']['tmp_name'], $foto_profil);
    } else {
        $foto_profil = null; // Set null jika tidak ada foto diupload
    }

    // Simpan data pengguna baru ke database
    $stmt = $pdo->prepare("INSERT INTO Users (nama_lengkap, email, nomor_telepon, alamat, jenis_kelamin, tanggal_lahir, tipe_user, foto_profil) 
                           VALUES (:nama_lengkap, :email, :nomor_telepon, :alamat, :jenis_kelamin, :tanggal_lahir, :tipe_user, :foto_profil)");
    $stmt->bindParam(':nama_lengkap', $nama_lengkap);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':nomor_telepon', $nomor_telepon);
    $stmt->bindParam(':alamat', $alamat);
    $stmt->bindParam(':jenis_kelamin', $jenis_kelamin);
    $stmt->bindParam(':tanggal_lahir', $tanggal_lahir);
    $stmt->bindParam(':tipe_user', $tipe_user);
    $stmt->bindParam(':foto_profil', $foto_profil);

    if ($stmt->execute()) {
        echo "Pengguna baru berhasil ditambahkan.";
    } else {
        echo "Terjadi kesalahan saat menambahkan pengguna.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pengguna Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }
        .container {
            width: 70%;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="email"], input[type="password"], input[type="tel"], input[type="date"], select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 5px;
        }
        button {
            background-color: #2a9d8f;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #21867a;
        }
        @media (max-width: 768px) {
            .container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Pengguna Baru</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap:</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="nomor_telepon">Nomor Telepon:</label>
                <input type="text" id="nomor_telepon" name="nomor_telepon" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea id="alamat" name="alamat" required></textarea>
            </div>

            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin:</label>
                <select id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir:</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>
            </div>

            <div class="form-group">
                <label for="tipe_user">Tipe User:</label>
                <select id="tipe_user" name="tipe_user" required>
                    <option value="Customer">Customer</option>
                    <option value="Admin">Admin</option>
                    <option value="Pimpinan">Pimpinan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="foto_profil">Unggah Foto Profil (Opsional):</label>
                <input type="file" id="foto_profil" name="foto_profil" accept="image/*">
            </div>

            <button type="submit">Tambah Pengguna</button>
        </form>
    </div>
</body>
</html>