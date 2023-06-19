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
        const vrijednost = stavka[zaglavlje.svojstvo];
        const celija = $('<td></td>').text(vrijednost !== null ? vrijednost : '');
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
