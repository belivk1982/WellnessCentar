<?php
include("baza.class.php");
$konekcijaNaBazu = new Baza();
$konekcijaNaBazu->spojiDB();
$korisnickoIme = $_POST["korisnicko_ime"];
$sqlProvjeraKorisnickogImena = "SELECT korisnickoime FROM korisnik WHERE korisnickoime = '$korisnickoIme'";
$rezultatUpita = $konekcijaNaBazu->selectDB($sqlProvjeraKorisnickogImena);

if (mysqli_num_rows($rezultatUpita) > 0) {
    echo "Korisnik već postoji";
} else {
    echo "OK";
}
$konekcijaNaBazu->zatvoriDB();
