<?php
$asean = [
    "Indonesia",
    "Singapura",
    "Malaysia",
    "Brunei",
    "Thailand"
];

echo "<h2>Daftar Negara ASEAN Awal</h2>";
echo "<ul>";
    foreach($asean as $asn){
        echo "<li>$asn</li>";
    }
echo "</ul>";

array_push($asean, "Laos", "Filipina", "Myanmar");


echo "<h2>Daftar Negara ASEAN Baru</h2>";
echo "<ul>";
    foreach($asean as $asn){
        echo "<li>$asn</li>";
    }
echo "</ul>";




 

?>

