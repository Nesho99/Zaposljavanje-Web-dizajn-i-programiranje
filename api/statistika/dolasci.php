<?php
require_once("../../pomocne/Sesija.class.php");
require_once("../../pomocne/baza.class.php");
require_once("../../pomocne/QueryBuilder.class.php");


$baza = new Baza();
$baza->spojiDB();
$sesija= new Sesija();
$korisnik= $sesija->dajKorisnika();
$qb = new QueryBuilder();

$upit = $qb->select(["id"])->from("korisnik")->where("korisnickoIme= '" . $korisnik["korisnik"] . "'")->getQuery();
$rez = $baza->selectDB($upit);
$korisnikId= $rez->fetch_assoc()["id"];


$upit = $qb->select(["zaposlenik.korisnickoIme as zaposlenik","COUNT(datum) as dolazak"])->from("dolazak")
->join("korisnik as zaposlenik","dolazak.zaposlenik=zaposlenik.id")
->groupBy("zaposlenik.id")
->getQuery();
print_r($upit);
$rezultat=$baza->selectDB($upit);
$dolazak=array();

while ($obj = $rezultat->fetch_object()) {
    array_push($dolazak, $obj);
 }
echo (json_encode($dolazak));



$baza->zatvoriDB();
