<?php
require_once("../../pomocne/Sesija.class.php");
require_once("../../pomocne/baza.class.php");
require_once("../../pomocne/QueryBuilder.class.php");
$sesija = new Sesija();
$korisnik = $sesija->dajKorisnika();


if (($korisnik["uloga"]==null)) {
    $rez = new stdClass;
    $rez->uspijeh = false;
    $rez->poruka="Nedovoljno privilegija";
    die(json_encode($rez));
}

if(isset($_POST["Posalji"])){
    if (isset($_FILES['slika']) && $_FILES['slika']['error'] === UPLOAD_ERR_OK) {
        $tmpPutanja = $_FILES['slika']['tmp_name'];
        $slika = base64_encode(file_get_contents($tmpPutanja));
        $natjecajId= $_POST["id"];
        $qb = new QueryBuilder();
        $baza= new Baza();
        $baza->spojiDB();
        $upit=$qb->select(["id"])->from("korisnik")->where("korisnickoIme= '".$korisnik["korisnik"]."'")->getQuery();
        $rez= $baza->selectDB($upit);
        $korisnikId=$rez->fetch_assoc()["id"];
        print_r($korisnikId);
        $upit=$qb->insertInto("zaposlenikprijavljennanatecaj",["zaposlenik","natjecaj","slika"])->values([$korisnikId,$natjecajId,$slika])->getQuery();
        $baza->updateDB($upit);
        $baza->zatvoriDB();
        header("Location: ../../natjecaj.php?id=".$natjecajId);


        

}

}

if(isset($_POST["Azuriraj"])){
    if (isset($_FILES['slika']) && $_FILES['slika']['error'] === UPLOAD_ERR_OK) {
        $tmpPutanja = $_FILES['slika']['tmp_name'];
        $slika = base64_encode(file_get_contents($tmpPutanja));
        $natjecajId= $_POST["id"];
        $qb = new QueryBuilder();
        $baza= new Baza();
        $baza->spojiDB();
        $upit=$qb->select(["id"])->from("korisnik")->where("korisnickoIme= '".$korisnik["korisnik"]."'")->getQuery();
        $rez= $baza->selectDB($upit);
        $korisnikId=$rez->fetch_assoc()["id"];
        $upit=$qb->update("zaposlenikprijavljennanatecaj")->set(["slika"=>$slika])->where("zaposlenik= ".$korisnikId)->getQuery();
        $baza->updateDB($upit);
        $baza->zatvoriDB();
        header("Location: ../../natjecaj.php?id=".$natjecajId);


        

}

}
if(isset($_POST["Obrisi"])){
    
        $natjecajId= $_POST["id"];
        $qb = new QueryBuilder();
        $baza= new Baza();
        $baza->spojiDB();
        $upit=$qb->select(["id"])->from("korisnik")->where("korisnickoIme= '".$korisnik["korisnik"]."'")->getQuery();
        $rez= $baza->selectDB($upit);
        $korisnikId=$rez->fetch_assoc()["id"];
        $upit=$qb->deleteFrom("zaposlenikprijavljennanatecaj")->where("zaposlenik= ".$korisnikId)->getQuery();
        $baza->updateDB($upit);
        $baza->zatvoriDB();
        header("Location: ../../natjecaj.php?id=".$natjecajId);


        

}


?>