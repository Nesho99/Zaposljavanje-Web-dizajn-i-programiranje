<?php
require_once("../../pomocne/Sesija.class.php");
require_once("../../pomocne/baza.class.php");
require_once("../../pomocne/QueryBuilder.class.php");
require_once("../../modeli/Dnevnik.class.php");

$baza = new Baza();
$baza->spojiDB();


$qb = new QueryBuilder();
$upit = $qb->select(["dnevnik.id","datumVrijeme","korisnik.korisnickoIme as korisnik","tip","upit","radnja"])->from("dnevnik")->join("korisnik","korisnik.id=dnevnik.korisnik")->orderBy("datumVrijeme","DESC");
if(isset($_POST["od"]) and isset($_POST["od"])){
    $od= $_POST["od"];
    $do=$_POST["do"];
    $upit->where("datumVrijeme >'{$od}' AND datumVrijeme <'{$do}'");
}

$upit= $upit->getQuery();





$rezultat=$baza->selectDB($upit);
$dnevnik=array();

while ($obj = $rezultat->fetch_object("Dnevnik")) {
    array_push($dnevnik, $obj);
 }
echo (json_encode($dnevnik));



$baza->zatvoriDB();
