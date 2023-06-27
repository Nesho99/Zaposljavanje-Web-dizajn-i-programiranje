<div id="kontenjer">
<h1>{$natjecaj->naziv} </h1><br>
<i>Trajanje od: {$natjecaj->datumVrijemePocetak} do {$natjecaj->datumVrijemeKraj}<i>
<br/>
<h3> {$natjecaj->poduzece}</h3>
<p>OPIS:{$natjecaj->opis}</p>
<form action="api/natjecaji/prijava.php">
<label for="img">Izaberite sliku:</label>
  <input type="file" id="slika" name="slika" accept="image/jpeg">
  <input type="hidden" id="id" name="id" value="{$natjecaj->id}">

<button id="Posalji">Pošalji</button>
</form>

</div>