<?php
require_once("../pomocne/Sesija.class.php");
require_once("../pomocne/baza.class.php");
require_once("../modeli/Korisnik.class.php");
require_once("../modeli/Dnevnik.class.php");
require_once("../pomocne/datumi.lib.php");
require_once("../pomocne/VirtualnoVrijeme.class.php");
require_once("../pomocne/QueryBuilder.class.php");

$dnevnik = new Dnevnik();

$dnevnik->tip = "odjava";
print_r(Sesija::dajKorisnika());
$dnevnik->korisnik = Sesija::dajKorisnika()["korisnik"];

// Set the expiration date to one hour ago
setcookie("prijava_sesija", "", time() - 3600, "/");
unset($_COOKIE['prijava_sesija']);
$dnevnik->datumVrijeme = pretvoriUsqlTimestamp(VirtualnoVrijeme::virtualnoSada());
$dnevnik->tip = "OdjaVA";
$qb = new QueryBuilder();

$baza = new Baza();
$baza->spojiDB();
$koriIme= $dnevnik->korisnik = Sesija::dajKorisnika()["korisnik"];
$upit=$qb->select("id")->from("korisnik")->where("korisnickoIme='".$koriIme."'")->getQuery();
$rezultat = $baza->selectDB($upit);
print_r($upit);

$dnevnik->korisnik = $rezultat->fetch_assoc()["id"];
$upit = $qb->insertInto("dnevnik", ["korisnik", "tip", "datumVrijeme"])->values([ $dnevnik->korisnik, $dnevnik->tip, $dnevnik->datumVrijeme])->getQuery();
$baza->updateDB($upit);
$baza->zatvoriDB();
header("Location: ../index.php");



?>