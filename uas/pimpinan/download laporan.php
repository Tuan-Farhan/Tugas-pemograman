<?php
require_once __DIR__ . '/vendor/autoload.php'; // mPDF library
include 'koneksi.php'; // Koneksi ke database

// Ambil semua data user dari tabel `users`
$stmt = $pdo->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC); // Ambil semua hasil

// Mulai output PDF
$mpdf = new \Mpdf\Mpdf();
$html = '<h1>Laporan Data Pengguna</h1>';
$html .= '<table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Nomor Telepon</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Tipe User</th>
                </tr>
            </thead>
            <tbody>';

foreach ($users as $user) {
    $html .= '<tr>
                <td>' . htmlspecialchars($user['id']) . '</td>
                <td>' . htmlspecialchars($user['nama_lengkap']) . '</td>
                <td>' . htmlspecialchars($user['email']) . '</td>
                <td>' . htmlspecialchars($user['nomor_telepon']) . '</td>
                <td>' . htmlspecialchars($user['jenis_kelamin']) . '</td>
                <td>' . htmlspecialchars($user['tanggal_lahir']) . '</td>
                <td>' . htmlspecialchars($user['tipe_user']) . '</td>
              </tr>';
}

$html .= '</tbody></table>';
$mpdf->WriteHTML($html);

// Output ke browser sebagai PDF
$mpdf->Output('Laporan_Data_Pengguna.pdf', 'D');
