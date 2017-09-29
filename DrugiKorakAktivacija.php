<?php
include ("UnosUDnevnik.php");
include ("baza.class.php");
include ("sesija.class.php");
Sesija::kreirajSesiju();
if (isset($_POST["submitAktivacija"])) {
    UnosAktivacijskogKoda();
}

function UnosAktivacijskogKoda() {
    $napomena = "";
    if (isset($_POST["submitAktivacija"])) {
        $konekcijaNaBazu = new Baza();
        $konekcijaNaBazu->spojiDB();
        $korisnickoIme = Sesija::dajKorisnika();
        $sqlProvjeraAktivacijskogKoda = "SELECT aktivacijski_token FROM korisnik WHERE korisnickoime = '$korisnickoIme'";
        $rezultatProvjeraAktivacijskogKoda = $konekcijaNaBazu->selectDB($sqlProvjeraAktivacijskogKoda);

        $aktivacijskiKod = $rezultatProvjeraAktivacijskogKoda->fetch_array();
        if ($_POST["aktivacijskikod"] === $aktivacijskiKod["aktivacijski_token"]) {
            UnosUDnevnik("Login", $korisnickoIme, $konekcijaNaBazu);
            $sqlTipKorinsika = "SELECT tip_korisinika_tip_korisnika_id FROM korisnik"
                    . " WHERE korisnickoime = '$korisnickoIme'";
            $rezultatTipKorisnika = $konekcijaNaBazu->selectDB($sqlTipKorinsika);
            $rezultatTipKorisnikaArray = $rezultatTipKorisnika->fetch_array();
            $tipKorisnika = $rezultatTipKorisnikaArray["tip_korisinika_tip_korisnika_id"];

            Sesija::kreirajKorisnika($korisnickoIme, $tipKorisnika);
            Sesija::kreirajTip($tipKorisnika);
            header("Location: PocetnaStranica.php");
        } else {
            $napomena = "Netocan aktivacijski kod.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Prijava</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Prijava"/>
        <meta name="kljucne_rijeci" content="zadaća 1, Prijava"/>
        <meta name="datum_izrade" content="21.03.2017."/>
        <meta name="autor" content="Josip Bijelić"/>
        <link href="https://fonts.googleapis.com/css?family=EB+Garamond|Signika" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="DizajnRegistracija.css" />
        <script type ="text/javascript" src ="js/josbijeli.js"></script>
    </head>
    <header>
    </header>
    <section>
        <h2>Aktivacija</h2>

        <form id = "forma_dva_koraka" name = "forma_dva_koraka" action = "DrugiKorakAktivacija.php" method="post">
            <p>
                <label for ="aktivacijskikod">Aktivacijski kod: </label>
                <input type = "text" id = "aktivacijskikod" name = "aktivacijskikod"><br>
                <input type = 'submit' value='Prijavi se' id = 'submitAktivacija' name = 'submitAktivacija'>
            </p>
            <a href="KorisnikBodovi.php">Broj skupljenih Bodova</a>
    </section>
    <footer>

    </footer>
</html>