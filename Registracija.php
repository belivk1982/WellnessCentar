<?php
include("baza.class.php");
include ("sesija.class.php");
$neispravniPodaci = "";
$napomena = "";
Sesija::kreirajSesiju();
$tipKorisnik = Sesija::dajTip();
if (isset($_POST["submit"])) {
    $dvaKoraka = false;
    $dvaKoraka = PrijavaUDvaKoraka();

    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $tajniKljuc = "6LdGYCMUAAAAAAAAzuhEq8EZiDXUaxgx2Wg2KgBI";

    if (ProvjeraUnesenihPodataka() && ProvjeraLozinke() && ProvjeraKontakta() && ReCaptcha($url, $tajniKljuc)){
        $napomena = UnosKorisnikaUBazu($dvaKoraka);
        $neispravniPodaci = "Registrirani ste!";
    }
    else {
        $neispravniPodaci = "Neispravni podaci!";
    }
}

function PrijavaUDvaKoraka() {
    if (isset($_POST["dvakoraka"])) {
        return true;
        echo "Da" . "<br>";
    }
    return false;
    echo "Ne"."<br>";
}

function ReCaptcha($url, $tajniKljuc) {
    $odgovor = file_get_contents($url . "?secret=" . $tajniKljuc . "&response=" . $_POST['g-recaptcha-response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
    $data = json_decode($odgovor);
    if (isset($data->success)AND $data->success == true) {
        return true;
    } else {
        return false;
    }
}

function ProvjeraUnesenihPodataka() {
    if (empty($_POST["korisnicko_ime"])) {
        return false;
    }
    if (empty($_POST["password"])) {
        return false;
    }
    if (empty($_POST["password2"])) {
        return false;
    }
    if (empty($_POST["ime"])) {
        return false;
    }
    if (empty($_POST["prezime"])) {
        return false;
    }
    if (empty($_POST["email"])) {
        return false;
    }
    if (empty($_POST["kontakt"])) {
        return false;
    }
    if (empty($_POST["adresa"])) {
        return false;
    }
    return true;
}

function ProvjeraLozinke() {
    $lozinka = $_POST["password"];
    $ponovljenaLozinka = $_POST["password2"];
    $regex = '(^(?=(?:.*[A-Z]){2,})(?=(?:.*[a-z]){2,})(?=(?:.*[0-9]){1,})\S{5,15}$)';
    if (!preg_match($regex, $lozinka)) {
        return false;
    }
    if ($lozinka != $ponovljenaLozinka) {
        return false;
    }
    return true;
}

function ProvjeraKontakta() {
    $kontakt = $_POST["kontakt"];
    if (!(is_numeric($kontakt))) {
        return false;
    }
    $formatKontakta = '(^9[1-9][0-9]{6}[0-9]$)';
    if (!preg_match($formatKontakta, $kontakt)) {
        return false;
    }
    return true;
}

function UnosKorisnikaUBazu($dvaKoraka) {
    $konekcijaUnosKorisnika = new Baza();
    $konekcijaUnosKorisnika->spojiDB();
    $korisnickoIme = $_POST["korisnicko_ime"];
    $lozinka = $_POST["password"];
    $ime = $_POST["ime"];
    $prezime = $_POST["prezime"];
    $kontakt = $_POST["kontakt"];
    $adresa = $_POST["adresa"];
    $email = $_POST["email"];
    $danasnjiDatum = date("Y-m-d h:i:s");

    $kriptiranaLozinka = KriptirajLozinku($lozinka);


    $sqlUnosNovogKorisnika = "INSERT INTO korisnik VALUES (default, '$lozinka',"
            . "'$kriptiranaLozinka', '$ime', '$prezime', '$korisnickoIme', "
            . "'$email','$adresa','$kontakt', 4, 2, '$dvaKoraka', default, 0,'$danasnjiDatum')";
    $rezultatUnosa = $konekcijaUnosKorisnika->insertDB($sqlUnosNovogKorisnika);
    
    $link = 'http://barka.foi.hr/WebDiP/2016_projekti/WebDiP2016x012/Projekt/AktivacijaKorisnickogRacuna.php' . "?id=" . $rezultatUnosa;
    $odredisniEmail = $email;
    $naslov = "Aktivacijski link";
    $sadrzaj = "Klikni ovdje kako bi aktivirao account. <a href='" . $link . "'>" . $link . "</a>";
    $zaglavljeEmaila = "From: josbijeli\r\n";
    if (mail($odredisniEmail, $naslov, $sadrzaj, $zaglavljeEmaila)) {
        $napomena = "Account je kreiran, aktivacijski link vam je poslan na email.";
    }
 else {
        $napomena = "Problem s email adresom!";
    }
    $konekcijaUnosKorisnika->zatvoriDB();
    return $napomena;
}

function KriptirajLozinku($lozinka) {
    $kriptiranaLozinka = sha1($lozinka);
    settype($kriptiranaLozinka, "string");
    return $kriptiranaLozinka;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Registracija</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Registracija"/>
        <meta name="kljucne_rijeci" content="Projekt, Registracija"/>
        <meta name="datum_izrade" content="26.05.2017."/>
        <meta name="autor" content="Josip Bijelić"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script type ="text/javascript" src ="ProvjeraPodatakaRegistracija.js"></script>
        <link href="https://fonts.googleapis.com/css?family=EB+Garamond|Signika" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="DizajnRegistracija.css" />
    </head>
    <body onload="KreirajDogadaj();">
        <script type="text/javascript">
            function provjeraKorisnika(val) {
                $.ajax({
                    type: "POST",
                    url: "ProvjeriKorisnika.php",
                    data: 'korisnicko_ime=' + val,
                    success: function (data) {
                        $("#greske").html(data);
                    }
                })
            }
        </script>
        <header>
            <h1>Registracija</h1>
        </header>
        <nav id = "navigacija">
            <ul>
                <?php if(empty($tipKorisnik)){?>
                <li>
                    <a href="Registracija.php">Registracija</a>
                </li>
                <li>
                    <a href="prijava.php">Prijava</a>
                </li>
                <?php }?>
                <?php if (!empty($tipKorisnik)) { ?>
                    <li>
                        <a href="GalerijaSlika2.php">Kuponi</a>
                    </li>
                    <li>
                        <a href="KorisnikBodovi.php">Informacija o bodovima</a>
                    </li>
                <?php } ?>
                <li>
                    <a href="PocetnaStranica.php">Početna</a>
                </li>
                <li>
                    <a href="PopisKategorija.php">Popis kategorija</a>
                </li>
                <?php if ($tipKorisnik < 2 && !empty($tipKorisnik)) { ?>

                    
                    <li>
                        <a href="PregledKorisnika.php">Pregled korisnika</a>
                    </li>
                    <li>
                        <a href="PregledDnevnika.php">Pregled dnevnika</a>
                    </li>
                <?php } ?>
                <?php if ($tipKorisnik < 3 && !empty($tipKorisnik)) { ?>
                    <li>
                        <a href="PregledKupona.php">Pregled kupona</a>
                    </li>
                    <li>
                        <a href="DefiniranjeUsluga.php">Definiranje usluga</a>
                    </li>
                    <li>
                        <a href="UnosKupona.php">Unos kupona</a>
                    </li>

                <?php } ?>
            </ul>
        </nav>
        <section id = "sekcija_registracija">
            <h2>Obrazac za registraciju</h2>
            <form action="Registracija.php" method="post" id="formaregistracija" novalidate>
                <p><label for = "korisnicko_ime">Korisničko ime: </label>
                    <input type ="text" id ="korisnicko_ime" name="korisnicko_ime"
                           placeholder = "Korisničko ime" onkeyup="provjeraKorisnika(this.value)"><br>
                    <label for ="password">Lozinka: </label>
                    <input type ="password" id ="password" name ="password" placeholder ="Lozinka"><br>
                    <label for ="password2">Ponovi lozinku: </label>
                    <input type ="password" id ="password2" name="password2"
                           required ="required"><br>
                    <label for ="ime">Ime: </label>
                    <input type="text" id ="ime" name ="ime"
                           placeholder ="Ime"><br>
                    <label for ="prezime">Prezime: </label>
                    <input type ="text" id ="prezime" name ="prezime"
                           placeholder="Prezime"><br>
                    <label for ="email">Email: </label>
                    <input type ="text" id="email" name="email" placeholder="E-mail"><br>
                    <label for ="adresa">Adresa: </label>
                    <input type="text" id="adresa" name="adresa" placeholder="Adresa"><br>
                    <label for="kontakt">Kontakt: +385</label>
                    <input type="text" id="kontakt" name="kontakt" placeholder="Kontakt"><br>
                    <label for ="dvakoraka"></label>
                    <input type ="checkbox" name ="dvakoraka" id="dvakoraka" value="Da">Prijava u dva koraka<br>
                <div class="g-recaptcha" data-sitekey="6LdGYCMUAAAAAMUzrs4j3_WG4Y4s9yTr-r0bcFbJ"></div>
                <input type ="submit"  id = "submit" name="submit" value="Registracija" id ="registracija">
                </p>

            </form>
            <div id="greske">
                 <?php echo $neispravniPodaci . "<br>" ;?>
            </div>

        </section>
    </body>
</html>