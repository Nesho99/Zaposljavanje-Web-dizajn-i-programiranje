<?php
require_once("../../pomocne/Sesija.class.php");
require_once("../../pomocne/baza.class.php");
require_once("../../pomocne/QueryBuilder.class.php");
require_once("../../modeli/Natjecaj.class.php");
require_once("../../pomocne/VirtualnoVrijeme.class.php");
require_once("../../pomocne/datumi.lib.php");

$baza = new Baza();
$baza->spojiDB();
$sesija = new Sesija();
$korisnickoIme = null;
$korisnik = $sesija->dajKorisnika();
if ($korisnik && isset($korisnik["korisnik"])) {
    $korisnickoIme = $korisnik["korisnik"];
}

$qb = new QueryBuilder();
$upit = $qb->select("id")->from("korisnik")->where("korisnickoIme = '".$korisnickoIme."'")->getQuery();
$rezultat = $baza->selectDB($upit);
$krosnikId = null;
if ($rezultat && $rezultat->num_rows > 0) {
    $row = $rezultat->fetch_assoc();
    $krosnikId = $row["id"];
}

$poduzeceId = null;
if ($krosnikId) {
    $upit = $qb->select("poduzece.id")->from("zaposlenikprijavljennanatecaj")
        ->join("natjecaj", "zaposlenikprijavljennanatecaj.natjecaj = natjecaj.id")
        ->join("poduzece", "natjecaj.poduzece = poduzece.id") 
        ->where([
            "zaposlenikprijavljennanatecaj.zaposlenik = " . $krosnikId,
            "natjecaj.datumVrijemeKraj < '".pretvoriUsqlTimestamp(VirtualnoVrijeme::virtualnoSada())."'"
        ])->getQuery();
    $rezultat = $baza->selectDB($upit);
    if ($rezultat && $rezultat->num_rows > 0) {
        $row = $rezultat->fetch_assoc();
        $poduzeceId = $row["id"];
    }
}

if ($poduzeceId) {
    $upit = $qb->update("korisnik")->set(['poduzece' => $poduzeceId])
        ->where(["id = ".$krosnikId])
        ->getQuery();

    $baza->updateDB($upit);
}

$baza->zatvoriDB();

$rez = new stdClass;
$rez->uspijeh = true;
echo json_encode($rez);
?>
