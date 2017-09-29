<?php
include ("baza.class.php");
include ("sesija.class.php");
include("DohvacanjeBodova.php");
$konekcijaNaBazu = new Baza();
$konekcijaNaBazu->spojiDB();
$korisnik = $_POST["korisnik"];
$korisnikID = DohvatiKorisnikovID($korisnik, $konekcijaNaBazu);

$skupljeniBodovi = BrojSkupljenihBodova($korisnikID, $konekcijaNaBazu);
$potroseniBodovi = PotroseniBodovi($korisnikID, $konekcijaNaBazu);
$ukupniBodovi = $skupljeniBodovi - $potroseniBodovi;

DovrseneAkcije($korisnikID, $ukupniBodovi, $konekcijaNaBazu);
$konekcijaNaBazu->zatvoriDB();


function DovrseneAkcije($korisnikID, $ukupniBodovi, $konekcijaNaBazu) {
    $sqlAkcije = "SELECT naziv_akcije, opis_akcije, broj_bodova FROM akcija JOIN napravio_akciju ON id_akcija = akcija_id "
            . "WHERE korisnik_id = '$korisnikID'";

    $rezultatAkcije = $konekcijaNaBazu->selectDB($sqlAkcije);
    echo '
        <table id = "KorisnikBodovi">
            <tr>
                <th>Naziv Akcije</th>
                <th>Opis Akcije</th>
                <th>Broj Bodova</th>
            </tr>
        ';
    
    if (mysqli_num_rows($rezultatAkcije) > 0) {
        while ($red = mysqli_fetch_assoc($rezultatAkcije)) {
            echo'
             <tr>
                <td>'.$red['naziv_akcije'] .'</td>
                <td>'. $red['opis_akcije'] .'</td>
                <td>'. $red['broj_bodova'] .'</td>
            </tr>';
            
        }
        echo '<tr>
                <td> </td>
                <td>Ukupno Bodovi: </td>
                <td>'. $ukupniBodovi .'</td>
            </tr>
        </table>
            ';
    }
}


?>