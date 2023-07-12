<?php
require_once("pomocne/smarty.php");
require_once("pomocne/Sesija.class.php");

$sesija = new Sesija();
$korisnik= $sesija->dajKorisnika();
$smarty->assign('naslov', 'Naslovna');
$smarty->assign('korisnik', $korisnik);


$smarty->display('header.tpl');
$smarty->display('postavke.tpl');
$smarty->display('footer.tpl');