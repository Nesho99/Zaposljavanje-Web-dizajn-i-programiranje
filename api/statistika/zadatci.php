<?php
require_once("../../pomocne/Sesija.class.php");
require_once("../../pomocne/baza.class.php");



$baza = new Baza();
$baza->spojiDB();
$sesija= new Sesija();
$korisnik= $sesija->dajKorisnika();



$upit = "SELECT korisnik.korisnickoIme, 
COUNT(CASE WHEN opisRijesenja IS NULL THEN 1 ELSE NULL END) AS nerijeseni,
COUNT(CASE WHEN opisRijesenja IS NOT NULL THEN 1 ELSE NULL END) AS rijeseni
FROM zadatak
JOIN korisnik  ON korisnik.id=zaposlenik
GROUP BY zaposlenik;
";

$rezultat=$baza->selectDB($upit);
$zadatak=array();

while ($obj = $rezultat->fetch_object()) {
    array_push($zadatak, $obj);
 }
echo (json_encode($zadatak));



$baza->zatvoriDB();