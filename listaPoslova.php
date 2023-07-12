<?php
require_once("pomocne/smarty.php");
require_once("pomocne/Sesija.class.php");
require_once("pomocne/QueryBuilder.class.php");
require_once("pomocne/baza.class.php");
require_once("modeli/Natjecaj.class.php");
require_once("pomocne/VirtualnoVrijeme.class.php");
require_once("pomocne/datumi.lib.php");
function dohvatiNatjecaje()
{
    $baza = new Baza();
    $baza->spojiDB();
    $qb = new QueryBuilder();
    $upit = $qb->select(["natjecaj.id", "naziv", "natjecaj.opis", "datumVrijemePocetak", "datumVrijemeKraj", "poduzece.ime as poduzece"])->from("natjecaj")
        ->join("poduzece", "poduzece=poduzece.id")
        ->where("datumVrijemeKraj >" . "'" . pretvoriUsqlTimestamp(VirtualnoVrijeme::virtualnoSada()) . "'")
        ->getQuery();
    $rezultat = $baza->selectDB($upit);
    $natjecaj = array();
    while ($obj = $rezultat->fetch_object("natjecaj")) {
        array_push($natjecaj, $obj);
    }
    $baza->zatvoriDB();
    return $natjecaj;
}



$smarty->assign('naslov', 'Lista poslova');

$sesija = new Sesija();
$korisnik = $sesija->dajKorisnika();
if ($korisnik == null) {
    die("Nedovoljno privilegija");
}
$smarty->assign('korisnik', $korisnik);
$smarty->assign('natjecaji', dohvatiNatjecaje());
$smarty->display('header.tpl');
$smarty->display('listaPoslova.tpl');
$smarty->display('footer.tpl');
$sesija = new Sesija();




?>