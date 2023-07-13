<?php
require_once("../../pomocne/Sesija.class.php");
require_once("../../pomocne/baza.class.php");
require_once("../../pomocne/QueryBuilder.class.php");
require_once("../../modeli/Zadatak.class.php");

$baza = new Baza();
$baza->spojiDB();
$sesija= new Sesija();
$korisnik= $sesija->dajKorisnika();
$qb = new QueryBuilder();

$upit = $qb->select(["id"])->from("korisnik")->where("korisnickoIme= '" . $korisnik["korisnik"] . "'")->getQuery();
$rez = $baza->selectDB($upit);
$korisnikId= $rez->fetch_assoc()["id"];


$upit = $qb->select(["zadatak.id","naziv","zadatak.opis","opisRijesenja","dan","ocjena","zaposlenik.korisnickoIme as zaposlenik"])->from("zadatak")
->join("korisnik as zaposlenik","zadatak.zaposlenik=zaposlenik.id")
->where(["zadatak.zaposlenik=".$korisnikId])
->orderBy("dan","DESC")
->getQuery();
$rezultat=$baza->selectDB($upit);
$zadatak=array();

while ($obj = $rezultat->fetch_object("Zadatak")) {
    array_push($zadatak, $obj);
 }
echo (json_encode($zadatak));



$baza->zatvoriDB();
