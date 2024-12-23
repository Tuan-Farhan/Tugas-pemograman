<?php
include 'koneksi.php';

$stmt = $pdo->query("SELECT * FROM Users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Daftar Pengguna</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama Lengkap</th>
        <th>Email</th>
        <th>Nomor Telepon</th>
        <th>Alamat</th>
        <th>Jenis Kelamin</th>
        <th>Tanggal Lahir</th>
        <th>Tipe User</th>
        <th>Foto Profil</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?= $user['id'] ?></td>
        <td><?= $user['nama_lengkap'] ?></td>
        <td><?= $user['email'] ?></td>
        <td><?= $user['nomor_telepon'] ?></td>
        <td><?= $user['alamat'] ?></td>
        <td><?= $user['jenis_kelamin'] ?></td>
        <td><?= $user['tanggal_lahir'] ?></td>
        <td><?= $user['tipe_user'] ?></td>
        <td><img src="<?= $user['foto_profil'] ?>" width="100"></td>
        <td>
            <a href="update.php?id=<?= $user['id'] ?>">Edit</a> |
            <a href="delete.php?id=<?= $user['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
