<?php
require_once("../../pomocne/Sesija.class.php");
require_once("../../pomocne/baza.class.php");
require_once("../../pomocne/QueryBuilder.class.php");
require_once("../../Modeli/Zadatak.class.php");
require_once("../../pomocne/VirtualnoVrijeme.class.php");
require_once("../../pomocne/datumi.lib.php");

$baza = new Baza();
$baza->spojiDB();
$sesija = new Sesija();
$korisnik = $sesija->dajKorisnika();
$qb = new QueryBuilder();

$upit = $qb->select(["id"])->from("korisnik")->where("korisnickoIme= '" . $korisnik["korisnik"] . "'")->getQuery();
$rez = $baza->selectDB($upit);
$korisnikId = $rez->fetch_assoc()["id"];
$vrijeme = pretvoriUsqlTimestamp(VirtualnoVrijeme::virtualnoSada());
$upit = $qb->select(["id"])->from("dolazak")->where(["zaposlenik=" . $korisnikId, "DATE(datum)=DATE('$vrijeme')"])->getQuery();
$rez = $baza->selectDB($upit);
if (!isset($rez->fetch_assoc()["id"])) {
    $rez = new stdClass;
    $rez->uspijeh = false;
    $rez->poruka="Nemate dolazak";
    die(json_encode($rez));
}
$zadatakId = $_POST["id"];
$opis = $_POST["opis"];
$upit = $qb->select(["id"])->from("zadatak")->where(["id=$zadatakId", "dan=DATE('$vrijeme')"])->getQuery();
$rez = $baza->selectDB($upit);
$id=$rez->fetch_assoc()["id"];
if (!isset($id)) {
    $rez = new stdClass;
    $rez->uspijeh = false;
    $rez->poruka="Krivi datum";
    die(json_encode($rez));


}
$vrijednosti["opisRijesenja"] = $opis;
$upit = $qb->update("zadatak")->set($vrijednosti)->where(["id=$id"])->getQuery();
$baza->updateDB($upit);
$baza->zatvoriDB();

$rez = new stdClass;
$rez->uspijeh = true;
echo json_encode($rez);