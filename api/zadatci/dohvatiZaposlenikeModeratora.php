<?php
require_once("../../pomocne/Sesija.class.php");
require_once("../../pomocne/baza.class.php");
require_once("../../pomocne/QueryBuilder.class.php");
require_once("../../Modeli/Zadatak.class.php");

$baza = new Baza();
$baza->spojiDB();
$sesija= new Sesija();
$korisnik= $sesija->dajKorisnika();
$qb = new QueryBuilder();

$upit = $qb->select(["id"])->from("korisnik")->where("korisnickoIme= '" . $korisnik["korisnik"] . "'")->getQuery();
$rez = $baza->selectDB($upit);
$korisnikId= $rez->fetch_assoc()["id"];

$upit = $qb->select(["korisnik.id,korisnik.korisnickoIme"])->from("korisnik")
->join("poduzece","poduzece.id=korisnik.poduzece")
->join("korisnik as moderator","poduzece.moderator=moderator.id")
->where(["moderator.id=".$korisnikId])
->getQuery();
$rezultat=$baza->selectDB($upit);
$zaposlenik=array();

while ($obj = $rezultat->fetch_object()) {
    array_push($zaposlenik, $obj);
 }
echo (json_encode($zaposlenik));



$baza->zatvoriDB();
