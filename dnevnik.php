<?php
require_once("pomocne/smarty.php");
require_once("pomocne/Sesija.class.php");

$smarty->assign('naslov', 'Dnevnik');

$sesija = new Sesija();
$korisnik= $sesija->dajKorisnika();
if($korisnik["uloga"]!="admin"){

}
$smarty->assign('korisnik', $korisnik);
$smarty->display('header.tpl');
$smarty->display('dnevnik.tpl');
$smarty->display('footer.tpl');
?>