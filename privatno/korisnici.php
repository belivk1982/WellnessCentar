<?php


include ("../baza.class.php");
$bazaPodataka = new Baza();
$bazaPodataka->spojiDB();
$sqlKorisnici = "SELECT korisnickoime, lozinka, tip_korisnika.naziv AS vrsta
                 FROM korisnik
                 JOIN tip_korisnika ON korisnik.tip_korisinika_tip_korisnika_id = tip_korisnika.tip_korisnika_id";

$Korisnici = $bazaPodataka->selectDB($sqlKorisnici);
echo "<table>
                <thead>
                    <tr>
                        <th>Korisnicko ime</th<th>Lozinka</th><th>Id uloge</th>          
                    </tr>
                </thead>
                <tbody>";
while($red = $Korisnici->fetch_array()){
    echo "<tr>";
    echo "<td>".$red['korisnickoime']."</td>" . "<td>".$red['lozinka']."</td>"."<td>".$red['vrsta']."</td>";
    echo "</tr>";
}
echo "</tbody></table>";
$bazaPodataka->zatvoriDB();
?>