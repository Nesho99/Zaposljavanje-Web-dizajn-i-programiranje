<?php
require_once("../../pomocne/Sesija.class.php");
require_once("../../pomocne/baza.class.php");
require_once("../../pomocne/QueryBuilder.class.php");


//Provjeri da je admin
$sesija = new Sesija();

$korisnik = $sesija->dajKorisnika();


if (!($korisnik == null or $korisnik["uloga"] == "admin" or $korisnik["uloga"]="moderator")) {
    $rez = new stdClass;
    $rez->uspijeh = false;
    $rez->poruka="Nedovoljno privilegija";
    die(json_encode($rez));
}


//Dohvati parametre
$naziv = $_POST["naziv"];
$opis = $_POST["opis"];
$dan = $_POST["dan"];
$zaposlenik = $_POST["zaposlenik"];

//Inicializraij bazu
$baza = new Baza();
$baza->spojiDB();
$qb = new QueryBuilder();
$upit = $qb->insertInto('zadatak', ['naziv', 'opis', 'dan', 'zaposlenik'])
    ->values([$naziv, $opis, $dan, $zaposlenik])
    ->getQuery();

$baza->updateDB($upit);
$baza->zatvoriDB();



$rez = new stdClass;
$rez->uspijeh = true;
echo json_encode($rez);




?>