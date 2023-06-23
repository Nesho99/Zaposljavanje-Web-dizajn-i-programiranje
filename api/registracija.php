<?php
require_once("../pomocne/baza.class.php");
require_once("../pomocne/datumi.lib.php");
require_once("../pomocne/VirtualnoVrijeme.class.php");


function nasumicnaSlova() {
    $slova = array_merge(range('a', 'z'), range('A', 'Z'));
    $sol = array_rand(array_flip($slova), 10);
    return implode('', $sol);
}

function generirajHash($lozinka, $sol) {
    $hash = hash('sha256', $lozinka . $sol);
    return $hash;
};



function provjeriKorisnickoIme($korisnik) {
    $regex = '/^[a-zA-Z0-9]+$/';
    $jeTocan = preg_match($regex, $korisnik);
    if ($jeTocan && strlen($korisnik) > 4) {
        return true;
    } else {
        die("Korisničko ime je pogrešno");
    }
}

function provjeriIme($ime) {
    $regex = '/^[a-zA-Z]+$/';
    $jeTocan = preg_match($regex, $ime);
    if ($jeTocan) {
        return true;
    } else {
        die("Ime može sadržavati samo slova");
    }
}

function provjeriPrezime($prezime) {
    $regex = '/^[a-zA-Z]+$/';
    $jeTocan = preg_match($regex, $prezime);
    if ($jeTocan) {
        return true;
    } else {
        die("Prezime može sadržavati samo slova");
    }
}

function provjeriEmail($email) {
    $regex = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
    $jeTocan = preg_match($regex, $email);
    if ($jeTocan) {
        return true;
    } else {
        die("Email je u neispravnom formatu");
    }
}

function provjeriLozinku($lozinka) {
    $regex = '/^(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/';
    $jeTocan = preg_match($regex, $lozinka);
    if ($jeTocan) {
        return true;
    } else {
        die("Lozinka mora sadržavati najmanje osam znakova, uključujući jedno veliko slovo i jedan posebni znak");
    }
}

function ponovljenaLozinka($lozinka, $ponovljenaLozinka) {
    if ($lozinka === $ponovljenaLozinka) {
        return true;
    } else {
        die("Ponovljena lozinka je netočna");
    }
}

if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {

    $kljuc = '6Lfp06QmAAAAAIj0cRjZHHG4-4K0-UaRv_S9EKN3';

    $odgovor = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $kljuc . '&response=' . $_POST['g-recaptcha-response']);


    $odgovor = json_decode($odgovor);

    if ($odgovor->success!=1) {
        die("Pogrešna captcha");

    }
}else{
    die("Popunite captchu");
}

$ime = $_POST["ime"];
$prezime = $_POST["prezime"];
$korinsckoIme = $_POST["kime"];
$lozinka = $_POST["lozinka"];
$ponovljenaLozinka = $_POST["plozinka"];
$email = $_POST["email"];
$sol = nasumicnaSlova();
$link = nasumicnaSlova();
$hash = generirajHash($lozinka, $sol);
$datumKreacije = pretvoriUsqlTimestamp(VirtualnoVrijeme::virtualnoSada());

// Provjere
provjeriIme($ime);
provjeriPrezime($prezime);
provjeriKorisnickoIme($korinsckoIme);
provjeriLozinku($lozinka);
provjeriEmail($email);
ponovljenaLozinka($lozinka, $ponovljenaLozinka);

// Spajanje na bazu i izvršavanje upita
$baza = new Baza();
$baza->spojiDB();

$upit = "INSERT INTO `korisnik`(`id`, `ime`, `prezime`, `korisnickoIme`, `lozinka`, `email`, `hashLozinke`, `sol`, `linkAktivacije`, `jeAktiviran`, `vrijemeRegistracije`, `neuspjesnePrijave`, `datumPrihvacanjaUvjeta`, `uloga`) 
         VALUES (DEFAULT, '$ime', '$prezime', '$korinsckoIme', '$lozinka', '$email', '$hash', '$sol', '$link', 0, '$datumKreacije', 0, NULL, 'korisnik')";
$rezultat = $baza->updateDB($upit,"../registracija.php");
$baza->zatvoriDB();

//Posalji mail
$server = $_SERVER['HTTP_HOST'];

$putanja = "{$server}/api/aktiviraj.php?link={$link}";

$to = $email;
$naslov = "Link za aktivaciju";
$poruka = "Link za aktivaciju " . $putanja;
$zaglavlje = "From: sender@example.com\r\n";

mail($to, $naslov, $poruka, $zaglavlje);


header("Location: ../index.php");

?>
