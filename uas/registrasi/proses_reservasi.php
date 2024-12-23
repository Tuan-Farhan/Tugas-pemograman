<?php
// Meng-include file koneksi
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $nomor_telepon = $_POST['nomor_telepon'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $tipe_user = $_POST['tipe_user'];

    // Proses file upload (gambar)
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Buat folder jika belum ada
    }

    $foto_profil = $target_dir . basename($_FILES["foto_profil"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($foto_profil, PATHINFO_EXTENSION));

    // Cek apakah file adalah gambar
    $check = getimagesize($_FILES["foto_profil"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File bukan gambar.<br>";
        $uploadOk = 0;
    }

    // Cek apakah file sudah ada
    if (file_exists($foto_profil)) {
        echo "File sudah ada.<br>";
        $uploadOk = 0;
    }

    // Batasan ukuran file (misal 5MB)
    if ($_FILES["foto_profil"]["size"] > 5000000) {
        echo "Ukuran file terlalu besar.<br>";
        $uploadOk = 0;
    }

    // Hanya izinkan format gambar tertentu
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Hanya file JPG, JPEG, dan PNG yang diizinkan.<br>";
        $uploadOk = 0;
    }

    // Jika uploadOk masih 1, maka upload file
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["foto_profil"]["tmp_name"], $foto_profil)) {
            // Jika upload berhasil, simpan data ke database
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
                echo "Data berhasil disimpan.<br>";
            } else {
                echo "Terjadi kesalahan saat menyimpan data.<br>";
            }
        } else {
            echo "Terjadi kesalahan saat mengunggah file.<br>";
        }
    } else {
        echo "File tidak dapat diunggah.<br>";
    }
}
?>
