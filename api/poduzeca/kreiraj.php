<?php
require_once("../../pomocne/Sesija.class.php");
require_once("../../pomocne/baza.class.php");
require_once("../../pomocne/QueryBuilder.class.php");


//Provjeri da je admin
$sesija = new Sesija();

$korisnik = $sesija->dajKorisnika();


if ($korisnik == null or $korisnik["uloga"] != "admin") {
    $rez = new stdClass;
    $rez->uspijeh = false;
    $rez->poruka="Nedovoljno privilegija";
    die(json_encode($rez));
}


//Dohvati parametre
$ime = $_POST["ime"];
$vrijemeOd = $_POST["od"];
$vrijmeDo = $_POST["do"];
$opis = $_POST["opis"];

//Inicializraij bazu
$baza = new Baza();
$baza->spojiDB();
$qb = new QueryBuilder();
$upit = $qb->insertInto('poduzece', ['ime', 'radnoVrijemeOd', 'radnoVrijemeDo', 'opis'])
    ->values([$ime, $vrijemeOd, $vrijmeDo, $opis])
    ->getQuery();

$baza->updateDB($upit);
$baza->zatvoriDB();



$rez = new stdClass;
$rez->uspijeh = true;
echo json_encode($rez);




?>