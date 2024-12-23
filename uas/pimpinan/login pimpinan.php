<?php
session_start();
include 'koneksi.php'; // Sambungkan ke database

// Debugging: Tampilkan informasi koneksi
var_dump($pdo); // Hapus atau komentari ini setelah debugging

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk mendapatkan data user berdasarkan email
    $stmt = $pdo->prepare("SELECT * FROM Users WHERE email = :email AND tipe_user = 'Pimpinan'");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Set session jika login berhasil
        $_SESSION['pimpinan_logged_in'] = true;
        $_SESSION['pimpinan_id'] = $user['id']; // Pastikan ini konsisten
        $_SESSION['nama_lengkap'] = $user['nama_lengkap'];

        // Redirect ke dashboard pimpinan
        header("Location: dashboard_pimpinan.php");
        exit;
    } else {
        // Jika login gagal
        $error = "Email atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Pimpinan</title>
</head>
<body>
    <h2>Login Pimpinan</h2>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>