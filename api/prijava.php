<?php
require_once("../pomocne/baza.class.php");
require_once("../modeli/Korisnik.class.php");
require_once("../pomocne/Sesija.class.php");
require_once("../modeli/Dnevnik.class.php");
require_once("../pomocne/datumi.lib.php");
require_once("../pomocne/VirtualnoVrijeme.class.php");
require_once("../pomocne/QueryBuilder.class.php");




if (empty($_POST["kime"])) {
    die("Unesite korisnicko ime");
}
if (empty($_POST["lozinka"])) {
    die("Unesite lozinku");
}

$korisnickoIme = $_POST["kime"];
$lozinka = $_POST["lozinka"];

$baza = new Baza();
$baza->spojiDB();
$upit = "SELECT * FROM `korisnik` WHERE `korisnickoIme`= '{$korisnickoIme}'";
$rezultat = $baza->selectDB($upit);
$Korisnik = $rezultat->fetch_object("Korisnik");

$hashlozinke = $Korisnik->hashLozinke;
$hashUnos = $hash = hash('sha256', $lozinka . $Korisnik->sol);
if ($Korisnik->jeAktiviran == 0) {
    die("Racun nije aktiviran");

}

if ($Korisnik->neuspjesnePrijave == 3) {
    die("Racun je zakljucan");
}


if ($hashlozinke != $hashUnos) {
    $neuspjesne = $Korisnik->neuspjesnePrijave + 1;
    $upit = "UPDATE  `korisnik` SET `neuspjesnePrijave`= {$neuspjesne} WHERE `korisnickoIme`= '{$korisnickoIme}'";
    $baza->updateDB($upit);
    die("Pogrsna lozinka");
}

$sesija = new Sesija();
$sesija->kreirajKorisnika($Korisnik->korisnickoIme, $Korisnik->uloga);


if (isset($_POST["zapamti"])) {
    $imeKolacica = "zapamti";
    $vrijednostKolacica = $Korisnik->korisnickoIme;

    // Izračunaj vrijeme isteka (jedan dan od trenutnog vremena)
    $vrijemeIsteka = time() + (24 * 60 * 60); // 24 sata * 60 minuta * 60 sekundi

    // Postavi kolačić s željenim vremenom isteka
    setcookie($imeKolacica, $vrijednostKolacica, $vrijemeIsteka, "/");


    echo "Zapamcen";
    

}
$dnevnik = new Dnevnik();
$baza = new Baza();
$qb = new QueryBuilder();
$baza->spojiDB();

$upit = $qb->select("id")->from("korisnik")->where("korisnickoIme='" . $korisnickoIme . "'")->getQuery();
$rezultat = $baza->selectDB($upit);

$redak = $rezultat->fetch_assoc();
print_r("Rezultat: " . $redak);

$dnevnik->korisnik = $redak["id"];
print_r($dnevnik);
$dnevnik->tip="Prijava";
$dnevnik->datumVrijeme= pretvoriUsqlTimestamp(VirtualnoVrijeme::virtualnoSada());
$upit = $qb->insertInto("dnevnik", ["korisnik", "tip", "datumVrijeme"])
    ->values([$dnevnik->korisnik, $dnevnik->tip, $dnevnik->datumVrijeme])->getQuery();

$baza->updateDB($upit);
print_r("Upit 2: " . $upit);
$baza->updateDB($upit);
header("Location: ../index.php");
$baza->zatvoriDB();



?>