
<style>
ul {
    list-style-type: none;
}
img {
    height: 300px; 
}
</style>

<div id="kontenjer">
    <h1>{$natjecaj->naziv}</h1><br>
    <i>Trajanje od: {$natjecaj->datumVrijemePocetak} do {$natjecaj->datumVrijemeKraj}</i><br/>
    <h3>{$natjecaj->poduzece}</h3>
    <p>OPIS: {$natjecaj->opis}</p>
    <form action="api/natjecaji/prijava.php" method="post" enctype="multipart/form-data">
        <label for="slika">Izaberite sliku:</label>
        <input type="file" id="slika" name="slika" accept="image/jpeg">
        <input type="hidden" id="id" name="id" value="{$natjecaj->id}">
        {if $status==null}
            <button name="Posalji" id="Posalji">Pošalji</button>
            {elseif $status!=$natjecaj->id}
            <button name="Posalji" id="Posalji" disabled>Pošalji</button>
            {elseif $status==$natjecaj->id}
                <button name="Azuriraj" id="Azuriraj">Ažuriraj</button>
                <button name="Obrisi" id="Obrisi">Obriši</button>
       
            

                
        {/if}
        
    </form>

    <ul>
{if !empty($kandidati)}
    {foreach $kandidati as $k}
        <li>
        <img src="data:image/jpeg;base64,{$k->slika}"/>/ <br/>
        <p>{$k->korisnickoIme}</p>
       </li>
    {/foreach}
{/if}
   
    </ul>
</div>
