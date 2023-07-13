<?php
require_once("../../pomocne/Sesija.class.php");
require_once("../../pomocne/baza.class.php");
require_once("../../pomocne/QueryBuilder.class.php");
require_once("../../modeli/Korisnik.class.php");

$baza = new Baza();
$baza->spojiDB();
$qb = new QueryBuilder();
$upit = $qb->select("*")->from("korisnik")->where("uloga ='korisnik'")->getQuery();
$rezultat=$baza->selectDB($upit);
$korisnici=array();

while ($obj = $rezultat->fetch_object("Korisnik")) {
    array_push($korisnici, $obj);

}
echo json_encode($korisnici);



$baza->zatvoriDB();