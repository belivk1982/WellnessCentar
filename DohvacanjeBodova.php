<?php

function DohvatiKorisnikovID($korisnik, $konekcijaNaBazu){
    $sqlKorisnikID = "SELECT id_korisnik FROM korisnik WHERE korisnickoime = '$korisnik'";
    $rezultatKorisnikID = $konekcijaNaBazu->selectDB($sqlKorisnikID);
    if (mysqli_num_rows($rezultatKorisnikID) > 0) {
        $rezultat = $rezultatKorisnikID->fetch_array();
    }

    return $rezultat['id_korisnik'];
}

function BrojSkupljenihBodova($korisnikID, $konekcijaNaBazu) {
    
    $sqlSkupljeniBodovi = "SELECT SUM(broj_bodova) AS ukupno_bodovi FROM akcija JOIN napravio_akciju ON id_akcija = akcija_id "
            . "WHERE korisnik_id = '$korisnikID'";

    $rezultatUkupniBodovi = $konekcijaNaBazu->selectDB($sqlSkupljeniBodovi);
    $ukupniBodoviArray = $rezultatUkupniBodovi->fetch_array();
    return $ukupniBodoviArray['ukupno_bodovi'];
}

function PotroseniBodovi($korisnikID, $konekcijaNaBazu){
    $sqlPotroseniBodovi = "SELECT SUM(potrebni_bodovi) AS potroseni_bodovi FROM kupon JOIN potroseni_bodovi"
            . " ON id_kupon = kupon_id WHERE potroseni_bodovi.Korisnik_id = $korisnikID";
    $rezultatPotroseniBodovi = $konekcijaNaBazu->updateDB($sqlPotroseniBodovi);
    $potroseniBodoviArray = $rezultatPotroseniBodovi->fetch_array();
    return $potroseniBodoviArray["potroseni_bodovi"];
}


?>