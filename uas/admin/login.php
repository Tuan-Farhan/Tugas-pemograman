<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Periksa apakah email dan password cocok
    $stmt = $pdo->prepare("SELECT * FROM Users WHERE email = :email AND tipe_user = 'Admin'");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Set session admin_logged_in
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_name'] = $user['nama_lengkap'];
        
        // Redirect ke dashboard admin
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Email atau password salah.";
    }
}
?>

<h2>Login Admin</h2>
<form method="POST">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>
