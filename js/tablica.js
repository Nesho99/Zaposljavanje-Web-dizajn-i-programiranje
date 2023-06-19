class Tablica {
    constructor(zaglavlja, kontenjer) {
      this.podaci = [];
      this.zaglavlja = zaglavlja;
      this.kontenjer = kontenjer;
    }
  
    dodajUTablicu(stavka) {
      this.podaci.push(stavka);
    }
  
    ispisTablice() {
      const tablica = $('<table></table>');
      const redZaglavlja = $('<tr></tr>');
  
      this.zaglavlja.forEach(zaglavlje => {
        const celijaZaglavlja = $('<th></th>').text(zaglavlje.naziv);
        redZaglavlja.append(celijaZaglavlja);
      });
  
      tablica.append(redZaglavlja);
  
      this.podaci.forEach(stavka => {
        const red = $('<tr></tr>');
  
        this.zaglavlja.forEach(zaglavlje => {
          const celija = $('<td></td>').text(stavka[zaglavlje.svojstvo]);
          red.append(celija);
        });
  
        tablica.append(red);
      });
  
      $(this.kontenjer).append(tablica);
    }
  
    dohvatiPodatke(podaci) {
      podaci.forEach(stavka => {
        this.dodajUTablicu(stavka);
      });
    }
  
    osvjeziTablicu(podaci) {
      this.podaci = [];
      this.dohvatiPodatke(podaci);
    }
  }
  /*
  // Primjer korištenja
  const zaglavlja = [
    { naziv: "ID", svojstvo: "id" },
    { naziv: "Ime", svojstvo: "ime" },
    { naziv: "Radno vrijeme od", svojstvo: "radnoVrijemeOd" },
    { naziv: "Radno vrijeme do", svojstvo: "radnoVrijemeDo" },
    { naziv: "Moderator", svojstvo: "moderator" },
    { naziv: "Opis", svojstvo: "opis" }
  ];
  const kontenjer = "#mojKontenjer";
  const tablica = new Tablica(zaglavlja, kontenjer);
  
  const podaci = [
    {
      "id": "3",
      "ime": "Microsoft",
      "radnoVrijemeOd": "08:00:00",
      "radnoVrijemeDo": "16:00:00",
      "moderator": "ngeci123",
      "opis": "Windows"
    }
  ];
  
  tablica.dohvatiPodatke(podaci);
  tablica.ispisTablice();
  */