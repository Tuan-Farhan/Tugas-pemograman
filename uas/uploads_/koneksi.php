<?php
// Koneksi ke database
$pdo = new PDO("mysql:host=localhost;dbname=database_hotel", "root", "");

// Set timezone agar sesuai dengan waktu lokal (optional)
date_default_timezone_set('Asia/Jakarta');

// Pastikan folder 'uploads' ada
$target_dir = "uploads/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);  // Membuat folder uploads jika belum ada
}

// Cek koneksi
try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}

// Periksa apakah admin sudah login
session_start();
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
        // Path folder uploads
        $target_file = $target_dir . basename($_FILES["foto_profil"]["name"]);

        // Pastikan file terupload dengan benar
        if (move_uploaded_file($_FILES["foto_profil"]["tmp_name"], $target_file)) {
            echo "Foto berhasil diunggah.";
        } else {
            echo "Terjadi kesalahan saat mengunggah foto.";
        }
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
</head>
<body>
    <h2>Tambah Pengguna Baru</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="nama_lengkap">Nama Lengkap:</label>
        <input type="text" id="nama_lengkap" name="nama_lengkap" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="nomor_telepon">Nomor Telepon:</label>
        <input type="text" id="nomor_telepon" name="nomor_telepon" required><br><br>

        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat" required></textarea><br><br>

        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <select id="jenis_kelamin" name="jenis_kelamin" required>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select><br><br>

        <label for="tanggal_lahir">Tanggal Lahir:</label>
        <input type="date" id="tanggal_lahir" name="tanggal_lahir" required><br><br>

        <label for="tipe_user">Tipe User:</label>
        <select id="tipe_user" name="tipe_user" required>
            <option value="Customer">Customer</option>
            <option value="Admin">Admin</option>
            <option value="Pimpinan">Pimpinan</option>
        </select><br><br>

        <label for="foto_profil">Unggah Foto Profil (Opsional):</label>
        <input type="file" id="foto_profil" name="foto_profil" accept="image/*"><br><br>

        <button type="submit">Tambah Pengguna</button>
    </form>
</body>
</html>


