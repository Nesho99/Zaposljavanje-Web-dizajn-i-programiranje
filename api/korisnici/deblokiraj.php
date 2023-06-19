<?php
require_once("../../pomocne/Sesija.class.php");
require_once("../../pomocne/baza.class.php");
require_once("../../pomocne/QueryBuilder.class.php");

//Provjeri da je admin
$sesija = new Sesija();

$korisnik = $sesija->dajKorisnika();


if ($korisnik == null or $korisnik["uloga"] != "admin") {
    $rez = new stdClass;
    $rez->uspijeh = false;
    $rez->poruka="Nedovoljno privilegija";
    die(json_encode($rez));
}
if(!isset($_GET["id"])){
    $rez = new stdClass;
    $rez->uspijeh = false;
    $rez->poruka="ID mora biti postavljen";
    die(json_encode($rez));

}

$id=$_GET["id"];

$baza= new Baza();
$baza->spojiDB();
$qb= new QueryBuilder();
$upit=$qb->update('korisnik')->set(['neuspjesnePrijave'=> 0])->where('id='.$id)->getQuery();
$baza->updateDB($upit);

$baza->zatvoriDB();

$rez = new  stdClass;
$rez->uspijeh=true;
echo json_encode($rez);
?>