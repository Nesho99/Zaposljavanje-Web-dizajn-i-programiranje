const trenutnoImeDatoteke = window.location.pathname.split('/').pop();

function popuniHTMLSelekciju(selekcijaId, podaci, vrijednosniStupac, kljucniSupac) {
    const selekcijaElement = document.getElementById(selekcijaId);


    selekcijaElement.innerHTML = '';

    // Iterate through all objects in the JSON array
    for (let i = 0; i < podaci.length; i++) {
        let stavka = podaci[i];
        let vrijednost = stavka[vrijednosniStupac];
        let kljuc = stavka[kljucniSupac];

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



function posaljiNepraznaPolja(url, formaId, tipZahtjeva = 'POST') {
    const formData = new FormData();
    const forma = $('#' + formaId);

    // Prolazak kroz elemente forme i dodavanje samo nepraznih polja u FormData
    forma.find('input, select, textarea', 'datetime-local').each(function () {
        const polje = $(this);
        const ime = polje.attr('name');
        if (polje.attr('type') === 'datetime-local') {
            var vrijednost = pretvoriUSQLDatumVrijeme(polje.val())
        } else {
            var vrijednost = polje.val();

        }

        if (vrijednost !== '') {
            formData.append(ime, vrijednost);
        }
    });

    // Provjera ima li nepraznih polja za slanje
    if (formData.size === 0) {
        console.log('Nema nepraznih polja za slanje.');
        return;
    }

    // Slanje zahtjeva koristeći jQuery AJAX
    $.ajax({
        url: url,
        type: tipZahtjeva,
        data: formData,
        processData: false,
        contentType: false,
        success: function (odgovor) {
            console.log(odgovor);
        },
        error: function (greska) {
            console.log(greska);
        }
    });
    forma.find('input, select, textarea').each(function () {
        const polje = $(this);
        polje.val = "";
    })


}

function pretvoriUSQLDatumVrijeme(isoDatumVrijeme) {
    const datum = new Date(isoDatumVrijeme);
    const godina = datum.getFullYear();
    const mjesec = String(datum.getMonth() + 1).padStart(2, '0');
    const dan = String(datum.getDate()).padStart(2, '0');
    const sati = String(datum.getHours()).padStart(2, '0');
    const minute = String(datum.getMinutes()).padStart(2, '0');
    const sekunde = String(datum.getSeconds()).padStart(2, '0');

    const sqlDatumVrijeme = `${godina}-${mjesec}-${dan} ${sati}:${minute}:${sekunde}`;
    return sqlDatumVrijeme;
}


$(document).ready(function () {
    console.log("document loaded");


    if (trenutnoImeDatoteke == "index.php") {
        $(".naslovna").addClass("aktivna");
    }

    if (trenutnoImeDatoteke == "registracija.php") {
        function korisnikPostoji() {
            var korisnik = $("#kime").val();
            $.ajax({
                url: `../api/postojiKorisnik.php?korisnik=${korisnik}`,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data.postoji === true || !provjeriKorisnickoIme()) {
                        $("#kime").css("color", "red");
                        alert("Korisnicko ime postoji ili je pre kratko");
                        return false;
                    } else {
                        $("#kime").css("color", "black");
                        return true;
                    }
                },
                error: function (error) {
                    console.log("Error:", error);
                }
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
            $.ajax({
                url: `../api/novaLozinka.php?korisnik=${korisnik}`,
                type: 'GET',
                success: function (response) {
                    alert("Nova lozinka poslana na mail");
                },
                error: function (error) {
                    console.log("Error:", error);
                }
            });



        });
    }
    if (trenutnoImeDatoteke == "poduzeca.php") {
        $(".poduzeca").addClass("aktivna");

        //Tablica
        const zaglavlja = [
            { naziv: "ID", svojstvo: "id" },
            { naziv: "Ime", svojstvo: "ime" },
            { naziv: "Radno vrijeme od", svojstvo: "radnoVrijemeOd" },
            { naziv: "Radno vrijeme do", svojstvo: "radnoVrijemeDo" },
            { naziv: "Opis", svojstvo: "opis" },
            { naziv: "Moderator", svojstvo: "moderator" }

        ];

        const tablicaPoduzeca = new Tablica(zaglavlja, "#tablicaPoduzeca");
        tablicaPoduzeca.dohvatiPodatke("/api/poduzeca/dohvati.php");
        tablicaPoduzeca.ispisTablice();


        $.ajax({
            url: '/api/uloge/dohvatiModeratore.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                console.table(data);
                popuniHTMLSelekciju("moderator", data, "id", "korisnickoIme");
            },
            error: function (error) {

                console.error(error);

            }
        });



        $("#posalji").on("click", function () {
            if ($("#id").val() == "") {
                posaljiNepraznaPolja("/api/poduzeca/kreiraj.php", "formaPoduzeca")

            }
            else {
                posaljiNepraznaPolja("/api/poduzeca/uredi.php", "formaPoduzeca")

            }
            tablicaPoduzeca.dohvatiPodatke("/api/poduzeca/dohvati.php");
            tablicaPoduzeca.ispisTablice();
        });






    }
    if (trenutnoImeDatoteke == "korisnici.php") {
        $(".korisnici").addClass("aktivna");


        //Tablica
        const zaglavlja = [
            { naziv: "ID", svojstvo: "id" },
            { naziv: "Ime", svojstvo: "ime" },
            { naziv: "Prezine", svojstvo: "prezime" },
            { naziv: "Korisničko ime ", svojstvo: "korisnickoIme" },
            { naziv: "Email", svojstvo: "email" },
            { naziv: "Aktivan", svojstvo: "jeAktiviran" },
            { naziv: "Neuspješne prijave", svojstvo: "neuspjesnePrijave" },
            { naziv: "Uloga", svojstvo: "uloga" }

        ];

        const tablicaKorisnika = new Tablica(zaglavlja, "#tablicaKorisnici");
        tablicaKorisnika.dohvatiPodatke("/api/korisnici/dohvati.php");
        tablicaKorisnika.ispisTablice();
        function osvjeziPadajuceBlokiranje() {
            $.ajax({
                url: '/api/korisnici/dohvatiAktivne.php',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    console.table(data);
                    popuniHTMLSelekciju("odblokirani", data, "id", "korisnickoIme");
                },
                error: function (error) {

                    console.error(error);

                }
            });
            $.ajax({
                url: '/api/korisnici/dohvatiBlokirane.php',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    console.table(data);
                    popuniHTMLSelekciju("blokirani", data, "id", "korisnickoIme");
                },
                error: function (error) {

                    console.error(error);

                }
            });

        }

        osvjeziPadajuceBlokiranje();




        $("#blokiraj").on("click", function () {
            var blokirajid = $("#odblokirani").val();
            $.ajax({
                url: '/api/korisnici/blokiraj.php?id=' + blokirajid,
                type: 'GET',
                success: function (success) {
                    console.log(success);
                    osvjeziPadajuceBlokiranje();
                    tablicaKorisnika.dohvatiPodatke("/api/korisnici/dohvati.php");
                    tablicaKorisnika.ispisTablice();

                },
                error: function (error) {
                    console.error(error);
                }
            });
        });

        ;
        $("#odblokiraj").on("click", function () {
            var odblokirajid = $("#blokirani").val();
            $.ajax({
                url: '/api/korisnici/deblokiraj.php?id=' + odblokirajid,
                type: 'GET',
                success: function (success) {
                    console.log(success);
                    osvjeziPadajuceBlokiranje();
                    tablicaKorisnika.dohvatiPodatke("/api/korisnici/dohvati.php");
                    tablicaKorisnika.ispisTablice();

                },
                error: function (error) {
                    console.error(error);
                }
            });
        });

        
        










    }
    if(trenutnoImeDatoteke=="dnevnik.php"){
        $(".dnevnik").addClass("aktivna");

        const zaglavlja = [
            { naziv: "Datum i vrijeme", svojstvo: "datumVrijeme" },
            { naziv: "Korisnik", svojstvo: "korisnik" },
            { naziv: "Tip", svojstvo: "tip" },
            { naziv: "Upit", svojstvo: "upit" },
            { naziv: "Radnja", svojstvo: "radnja" },
           

        ];
      

        const tablicaDnevnik = new Tablica(zaglavlja, "#tablicaDnevnik");
        tablicaDnevnik.dohvatiPodatke("/api/dnevnik/dohvati.php");
        tablicaDnevnik.ispisTablice();
        $("#pretrazi").on('click', function(){
            var od = $("#od").val();
            var destinacija = $("#do").val();
            var argumenti = {
                "od": od,
                "do": destinacija
            };
            
        
              
            
            tablicaDnevnik.dohvatiPodatke('/api/dnevnik/dohvati.php', tipZahtjeva="post",argumenti);
            tablicaDnevnik.osvjeziTablicu();

        })

      

    }
    if(trenutnoImeDatoteke=="upravljanjePoslovima.php"){

        $(".upravljanjePoslovima").addClass("aktivna");
        const zaglavlja = [
            { naziv: "ID", svojstvo: "id" },
            { naziv: "Naziv", svojstvo: "naziv" },
            { naziv: "Opis", svojstvo: "opis" },
            { naziv: "Pocetak natječaja", svojstvo: "datumVrijemePocetak" },
            { naziv: "Kraj natječaja", svojstvo: "datumVrijemeKraj"},
            {naziv: "Poduzeće", svojstvo: "poduzece"}
           

        ];
      

        const tablicaNatjecaji= new Tablica(zaglavlja, "#tablicaNatjecaji");
        tablicaNatjecaji.dohvatiPodatke("/api/natjecaji/dohvati.php");
        tablicaNatjecaji.ispisTablice();


        $.ajax({
            url: '/api/poduzeca/dohvatiPoduzecaModeratora.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                console.table(data);
                popuniHTMLSelekciju("poduzece", data, "id", "ime");
            },
            error: function (error) {

                console.error(error);
            }
        })

        $("#posalji").on("click", function () {
            if ($("#id").val() == "") {
                posaljiNepraznaPolja("/api/natjecaji/kreiraj.php", "formaUpavljanjeNatjecajima")

            }
            else {
                posaljiNepraznaPolja("/api/natjecaji/uredi.php", "formaUpavljanjeNatjecajima")

            }
            tablicaNatjecaji.dohvatiPodatke("/api/natjecaji/dohvati.php");
            tablicaNatjecaji.ispisTablice();
        });

        
        
        


    }
    if(trenutnoImeDatoteke=="listaPoslova.php"){
        $(".listaPoslova").addClass("aktivna");
    }


}
);
