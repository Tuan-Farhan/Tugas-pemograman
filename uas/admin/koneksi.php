<?php
$host = 'localhost';
$db = 'database_hotel'; // Sesuaikan dengan nama database Anda
$user = 'root'; // Sesuaikan dengan user MySQL Anda
$pass = ''; // Sesuaikan dengan password MySQL Anda

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>
