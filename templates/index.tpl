<form>
<label for="od">Početak natečaja:</label>
<input type="datetime-local" id="od" name="od">
<label for="od">Kraj natječaja:</label>
<input type="datetime-local" id="do" name="do">
<button type="button" id="filtrirajNatjecaj"> Filtriraj </button>
</form>
</form>
<div id="natjecaji">
</div>
<form>
<label for="pretrazi">Pretraži:</label>
<input type="text" id="pretrazi" name="pretrazi">
<label for="smjer">Sortiraj:</label>
<select id="smjer">
  <option value="asc">Uzlazno</option>
  <option value="desc">Silazno</option>
</select>

<button type="button" id="filtrirajZaposlenika"> Filtriraj </button>
</form>
<div id="zaposlenici">
</div>