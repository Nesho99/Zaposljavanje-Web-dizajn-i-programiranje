<?php
require_once("../../pomocne/Sesija.class.php");
require_once("../../pomocne/baza.class.php");
require_once("../../pomocne/QueryBuilder.class.php");
require_once("../../Modeli/Natjecaj.class.php");

$baza = new Baza();
$baza->spojiDB();

$qb = new QueryBuilder();
$upit = $qb->select(["natjecaj.id","naziv","natjecaj.opis","datumVrijemePocetak","datumVrijemeKraj","poduzece.ime as poduzece"])->from("natjecaj")
->join("poduzece","poduzece=poduzece.id")->getQuery();
$rezultat=$baza->selectDB($upit);
$natjecaj=array();

while ($obj = $rezultat->fetch_object("natjecaj")) {
    array_push($natjecaj, $obj);
 }
echo (json_encode($natjecaj));



$baza->zatvoriDB();