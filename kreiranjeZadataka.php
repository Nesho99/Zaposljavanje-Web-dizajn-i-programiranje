<?php
require_once("pomocne/smarty.php");
require_once("pomocne/Sesija.class.php");

$smarty->assign('naslov', 'Upravljanje poslovima');

$sesija = new Sesija();
$korisnik= $sesija->dajKorisnika();
if(!($korisnik["uloga"]!="admin" or $korisnik["uloga"] !="moderator") ){
    die("Nedovoljno privilegija");

}
$smarty->assign('korisnik', $korisnik);
$smarty->display('header.tpl');
$smarty->display('kreiranjeZadataka.tpl');
$smarty->display('footer.tpl');
?>