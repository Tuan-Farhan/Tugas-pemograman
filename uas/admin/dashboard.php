<?php
session_start();

// Periksa apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
        }
        .container {
            width: 80%;
            margin: auto;
        }
        .menu {
            margin: 20px;
        }
        .menu a {
            padding: 10px 20px;
            text-decoration: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            margin-right: 10px;
        }

        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    color: #333;
    margin-top: 20px;
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: 20px auto;
    background-color: #fff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    border-radius: 10px;
}

.menu {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    margin-top: 20px;
}

.menu a {
    display: block;
    padding: 15px 25px;
    text-decoration: none;
    background-color: #2a9d8f;
    color: white;
    border-radius: 5px;
    margin-bottom: 10px;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.menu a:hover {
    background-color: #21867a;
}

@media (max-width: 768px) {
    .menu {
        flex-direction: column;
        align-items: center;
    }

    .menu a {
        width: 100%;
        text-align: center;
        margin: 10px 0;
    }
}

        .menu a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Selamat Datang di Dashboard Admin</h1>

    <div class="container">
        <div class="menu">
            <a href="create.php">Tambah Pengguna Baru</a>
            <a href="read.php">Tambah Pengguna Baru</a>
            <a href="update.php">Edit Data Pengguna</a>
            <a href="delete_data.php">Hapus Pengguna</a> <!-- Ubah link delete ke delete_data.php -->
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>