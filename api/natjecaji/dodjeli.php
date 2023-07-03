<?php
require_once("../../pomocne/Sesija.class.php");
require_once("../../pomocne/baza.class.php");
require_once("../../pomocne/QueryBuilder.class.php");
require_once("../../Modeli/Natjecaj.class.php");
require_once("../../pomocne/VirtualnoVrijeme.class.php");
require_once("../../pomocne/datumi.lib.php");

$baza = new Baza();
$baza->spojiDB();
$sesija = new Sesija();
$korisnickoIme= $sesija->dajKorisnika()["korisnik"];
$qb = new QueryBuilder();
$upit = $qb->select("id")->from("korisnik")->where("korisnickoIme= '".$korisnickoIme."'")->getQuery();
$rezultat=$baza->selectDB($upit);
$krosnikId=$rezultat->fetch_assoc()["id"];

$upit = $qb->select("poduzece.id")->from("zaposlenikprijavljennanatecaj")
->join("natjecaj","zaposlenikprijavljennanatecaj.natjecaj=natjecaj.id")
->join("poduzece","natjecaj.poduzece=poduzece.id") 
->where(["zaposlenikprijavljennanatecaj.zaposlenik=" .$krosnikId, "natjecaj.datumVrijemeKraj<'".pretvoriUsqlTimestamp(VirtualnoVrijeme::virtualnoSada())."'"])->getQuery();
$rezultat=$baza->selectDB($upit);
$poduzeceId=$rezultat->fetch_assoc()["id"];
if($poduzeceId){
$upit= $qb->update("korisnik")->set(['poduzece'=> $poduzeceId])
->where(["id= ".$krosnikId])
->getQuery();

$baza->updateDB($upit);

}

$baza->zatvoriDB();

$rez = new stdClass;
$rez->uspijeh = true;
echo json_encode($rez);


?>