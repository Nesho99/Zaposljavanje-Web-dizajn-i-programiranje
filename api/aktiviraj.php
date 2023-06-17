<?php
require_once("../pomocne/baza.class.php");
$link=$_GET["link"];


$baza =  new Baza();
$baza->spojiDB();
$upit="SELECT * FROM `korisnik` WHERE `linkAktivacije`= '{$link}'";
$rezultat=$baza->selectDB($upit);
$red =$rezultat->fetch_assoc();
$datum = $red['vrijemeRegistracije'];

$datumRegistracije = new DateTime($datum);
$trenutniDatum = new DateTime();
$interval = $trenutniDatum->diff($datumRegistracije);

if ($interval->days >2) {
    echo "Link morate potvrditi unutar 2 dana";
}


$upit="UPDATE `korisnik` SET `jeAktiviran`=1 WHERE `linkAktivacije`= '{$link}'";
$rezultat= $baza->updateDB($upit);
$datum=$red['vrijemeRegistracije'];


$baza->zatvoriDB();

header("Location: ../index.php");
exit; 


?>