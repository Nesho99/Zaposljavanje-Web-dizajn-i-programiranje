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
    $(this.kontenjer).empty();
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
        const vrijednost = stavka[zaglavlje.svojstvo];
        const celija = $('<td></td>').text(vrijednost !== null ? vrijednost : '');
        red.append(celija);
      });

      tablica.append(red);
    });

    $(this.kontenjer).append(tablica);
  }

  dohvatiPodatke(url) {
    const self = this; // Spremi referencu na this
  
    $.ajax({
      url: url,
      type: 'GET',
      dataType: 'json',
      success: function (data) {
        self.podaci = data; // Koristi spremljenu referencu umjesto this
  
      
        self.ispisTablice();
      },
      error: function (greska) {
        console.error(greska);
      }
    });
  }
  
d
  osvjeziTablicu(podaci) {
    this.podaci = [];
    this.dohvatiPodatke(podaci);
    podaci.forEach(stavka => {
      this.dodajUTablicu(stavka);
    });
  }
}
