<?php

require_once("pomocne/smarty.php");
require_once("pomocne/Sesija.class.php");
require_once("pomocne/QueryBuilder.class.php");
require_once("pomocne/baza.class.php");
require_once("Modeli/Natjecaj.class.php");
require_once("pomocne/VirtualnoVrijeme.class.php");
require_once("pomocne/datumi.lib.php");
function dohvatiNatjecaj($id){
    $baza = new Baza();
    $baza->spojiDB();
    $qb = new QueryBuilder();
    $upit = $qb->select(["natjecaj.id", "naziv", "natjecaj.opis", "datumVrijemePocetak", "datumVrijemeKraj", "poduzece.ime as poduzece"])->from("natjecaj")
        ->join("poduzece", "poduzece=poduzece.id")
        ->where("natjecaj.id=".$id)
        ->getQuery();
    $rezultat = $baza->selectDB($upit);
    
     $natjecaj = $rezultat->fetch_object("natjecaj"); 
       
    $baza->zatvoriDB();
    return $natjecaj;

}



$id=$_GET["id"];



$smarty->assign('naslov', 'Korisnici');

$sesija = new Sesija();
$korisnik= $sesija->dajKorisnika();
if($korisnik["uloga"]==null){
die("Nedovoljno privilegija");
}
$smarty->assign('korisnik', $korisnik);
$smarty->assign('natjecaj', dohvatiNatjecaj($id));
$smarty->display('header.tpl');
$smarty->display('natjecaj.tpl');
$smarty->display('footer.tpl');
?>

