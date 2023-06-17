<?php
require_once("../pomocne/baza.class.php");
header('Content-Type: application/json; charset=utf-8');
$korisnik=$_GET["korisnik"];

$baza =  new Baza();
$baza->spojiDB();


$upit="SELECT * FROM korisnik WHERE korisnickoIme='{$korisnik}'";
$rezultat= $baza->selectDB($upit);
$red=$rezultat->fetch_row();
if($red){
    echo '{"postoji": true}';
}else{
   echo  '{"postoji": false}';

}
$baza->zatvoriDB();

?>