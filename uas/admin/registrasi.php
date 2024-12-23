<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash password
    $nomor_telepon = $_POST['nomor_telepon'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];

    // Tipe user selalu Admin untuk form ini
    $tipe_user = 'Admin';

    // Periksa apakah email sudah ada di database
    $stmt = $pdo->prepare("SELECT * FROM Users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $existingUser = $stmt->fetch();

    if ($existingUser) {
        // Jika email sudah ada, tampilkan pesan error
        echo "Email sudah digunakan. Silakan gunakan email lain.";
    } else {
        // Simpan data admin baru ke dalam database
        $stmt = $pdo->prepare("INSERT INTO Users 
            (nama_lengkap, email, password, nomor_telepon, alamat, jenis_kelamin, tanggal_lahir, tipe_user) 
            VALUES (:nama_lengkap, :email, :password, :nomor_telepon, :alamat, :jenis_kelamin, :tanggal_lahir, :tipe_user)");
        
        $stmt->bindParam(':nama_lengkap', $nama_lengkap);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':nomor_telepon', $nomor_telepon);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':jenis_kelamin', $jenis_kelamin);
        $stmt->bindParam(':tanggal_lahir', $tanggal_lahir);
        $stmt->bindParam(':tipe_user', $tipe_user);

        if ($stmt->execute()) {
            echo "Registrasi admin berhasil. <a href='login.php'>Login di sini</a>";
        } else {
            echo "Terjadi kesalahan saat registrasi.";
        }
    }
}
?>

<h2>Registrasi Admin</h2>
<form method="POST">
    <label for="nama_lengkap">Nama Lengkap:</label>
    <input type="text" id="nama_lengkap" name="nama_lengkap" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

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

    <button type="submit">Daftar</button>
</form>
