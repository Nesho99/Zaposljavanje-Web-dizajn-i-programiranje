<?php
require_once("../../pomocne/Sesija.class.php");
require_once("../../pomocne/baza.class.php");
require_once("../../pomocne/QueryBuilder.class.php");


function imaDolazak($korisnik)
{
    $baza = new Baza();
    $baza->spojiDB();
    $qb = new QueryBuilder();
    $upit = $qb->select(["id"])->from("korisnik")->where("korisnickoIme= '" . $korisnik["korisnik"] . "'")->getQuery();
    $rez = $baza->selectDB($upit);
    $korisnikId = $rez->fetch_assoc()["id"];
    $upit = $qb->select(["id"])->from("dolazak")->where(["zaposlenik= " . $korisnikId, "DATE(datum)= " . "CURDATE()"])->getQuery();
    $rezultat = $baza->updateDB($upit);
    if (isset($rezultat->fetch_assoc()["id"])) {
        return true;
    } else {
        return false;
    }


}
$sesija = new Sesija();

$korisnik = $sesija->dajKorisnika();


if ($korisnik["uloga"] == null) {
    $rez = new stdClass;
    $rez->uspijeh = false;
    $rez->poruka = "Nedovoljno privilegija";
    die(json_encode($rez));

}

if (!imaDolazak($korisnik)) {
    //Dohvati parametre
    $datum = $_POST["datum"];


    //Inicializraij bazu
    $baza = new Baza();
    $baza->spojiDB();
    $qb = new QueryBuilder();
    $upit = $qb->select(["id"])->from("korisnik")->where("korisnickoIme= '" . $korisnik["korisnik"] . "'")->getQuery();
    $rez = $baza->selectDB($upit);
    $korisnikId = $rez->fetch_assoc()["id"];
    $upit = $qb->insertInto('dolazak', ['zaposlenik', 'datum'])
        ->values([$korisnikId, $datum])
        ->getQuery();

    $baza->updateDB($upit);
    $baza->zatvoriDB();
    $rez = new stdClass;
    $rez->uspijeh = true;
    echo json_encode($rez);
}
else{
    $rez = new stdClass;
    $rez->uspijeh =false;
    echo json_encode($rez);
}


?>