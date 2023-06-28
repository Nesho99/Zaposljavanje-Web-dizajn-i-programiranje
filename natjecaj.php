<?php

require_once("pomocne/smarty.php");
require_once("pomocne/Sesija.class.php");
require_once("pomocne/QueryBuilder.class.php");
require_once("pomocne/baza.class.php");
require_once("Modeli/Natjecaj.class.php");
require_once("pomocne/VirtualnoVrijeme.class.php");
require_once("pomocne/datumi.lib.php");
function dohvatiNatjecaj($id)
{
    $baza = new Baza();
    $baza->spojiDB();
    $qb = new QueryBuilder();
    $upit = $qb->select(["natjecaj.id", "naziv", "natjecaj.opis", "datumVrijemePocetak", "datumVrijemeKraj", "poduzece.ime as poduzece"])->from("natjecaj")
        ->join("poduzece", "poduzece=poduzece.id")
        ->where("natjecaj.id=" . $id)
        ->getQuery();
    $rezultat = $baza->selectDB($upit);

    $natjecaj = $rezultat->fetch_object("natjecaj");

    $baza->zatvoriDB();
    return $natjecaj;

}
function statusTrentunogKorisnika($korisnik)
{
    $qb = new QueryBuilder();
    $baza = new Baza();
    $baza->spojiDB();

    $upit = $qb->select(["id"])->from("korisnik")->where("korisnickoIme= '" . $korisnik["korisnik"] . "'")->getQuery();
    $rez = $baza->selectDB($upit);
    $korisnikId= $rez->fetch_assoc()["id"];
    $upit = $qb->select(["natjecaj"])->from("zaposlenikprijavljennanatecaj")->where("zaposlenik= '" . $korisnikId . "'")->getQuery();
    $rez = $baza->selectDB($upit);
    if ($rez === null) {
        $baza->zatvoriDB();
        return null;
    } else {
        $row = $rez->fetch_assoc();
        if ($row !== null && isset($row["natjecaj"])) {
            $natjecajId = $row["natjecaj"];
            $baza->zatvoriDB();
            return $natjecajId;
        } else {
            $baza->zatvoriDB();
            return null;
        }
    }
    
}

function dohvatiKandidate($id){
    $qb = new QueryBuilder();
    $baza = new Baza();
    $baza->spojiDB();


    $kandidati=array();
    $upit = $qb->select(["korisnickoIme,slika"])->from("zaposlenikprijavljennanatecaj")->join("korisnik","zaposlenik=korisnik.id")->where("natjecaj= ".$id)->getQuery();
    $rezultat = $baza->selectDB($upit);
    while ($obj = $rezultat->fetch_object()) {
        array_push($kandidati, $obj);
     }
     return $kandidati;


}
    



$id = $_GET["id"];



$smarty->assign('naslov', 'Korisnici');

$sesija = new Sesija();
$korisnik = $sesija->dajKorisnika();
if ($korisnik["uloga"] == null) {
    die("Nedovoljno privilegija");
}
$smarty->assign('korisnik', $korisnik);
$smarty->assign('natjecaj', dohvatiNatjecaj($id));
$smarty->assign('status', statusTrentunogKorisnika($korisnik));
$smarty->assign("kandidati",dohvatiKandidate($id));

$smarty->display('header.tpl');
$smarty->display('natjecaj.tpl');
$smarty->display('footer.tpl');
?>