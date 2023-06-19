<?php
require_once("../../pomocne/Sesija.class.php");
require_once("../../pomocne/baza.class.php");
require_once("../../pomocne/QueryBuilder.class.php");
require_once("../../Modeli/Poduzece.class.php");

$baza = new Baza();
$baza->spojiDB();
$qb = new QueryBuilder();
$upit = $qb->select("*")->from("korisnik")->where("uloga='moderator'")->getQuery();
print_r($upit);
//$rezultat=$baza->selectDB($upit);
//print_r($rezultat->fetch_all());

/*
while ($obj = $rezultat->fetch_object("Poduzece")) {
    array_push($poduzeca, $obj);
 }
print_r(json_encode($poduzeca));

*/

$baza->zatvoriDB();
