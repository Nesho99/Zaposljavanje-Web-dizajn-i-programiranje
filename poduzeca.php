<?php
require_once("pomocne/smarty.php");
require_once("pomocne/Sesija.class.php");

$smarty->assign('naslov', 'Poduzeca');

$sesija = new Sesija();
$korisnik= $sesija->dajKorisnika();
$smarty->assign('naslov', 'Naslovna');
if($korisnik["uloga"]!="admin"){

}
$smarty->assign('korisnik', $korisnik);
$smarty->display('header.tpl');
$smarty->display('poduzeca.tpl');
$smarty->display('footer.tpl');
?>