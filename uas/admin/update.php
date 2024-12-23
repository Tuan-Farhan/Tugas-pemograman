<?php
include 'koneksi.php';

// Cek apakah ID telah dimasukkan melalui form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Ambil data pengguna berdasarkan ID
    $stmt = $pdo->prepare("SELECT * FROM Users WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $user = $stmt->fetch();

    // Jika pengguna tidak ditemukan, tampilkan pesan error
    if (!$user) {
        echo "Pengguna dengan ID tersebut tidak ditemukan.";
        exit;
    }

    // Proses update jika form update disubmit
    if (isset($_POST['update'])) {
        $nama_lengkap = $_POST['nama_lengkap'];
        $email = $_POST['email'];
        $nomor_telepon = $_POST['nomor_telepon'];
        $alamat = $_POST['alamat'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $tipe_user = $_POST['tipe_user'];

        // Periksa apakah ada foto yang diupload
        if ($_FILES['foto_profil']['error'] === UPLOAD_ERR_OK) {
            // Jika ada, upload foto dan simpan path-nya
            $foto_profil = 'uploads/' . $_FILES['foto_profil']['name'];
            move_uploaded_file($_FILES['foto_profil']['tmp_name'], $foto_profil);
        } else {
            // Jika tidak ada foto yang diupload, gunakan foto lama
            $foto_profil = $user['foto_profil'];
        }

        // Update data pengguna
        $stmt = $pdo->prepare("UPDATE Users SET 
            nama_lengkap = :nama_lengkap,
            email = :email,
            nomor_telepon = :nomor_telepon,
            alamat = :alamat,
            jenis_kelamin = :jenis_kelamin,
            tanggal_lahir = :tanggal_lahir,
            tipe_user = :tipe_user,
            foto_profil = :foto_profil
            WHERE id = :id");

        $stmt->bindParam(':nama_lengkap', $nama_lengkap);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':nomor_telepon', $nomor_telepon);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':jenis_kelamin', $jenis_kelamin);
        $stmt->bindParam(':tanggal_lahir', $tanggal_lahir);
        $stmt->bindParam(':tipe_user', $tipe_user);
        $stmt->bindParam(':foto_profil', $foto_profil);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            echo "Data pengguna berhasil diupdate.";
        } else {
            echo "Terjadi kesalahan saat mengupdate data pengguna.";
        }
    }
} else {
    // Jika ID belum dimasukkan, tampilkan form untuk memasukkan ID
    echo '<h2>Cari Data Pengguna</h2>';
    echo '<form method="POST">
            <label for="id">Masukkan ID Pengguna:</label>
            <input type="text" id="id" name="id" required>
            <button type="submit">Cari</button>
          </form>';
}
?>

<?php if (isset($user)) : ?>
    <h2>Edit Data Pengguna</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">

        <label for="nama_lengkap">Nama Lengkap:</label>
        <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?= htmlspecialchars($user['nama_lengkap']) ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br><br>

        <label for="nomor_telepon">Nomor Telepon:</label>
        <input type="text" id="nomor_telepon" name="nomor_telepon" value="<?= htmlspecialchars($user['nomor_telepon']) ?>" required><br><br>

        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat" required><?= htmlspecialchars($user['alamat']) ?></textarea><br><br>

        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <select id="jenis_kelamin" name="jenis_kelamin" required>
            <option value="Laki-laki" <?= ($user['jenis_kelamin'] == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
            <option value="Perempuan" <?= ($user['jenis_kelamin'] == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
        </select><br><br>

        <label for="tanggal_lahir">Tanggal Lahir:</label>
        <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="<?= htmlspecialchars($user['tanggal_lahir']) ?>" required><br><br>

        <label for="tipe_user">Tipe User:</label>
        <select id="tipe_user" name="tipe_user" required>
            <option value="Customer" <?= ($user['tipe_user'] == 'Customer') ? 'selected' : '' ?>>Customer</option>
            <option value="Admin" <?= ($user['tipe_user'] == 'Admin') ? 'selected' : '' ?>>Admin</option>
            <option value="Pimpinan" <?= ($user['tipe_user'] == 'Pimpinan') ? 'selected' : '' ?>>Pimpinan</option>
        </select><br><br>


        <label for="foto_profil">Unggah Foto Profil (Jika ingin mengubah):</label>
        <input type="file" id="foto_profil" name="foto_profil" accept="image/*"><br><br>

        <button type="submit" name="update">Update Data</button>
    </form>
<?php endif; ?>
