<?php
require_once("../../pomocne/Sesija.class.php");
require_once("../../pomocne/baza.class.php");
require_once("../../pomocne/QueryBuilder.class.php");

//Provjeri da je admin
$sesija = new Sesija();

$korisnik = $sesija->dajKorisnika();


if (!($korisnik["uloga"] == "admin" or $korisnik["uloga"] == "moderator")) {
    $rez = new stdClass;
    $rez->uspijeh = false;
    $rez->poruka = "Nedovoljno privilegija";
    die(json_encode($rez));
}

if (!isset($_POST["id"])) {
    $rez = new stdClass;
    $rez->uspijeh = false;
    $rez->poruka = "ID mora biti postavljen";
    die(json_encode($rez));

}

$id = $_POST["id"];
$vrijednosti = [];

$id = $_POST["id"];
$vrijednosti = [];

if (isset($_POST["naziv"])) {
    $naziv = $_POST["naziv"];
    $vrijednosti["naziv"] = $naziv;
}


if (isset($_POST["opis"])) {
    $opis = $_POST["opis"];
    $vrijednosti["opis"] = $opis;
}

if (isset($_POST["dan"])) {
    $dan = $_POST["dan"];
    $vrijednosti["dan"] = $dan;
}


if (isset($_POST["zaposlenik"])) {
    $zaposlenik = $_POST["zaposlenik"];
    $vrijednosti["zaposlenik"] = $zaposlenik;
}
if (isset($_POST["ocjena"])) {
    $ocjena = $_POST["ocjena"];
    $vrijednosti["ocjena"] = $ocjena;
}

$baza = new Baza();
$baza->spojiDB();
$qb = new QueryBuilder();
$upit = $qb->update('zadatak')->set($vrijednosti)->where('id=' . $id)->getQuery();
$baza->updateDB($upit);
$baza->zatvoriDB();



$rez = new stdClass;
$rez->uspijeh = true;
echo json_encode($rez);
