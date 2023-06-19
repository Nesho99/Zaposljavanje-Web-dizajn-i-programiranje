<?php
require_once("../../pomocne/Sesija.class.php");
require_once("../../pomocne/baza.class.php");
require_once("../../pomocne/QueryBuilder.class.php");
require_once("../../Modeli/Poduzece.class.php");

$baza = new Baza();
$baza->spojiDB();
$qb = new QueryBuilder();
$upit = $qb->select(["poduzece.id","poduzece.ime","radnoVrijemeOd","radnoVrijemeDo","opis", "korisnik.korisnickoIme as moderator"])->from("poduzece")
->join("korisnik","moderator=korisnik.id")->getQuery();
$rezultat=$baza->selectDB($upit);
$poduzeca=array();

while ($obj = $rezultat->fetch_object("Poduzece")) {
    array_push($poduzeca, $obj);
 }
print_r(json_encode($poduzeca));



$baza->zatvoriDB();

?>