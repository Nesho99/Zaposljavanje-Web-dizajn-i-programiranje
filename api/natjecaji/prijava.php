<?php

$sesija = new Sesija();

$korisnik = $sesija->dajKorisnika();


if (($korisnik["uloga"]==null)) {
    $rez = new stdClass;
    $rez->uspijeh = false;
    $rez->poruka="Nedovoljno privilegija";
    die(json_encode($rez));
}
if(isset($_POST["Posalji"])){
    if (isset($_FILES['image']) && $_FILES['slika']['error'] === UPLOAD_ERR_OK) {
        $tmpPutanja = $_FILES['slika']['tmp_slika'];
        $slika = base64_encode(file_get_contents($tmpPutanja));
        $natjecajId= $_POST["id"];

}

}

?>