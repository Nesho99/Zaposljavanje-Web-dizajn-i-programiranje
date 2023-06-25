<?php
require_once("../../pomocne/Sesija.class.php");
require_once("../../pomocne/baza.class.php");
require_once("../../pomocne/QueryBuilder.class.php");
require_once("../../pomocne/datumi.lib.php");
require_once("../../pomocne/VirtualnoVrijeme.class.php");



date_default_timezone_set('Europe/Zagreb');

//Provjeri da je admin
$sesija = new Sesija();

$korisnik = $sesija->dajKorisnika();


if (!($korisnik["uloga"]=="admin" or $korisnik["uloga"]=="moderator")) {
    $rez = new stdClass;
    $rez->uspijeh = false;
    $rez->poruka="Nedovoljno privilegija";
    die(json_encode($rez));
}


//Dohvati parametre
$naziv = $_POST["naziv"];
$opis = $_POST["opis"];
$datumOd=$_POST["od"];
$poduzeceId=$_POST["poduzece"];
$timestamp = intval(strtotime($datumOd));
$datetime = DateTime::createFromFormat('U', $timestamp);
$datetime->add(new DateInterval('P10D'));
$datumDo = pretvoriUsqlTimestamp($datetime->getTimestamp());
 
//Inicializraij bazu
$baza = new Baza();
$baza->spojiDB();
$qb = new QueryBuilder();
$upit = $qb->insertInto('natjecaj', ['naziv', 'opis', 'datumVrijemePocetak', 'datumVrijemekraj','poduzece'])
    ->values([$naziv,$opis, $datumOd, $datumDo, $poduzeceId])
    ->getQuery();

$baza->updateDB($upit);
$baza->zatvoriDB();



$rez = new stdClass;
$rez->uspijeh = true;
echo json_encode($rez);




?>