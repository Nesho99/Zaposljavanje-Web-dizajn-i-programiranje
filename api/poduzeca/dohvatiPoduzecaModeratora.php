<?php
require_once("../../pomocne/Sesija.class.php");
require_once("../../pomocne/baza.class.php");
require_once("../../pomocne/QueryBuilder.class.php");
require_once("../../modeli/Poduzece.class.php");

$baza = new Baza();
$baza->spojiDB();
$sesija= new Sesija();
$korisnickoIme= $sesija->dajKorisnika()["korisnik"];
$qb = new QueryBuilder();
$upit = $qb->select(["poduzece.id","poduzece.ime","radnoVrijemeOd","radnoVrijemeDo","opis", "korisnik.korisnickoIme as moderator"])->from("poduzece")
->join("korisnik","moderator=korisnik.id","left")->where("korisnik.korisnickoIme= '".$korisnickoIme."'")
->getQuery();
$rezultat=$baza->selectDB($upit);
$poduzeca=array();

while ($obj = $rezultat->fetch_object("Poduzece")) {
    array_push($poduzeca, $obj);
 }
echo (json_encode($poduzeca));



$baza->zatvoriDB();
