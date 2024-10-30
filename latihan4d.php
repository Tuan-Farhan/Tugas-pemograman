<?php

$asean = [
    [
        "Negara" => "Indonesia",
        "Ibukota" => "D.K.I Jakarta",
        "Kode Telepon" => "+62"
    ],
    [
        "Negara" => "Singapura",
        "Ibukota" => "Singapura",
        "Kode Telepon" => "+65"
    ],
    [
        "Negara" => "Malaysia",
        "Ibukota" => "Kuala Lumpur",
        "Kode Telepon" => "+60"
    ],
    [
        "Negara" => "Brunei",
        "Ibukota" => "Bandar Seri Bengawan",
        "Kode Telepon" => "+673"
    ],
    [
        "Negara" => "Thailand",
        "Ibukota" => "Bangkok",
        "Kode Telepon" => "+66"
    ],
    [
        "Negara" => "Laos",
        "Ibukota" => "Vientiane",
        "Kode Telepon" => "+856"
    ],
    [
        "Negara" => "Filipina",
        "Ibukota" => "Manila",
        "Kode Telepon" => "+63"
    ],
    [
        "Negara" => "Myanmar",
        "Ibukota" => "Naypyidaw",
        "Kode Telepon" => "+95"
    ]
    ];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1" cellpadding="3" cellspacing="2">
        <tr>
            <th>Negara</th>
            <th>Ibukota</th>
            <th>Kode Telepon</th>
        </tr>
        <?php foreach($asean as $data) : ?>
            <tr>
                <td><?= $data["Negara"] ?></td>
                <td><?= $data["Ibukota"] ?></td>
                <td><?= $data["Kode Telepon"] ?></td>
            </tr>
        <?php endforeach ; ?>
    </table>
</body>
</html>