<?php
require_once("pomocne/smarty.php");
require_once("pomocne/Sesija.class.php");

$smarty->assign('naslov', 'Upravljanje poslovima');

$sesija = new Sesija();
$korisnik= $sesija->dajKorisnika();
if(!isset($korisnik)){
    die("Nedovoljno privilegija");

}
$smarty->assign('korisnik', $korisnik);
$smarty->display('header.tpl');
$smarty->display('templates/zadatciZaposlenika.tpl');
$smarty->display('footer.tpl');
?>