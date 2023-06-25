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

if (isset($_POST["naziv"])) {
    $naziv = $_POST["naziv"];
    $vrijednosti["naziv"] = $naziv;
}


if (isset($_POST["opis"])) {
    $opis = $_POST["opis"];
    $vrijednosti["opis"] = $opis;
}

if (isset($_POST["poduzece"])) {
    $poduzece = $_POST["poduzece"];
    $vrijednosti["poduzece"] = $poduzece;
}

if (isset($_POST["od"])) {
    $od = $_POST["od"];
    $vrijednosti["datumVrijemePocetak"] = $od;
    $timestamp = intval(VirtualnoVrijeme::virtualnoSada());
    $datetime = DateTime::createFromFormat('U', $timestamp);
    $datetime->add(new DateInterval('P10D'));
    $do = pretvoriUsqlTimestamp($datetime->getTimestamp());
    $vrijednosti["datumVrijemeKraj"] = $do;



}


$baza = new Baza();
$baza->spojiDB();
$qb = new QueryBuilder();
$upit = $qb->update('natjecaj')->set($vrijednosti)->where('id=' . $id)->getQuery();
$baza->updateDB($upit);
$baza->zatvoriDB();



$rez = new stdClass;
$rez->uspijeh = true;
echo json_encode($rez);

?>