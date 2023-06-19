<?php
require_once("../../pomocne/Sesija.class.php");
require_once("../../pomocne/baza.class.php");
require_once("../../pomocne/QueryBuilder.class.php");



$sesija= new Sesija();

$korisnik =$sesija->dajKorisnika();


if($korisnik== null or $korisnik["uloga"] != "admin") {
    $rez = new stdClass;
    $rez->uspijeh = false;
    $rez->poruka="Nedovoljno privilegija";
    die(json_encode($rez));
}
$id= $_GET["id"];

$baza= new Baza();
$baza->spojiDB();
$qb= new QueryBuilder();
$upit=$qb->update('korisnik')->set(['uloga'=> ''])->where('id='.$id)->getQuery();
$baza->updateDB($upit);
$qb= new QueryBuilder();

$upit=$qb->update('poduzece')->set(['moderator'=> null])->where('moderator='.$id)->getQuery();
print_r($upit);
$baza->updateDB($upit);
$baza->zatvoriDB();

$rez = new  stdClass;
$rez->uspijeh=true;
echo json_encode($rez);




?>