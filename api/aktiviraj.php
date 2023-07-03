<?php
require_once("../pomocne/baza.class.php");
require_once("../pomocne/VirtualnoVrijeme.class.php");
$link=$_GET["link"];


$baza =  new Baza();
$baza->spojiDB();
$upit="SELECT * FROM `korisnik` WHERE `linkAktivacije`= '{$link}'";
$rezultat=$baza->selectDB($upit);
$red =$rezultat->fetch_assoc();
$datum = $red['vrijemeRegistracije'];
$timestamp= VirtualnoVrijeme::virtualnoSada();
$datumRegistracije = new DateTime($datum);
$trenutniDatumString= date('Y-m-d H:i:s', $timestamp);
$trenutniDatum = new DateTime($trenutniDatumString);
$interval = $trenutniDatum->diff($datumRegistracije);

if ($interval->days >2) {
    die("Link morate potvrditi unutar 2 dana");
}


$upit="UPDATE `korisnik` SET `jeAktiviran`=1 WHERE `linkAktivacije`= '{$link}'";
$rezultat= $baza->updateDB($upit);
$datum=$red['vrijemeRegistracije'];


$baza->zatvoriDB();

header("Location: ../index.php");
exit; 


?>