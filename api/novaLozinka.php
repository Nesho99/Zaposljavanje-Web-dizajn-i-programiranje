<?php
require_once("../pomocne/baza.class.php");
require_once("../modeli/Korisnik.class.php");
$korisnickoIme=$_GET["korisnik"];

function nasumicnaSlova() {
    $slova = array_merge(range('a', 'z'), range('A', 'Z'));
    $sol = array_rand(array_flip($slova), 10);
    return implode('', $sol);
}

function generirajHash($lozinka, $sol) {
    $hash = hash('sha256', $lozinka . $sol);
    return $hash;
};
function generirajLozinku($duljina = 8) {
    $malaSlova = 'abcdefghijklmnopqrstuvwxyz';
    $velikaSlova = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $posebniZnakovi = '!@#$%^&*';

    if($duljina < 8) {
        $duljina = 8;
    }

    $lozinka = $malaSlova[rand(0, strlen($malaSlova) - 1)];
    $lozinka .= $velikaSlova[rand(0, strlen($velikaSlova) - 1)];
    $lozinka .= $posebniZnakovi[rand(0, strlen($posebniZnakovi) - 1)];

    $sve = $malaSlova . $velikaSlova . $posebniZnakovi;
    for($i = strlen($lozinka); $i < $duljina; $i++) {
        $lozinka .= $sve[rand(0, strlen($sve) - 1)];
    }

    $lozinka = str_shuffle($lozinka);

    return $lozinka;
}

$sol= nasumicnaSlova();
$lozinka= generirajLozinku();
$hash=generirajHash($lozinka, $sol);


$baza =  new Baza();
$baza->spojiDB();


$upit = "UPDATE  `korisnik` SET `lozinka`= '{$lozinka}' ,`sol`= '{$sol}', `hashLozinke`= '{$hash}'  WHERE `korisnickoIme`= '{$korisnickoIme}'";

$baza->updateDB($upit);


$to = $email;
$naslov = "Nova lozinka";
$poruka = "Nova lozinka: " .$lozinka;
$zaglavlje = "From: sender@example.com\r\n";

$upit = "SELECT * FROM `korisnik` WHERE `korisnickoIme`= '{$korisnickoIme}'";
$rezultat = $baza->selectDB($upit);
$Korisnik = $rezultat->fetch_object("Korisnik");
$email= $Korisnik->email;
mail($to, $naslov, $poruka, $zaglavlje);





$baza->zatvoriDB();
header("Location: ../index.php");

exit; 


?>