<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1" cellpadding="3" cellspacing="0">
        <tr>
            <th>kolom1</th>
            <th>kolom2</th>
            <th>kolom3</th>
            <th>kolom4</th>
            <th>kolom5</th>
        </tr>
        <?php
        for($i = 1; $i <= 15; $i++) {
            echo "<tr>";
            for($j = 1; $j <= 5; $j++) {
                echo "<td>Baris $i Kolom $j</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>