<?php
// Data flora dan fauna terancam punah
$floraFauna = [
    [
        'nama_ilmiah' => 'Tapirus',
        'nama_umum' => 'Tapir',
        'habitat' => 'Hutan tropis',
        'status_konservasi' => 'Terancam Punah',
        'gambar' => 'gambar/tapir.jpg'
    ],
    [
        'nama_ilmiah' => 'Panthera tigris sumatrae',
        'nama_umum' => 'Harimau Sumatra',
        'habitat' => 'Hutan lebat',
        'status_konservasi' => 'Terancam Punah',
        'gambar' => 'gambar/harimau.jpeg'
    ],
    [
        'nama_ilmiah' => 'Cacatua sulphurea',
        'nama_umum' => 'Kakatua jambul kuning',
        'habitat' => 'Hutan Borneo',
        'status_konservasi' => 'Terancam Punah',
        'gambar' => 'gambar/kakatua jambul kuning.jpeg'
    ],
    [
        'nama_ilmiah' => 'Rhinoceros sondaicus',
        'nama_umum' => 'Badak Jawa',
        'habitat' => 'Hutan hujan',
        'status_konservasi' => 'Sangat Terancam',
        'gambar' => 'gambar/badak jawa.jpg'
    ],
    [
        'nama_ilmiah' => 'Varanus komodoensis',
        'nama_umum' => 'Komodo',
        'habitat' => 'Pulau Komodo',
        'status_konservasi' => 'Terancam Punah',
        'gambar' => 'gambar/komodo.jpg'
    ],
    [
        'nama_ilmiah' => 'Chelonia mydas',
        'nama_umum' => 'Penyu Hijau',
        'habitat' => 'Lautan',
        'status_konservasi' => 'Terancam Punah',
        'gambar' => 'gambar/penyu hijau.jpeg'
    ],
    [
        'nama_ilmiah' => 'Elephas maximus sumatranus',
        'nama_umum' => 'Gajah Sumatra',
        'habitat' => 'Hutan Sumatra',
        'status_konservasi' => 'Terancam Punah',
        'gambar' => 'gambar/gajah.jpeg'
    ],
    [
        'nama_ilmiah' => 'Pongo tapanuliensis',
        'nama_umum' => 'Orangutan Tapanuli',
        'habitat' => 'Hutan Tapanuli',
        'status_konservasi' => 'Terancam Punah',
        'gambar' => 'gambar/orang hutang.jpeg'
    ],
    [
        'nama_ilmiah' => 'Bos javanicus',
        'nama_umum' => 'Banteng',
        'habitat' => 'Padang rumput',
        'status_konservasi' => 'Terancam Punah',
        'gambar' => 'gambar/banteng.jpg'
    ],
    [
        'nama_ilmiah' => ' Duyung disambiguasi',
        'nama_umum' => 'dugong',
        'habitat' => 'Laut',
        'status_konservasi' => 'Terancam Punah',
        'gambar' => 'gambar/dugong.jpeg'
    ]
];

// Tampilkan dalam tabel HTML
echo "<table border='1'>
        <tr>
            <th>No</th>
            <th>Nama Ilmiah</th>
            <th>Nama Umum</th>
            <th>Habitat</th>
            <th>Status Konservasi</th>
            <th>Gambar</th>
        </tr>";

foreach ($floraFauna as $index => $item) {
    echo "<tr>
            <td>" . ($index + 1) . "</td>
            <td>" . $item['nama_ilmiah'] . "</td>
            <td>" . $item['nama_umum'] . "</td>
            <td>" . $item['habitat'] . "</td>
            <td>" . $item['status_konservasi'] . "</td>
            <td><img src='" . $item['gambar'] . "' alt='" . $item['nama_umum'] . "' width='100'></td>
          </tr>";
}

echo"</table>";
?>
