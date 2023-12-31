<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="stilovi.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="js/glavna.js"></script>
  <script src="js/tablica.js"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <title>{$naslov}</title>
</head>

<body>
  <div id="menu">
    <ul>
      <li><a class="naslovna" href="index.php">Naslovna</a></li>

      {if empty($korisnik)}
        <li><a class="registracija" href="registracija.php">Registracija</a></li>
        <li><a class="prijava" href="prijava.php">Prijava</a></li>
      {else}
        <li><a class="listaPoslova" href="listaPoslova.php">Lista poslova</a></li>
        <li><a class="zadatciZaposlenika" href="zadatciZaposlenika.php">Zadatci zaposlenika</a></li>




        <li style="float:right"><a class="aktivna" href="./api/odjava.php">Odjava</a></li>
        <li id="logiran" style="float: right; color: white; font-size: 30px; padding: 0; margin: 0; margin-right: 5px;">
          {$korisnik["korisnik"]}</li>

        {if $korisnik["uloga"]=="admin"}
          <li><a class="poduzeca" href="poduzeca.php">Poduzeća</a></li>
          <li><a class="korisnici" href="korisnici.php">Korisnici</a></li>
          <li><a class="dnevnik" href="dnevnik.php">Dnevnik</a></li>
          <li><a class="postave" href="postavke.php">Postavke</a></li>


        {/if}
        {if $korisnik["uloga"]=="admin" || $korisnik["uloga"]=="moderator"}

          <li><a class="upravljanjePoslovima" href="upravljanjePoslovima.php">Upravljanje poslovima</a></li>
          <li><a class="kreiranjeZadataka" href="kreiranjeZadataka.php">Kreiranje zadataka</a></li>
          <li><a class="statistika" href="statistika.php">Statistika </a></li>
        {/if}


      {/if}








    </ul>
</div>