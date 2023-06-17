<?php
require_once("../pomocne/baza.class.php");
$baza =  new Baza();
$baza->spojiDB();
$upit="SELECT * FROM korisnik";
$rezultat=$baza->selectDB($upit);

echo "<table border='1'>
<tr>
<th>Korisnicko ime</th>
<th>Lozinka</th>
<th>Uloga</th>
</tr>";

while($izlaz = $rezultat->fetch_assoc()){
    echo "<tr>";
    echo "<td>" . $izlaz['korisnickoIme'] . "</td>";
    echo "<td>" . $izlaz['lozinka'] . "</td>";
    echo "<td>" . $izlaz['uloga'] . "</td>";
    echo "</tr>";
}

echo "</table>";

$baza->zatvoriDB();
?>
