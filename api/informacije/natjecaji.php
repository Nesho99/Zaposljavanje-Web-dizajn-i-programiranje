<?php
require_once("../../pomocne/Sesija.class.php");
require_once("../../pomocne/baza.class.php");
require_once("../../pomocne/QueryBuilder.class.php");
require_once("../../pomocne/VirtualnoVrijeme.class.php");
require_once("../../pomocne/datumi.lib.php");


$baza = new Baza();
$baza->spojiDB();

$qb = new QueryBuilder();

$vrijeme= pretvoriUsqlTimestamp(VirtualnoVrijeme::virtualnoSada());
$upit = $qb->select(["n.naziv","n.opis","n.datumVrijemePocetak","n.datumVrijemeKraj","p.ime","
CASE
WHEN  '$vrijeme' > n.datumVrijemePocetak AND '$vrijeme' < n.datumVrijemeKraj THEN 'otvoreni'
ELSE 'zatvoreni'
END as status"
])
->from("natjecaj as n")
->join("poduzece as p","p.id=n.poduzece");

if(isset($_POST["od"]) and isset($_POST["do"])){
    $od=$_POST["od"];
    $do=$_POST["do"];
    $upit=$upit->where(["'$od'<= n.datumVrijemePocetak","'$do'>=  n.datumVrijemeKraj"]);
}



$upit=$upit->orderBy(["poduzece, status"])->getQuery();
$rezultat=$baza->selectDB($upit);
$natjecaj=array();
while ($obj = $rezultat->fetch_object()) {
    array_push($natjecaj, $obj);
 }
echo (json_encode($natjecaj));



$baza->zatvoriDB();