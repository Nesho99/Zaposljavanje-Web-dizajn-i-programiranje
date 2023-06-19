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
if(!isset($_POST["id"])){
    $rez = new stdClass;
    $rez->uspijeh = false;
    $rez->poruka="ID mora biti postavljen";
    die(json_encode($rez));

}

$id=$_POST["id"];
$vrijednosti=[];

if(isset($_POST["ime"])){
    $ime =$_POST["ime"];
    $vrijednosti["ime"]=$ime;
}
if(isset($_POST["od"])){
    $od =$_POST["od"];
    $vrijednosti["radnoVrijemeOd"]=$od;
}

if(isset($_POST["do"])){
    $do =$_POST["do"];
    $vrijednosti["radnoVrijemeDo"]=$do;
}



if(isset($_POST["opis"])){
    $opis =$_POST["opis"];
    $vrijednosti["opis"]=$opis;
}

if(isset($_POST["moderator"])){
    $moderator =$_POST["moderator"];
    $vrijednosti["moderator"]=$moderator;
}


$baza= new Baza();
$baza->spojiDB();
$qb= new QueryBuilder();
$upit=$qb->update('poduzece')->set($vrijednosti)->where('id='.$id)->getQuery();
$baza->updateDB($upit);
$baza->zatvoriDB();



$rez = new stdClass;
$rez->uspijeh = true;
echo json_encode($rez);

?>