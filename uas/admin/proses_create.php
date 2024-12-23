<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nomor_telepon = $_POST['nomor_telepon'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $tipe_user = $_POST['tipe_user'];

    // Proses upload foto
    $target_dir = "uploads/";
    $foto_profil = $target_dir . basename($_FILES["foto_profil"]["name"]);
    move_uploaded_file($_FILES["foto_profil"]["tmp_name"], $foto_profil);

    // Insert data ke database
    $sql = "INSERT INTO Users (nama_lengkap, email, password, nomor_telepon, alamat, jenis_kelamin, tanggal_lahir, tipe_user, foto_profil) 
            VALUES (:nama_lengkap, :email, :password, :nomor_telepon, :alamat, :jenis_kelamin, :tanggal_lahir, :tipe_user, :foto_profil)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nama_lengkap', $nama_lengkap);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':nomor_telepon', $nomor_telepon);
    $stmt->bindParam(':alamat', $alamat);
    $stmt->bindParam(':jenis_kelamin', $jenis_kelamin);
    $stmt->bindParam(':tanggal_lahir', $tanggal_lahir);
    $stmt->bindParam(':tipe_user', $tipe_user);
    $stmt->bindParam(':foto_profil', $foto_profil);

    if ($stmt->execute()) {
        echo "Pengguna berhasil ditambahkan.";
    } else {
        echo "Terjadi kesalahan saat menambahkan pengguna.";
    }
}
?>
