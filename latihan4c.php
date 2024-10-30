<?php
$asean = [
    "Indonesia" => "D.K.I jakarta",
    "Singapura" => "Singapura",
    "Malaysia" => "Kuala Lumpur",
    "Brunei" => "Bandar Seri Bengawan",
    "Thailand" => "Bangkok",
    "Laos" => "Vientiane",
    "Filipina" => "Manila",
    "Myanmar" => "Naypyidaw"
];


echo "<h2>Daftar Negara ASEAN dan Ibukota :</h2>";
echo "<ul>";

foreach($asean as $asn => $ibukota){
    echo "<li>$asn : $ibukota</li>";
}

?>