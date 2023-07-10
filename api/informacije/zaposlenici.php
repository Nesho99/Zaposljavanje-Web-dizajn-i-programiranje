<?php
require_once("../../pomocne/Sesija.class.php");
require_once("../../pomocne/baza.class.php");
require_once("../../pomocne/QueryBuilder.class.php");
require_once("../../pomocne/VirtualnoVrijeme.class.php");
require_once("../../pomocne/datumi.lib.php");


$baza = new Baza();
$baza->spojiDB();

$qb = new QueryBuilder();

$upit= $qb->select(["k.ime","k.prezime","p.ime as poduzece"])
->from("korisnik as k")
->join("poduzece as p","k.poduzece=p.id");

if(isset($_POST["pretrazi"])){
    $pretraga = $_POST["pretrazi"];
    $upit= $upit->like("k.prezime",$pretraga);
}


if(isset($_POST["smjer"])){
    $smjer=$_POST["smjer"];
    $upit=$upit->orderBy("prezime",$smjer);
}

$upit=$upit->getQuery();

$rezultat=$baza->selectDB($upit);


$zaposlenik=array();
while ($obj = $rezultat->fetch_object()) {
    array_push($zaposlenik, $obj);
 }
echo (json_encode($zaposlenik));



$baza->zatvoriDB();
?>