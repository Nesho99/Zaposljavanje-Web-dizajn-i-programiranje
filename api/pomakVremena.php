<?php
require_once("../pomocne/VirtualnoVrijeme.class.php");
require_once("../pomocne/Sesija.class.php");
$sesija = new Sesija();

$korisnik = $sesija->dajKorisnika();


if ($korisnik == null or $korisnik["uloga"] != "admin") {
    $rez = new stdClass;
    $rez->uspijeh = false;
    $rez->poruka="Nedovoljno privilegija";
    die(json_encode($rez));
}
VirtualnoVrijeme::upisiPomak();

$rez = new stdClass;
$rez->uspijeh = true;
echo json_encode($rez);


?>