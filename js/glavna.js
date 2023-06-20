const trenutnoImeDatoteke = window.location.pathname.split('/').pop();

function popuniHTMLSelekciju(selekcijaId, podaci, vrijednosniStupac, kljucniSupac) {
    const selekcijaElement = document.getElementById(selekcijaId);

    // Iteriraj kroz sve objekte u JSON nizu
    for (let i = 0; i < podaci.length; i++) {
        let stavka = podaci[i];
        let vrijednost = stavka[vrijednosniStupac];
        let kljuc = stavka[kljucniSupac];

        // Kreiraj novi element opcije i dodaj ga u selekcijski element
        let opcijaElement = document.createElement('option');
        opcijaElement.value = vrijednost;
        opcijaElement.textContent = kljuc;
        selekcijaElement.appendChild(opcijaElement);
    }
}


function jeKolacicPostavljen(imeKolacica) {
    var kolacici = document.cookie.split(';');
    for (var i = 0; i < kolacici.length; i++) {
        var kolacic = kolacici[i].trim();
        if (kolacic.indexOf(imeKolacica + '=') === 0) {
            // Kolačić je postavljen
            return true;
        }
    }
    // Kolačić nije postavljen
    return false;
}

function dohvatiKolacic(imeKolacica) {
    var ime = imeKolacica + "=";
    var dekodiraniKolacici = decodeURIComponent(document.cookie);
    var poljeKolacica = dekodiraniKolacici.split(';');

    for (var i = 0; i < poljeKolacica.length; i++) {
        var kolacic = poljeKolacica[i].trim();

        if (kolacic.indexOf(ime) === 0) {
            return kolacic.substring(ime.length, kolacic.length);
        }
    }

    return null;
}





$(document).ready(function () {
    console.log("document loaded");


    if (trenutnoImeDatoteke == "index.php") {
        $(".naslovna").addClass("aktivna");
    }

    if (trenutnoImeDatoteke == "registracija.php") {
        function korisnikPostoji() {
            var korisnik = $("#kime").val();
            fetch(`../api/postojiKorisnik.php?korisnik=${korisnik}`)
                .then(response => response.json())
                .then(data => {
                    if (data.postoji == true || !provjeriKorisnickoIme()) {
                        $("#kime").css("color", "red");
                        alert("Korisnicko ime postoji ili je pre kratko")
                        return false;
                    } else {
                        $("#kime").css("color", "black");
                        return true;
                    }
                })
                .catch(error => {
                    console.log("Error:", error);
                });
        }

        function provjeriKorisnickoIme() {
            var korisnik = $("#kime").val();
            var regex = /^[a-zA-Z0-9]+$/;
            var jeTocan = regex.test(korisnik);
            if (jeTocan && korisnik.length > 4) {
                return true;
            } else {
                return false;
            }
        }

        function provjeriIme() {
            var ime = $("#ime").val();
            var regex = /^[a-zA-Z]+$/;
            var jeTocan = regex.test(ime);
            if (jeTocan) {
                $("#ime").css("color", "black");
                return true;
            } else {
                $("#ime").css("color", "red");
                alert("Ime moze sadrzavati samo znakove")
                return false;
            }
        }
        function provjeriPrezime() {
            var prezime = $("#prezime").val();
            var regex = /^[a-zA-Z]+$/;
            var jeTocan = regex.test(prezime);
            if (jeTocan) {
                $("#prezime").css("color", "black");
                return true;
            } else {
                alert("Prezime moze sadrzavati samo znakove")
                $("#prezime").css("color", "red");
                return false;
            }
        }
        function provjeriEmail() {
            var email = $("#email").val();
            var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var jeTocan = regex.test(email);
            if (jeTocan) {
                $("#email").css("color", "black");
                return true;
            } else {
                alert("Email je u netocnom formatu")
                $("#email").css("color", "red");
                return false;
            }
        }
        function provjeriLozinku() {
            var lozinka = $("#lozinka").val();
            var regex = /^(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/;


            var jeTocan = regex.test(lozinka);
            if (jeTocan) {
                $("#lozinka").css("color", "black");
                return true;
            } else {
                $("#lozinka").css("color", "red");
                alert("Lozinka mora biti osam znakova sadrzavati broj i znak")
                return false;
            }
        }
        function ponovljenaLozinka() {
            var lozinka = $("#lozinka").val();
            var ponovljenaLozinka = $("#plozinka").val();

            if (lozinka === ponovljenaLozinka) {
                $("#plozinka").css("color", "black");
                return true;
            } else {
                $("#plozinka").css("color", "red");
                return false;
            }
        }

        $("form").on("submit", function (event) {


            if (!(provjeriIme() && provjeriKorisnickoIme() && provjeriEmail() && provjeriPrezime() && provjeriLozinku() && ponovljenaLozinka())) {
                event.preventDefault();
            } else {
                $(this).submit();
            }
        });





        $("#kime").on("blur", korisnikPostoji);
        $("#ime").on("blur", provjeriIme);
        $("#prezime").on("blur", provjeriPrezime);
        $("#email").on("blur", provjeriEmail);
        $("#lozinka").on("blur", provjeriLozinku);
        $("#plozinka").on("blur", ponovljenaLozinka);


        $(".registracija").addClass("aktivna");

    }
    if (trenutnoImeDatoteke == "prijava.php") {
        $(".prijava").addClass("aktivna");
        let jepostavljen = jeKolacicPostavljen("zapamti")
        if (jepostavljen) {
            let kolacic = dohvatiKolacic("zapamti");
            console.log(kolacic);
            $("#kime").val(kolacic);


        }


        $("#zaboravljena").on("click", function () {
            var korisnik = $("#kime").val();
            fetch(`../api/novaLozinka.php?korisnik=${korisnik}`)
                .then(alert("Nova lozinka poslana na mail"));

        });
    }
    if (trenutnoImeDatoteke == "poduzeca.php") {
        $(".poduzeca").addClass("aktivna");

        //Tablica
        fetch('/api/poduzeca/dohvati.php')
            .then(odgovor => odgovor.json())
            .then(podaci => {
                console.table(podaci);
                const zaglavlja = [
                    { naziv: "ID", svojstvo: "id" },
                    { naziv: "Ime", svojstvo: "ime" },
                    { naziv: "Radno vrijeme od", svojstvo: "radnoVrijemeOd" },
                    { naziv: "Radno vrijeme do", svojstvo: "radnoVrijemeDo" },
                    { naziv: "Opis", svojstvo: "opis" },
                    { naziv: "Moderator", svojstvo: "moderator" }

                ];
                const tablicaPoduzeca = new Tablica(zaglavlja, "#tablicaPoduzeca");
                tablicaPoduzeca.dohvatiPodatke(podaci);
                tablicaPoduzeca.ispisTablice();
            })
            .catch(greska => {
                // Obradite eventualne greške koje se pojave tokom zahtjeva
                console.error(greska);

            
            });
            

            fetch('/api/uloge/dohvatiModeratore.php')
            .then(odgovor => odgovor.json())
            .then(podaci => {
                console.table(podaci);
                popuniHTMLSelekciju("moderator",podaci,"id","korisnickoIme");
                
            })
            .catch(greska => {
                // Obradite eventualne greške koje se pojave tokom zahtjeva 
                console.error(greska);

            
            })





    }
});
