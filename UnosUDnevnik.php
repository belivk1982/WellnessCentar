<?php
function UnosUDnevnik($opis, $korisnickoIme, $konekcijaNaBazu){
    $sqlKorisnikID = "SELECT id_korisnik FROM korisnik WHERE korisnickoime = '$korisnickoIme'";
            $rezultatKorisnikID = $konekcijaNaBazu->selectDB($sqlKorisnikID);
            $rezultatKorisnikIDArray = $rezultatKorisnikID->fetch_array();
            $korisnikID = $rezultatKorisnikIDArray["id_korisnik"];
            $trenutnoVrijeme = date("Y-m-d h:i:s");
            $sqlUnosDnevnik = "INSERT INTO dnevnik_rada(datum, opis, korisnik_id)"
                    . " VALUES('$trenutnoVrijeme','$opis','$korisnikID')";
            $sqlUnosDnevnik = $konekcijaNaBazu->updateDB($sqlUnosDnevnik);
}

?>
