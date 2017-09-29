<?php
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off") {
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
}

include("baza.class.php");
include("UnosUDnevnik.php");
include ("sesija.class.php");
Sesija::kreirajSesiju();
$tipKorisnik = Sesija::dajTip();
$inputTekst = "";
$napomena = "";
if (isset($_POST["submit"])) {
    PostaviCookie($_POST["korisnickoime"]);
    $inputTekst = $_COOKIE["PamtiKorisnika"];
    $napomena = Prijava();
}

function PostaviCookie($korisnickoIme) {
    $vrijediDo = time() + (30 * 86400);
    setcookie("PamtiKorisnika", $korisnickoIme, $vrijediDo);
}

function Prijava() {
    $napomena = "";

    $korisnickoIme = $_POST["korisnickoime"];
    $lozinka = $_POST["password"];
    $kriptiranaLozinka = KriptirajLozinku($lozinka);

    $konekcijaNaBazu = new Baza();
    $konekcijaNaBazu->spojiDB();

    $sqlProvjeriKorisnickogImena = "SELECT 1 FROM korisnik WHERE korisnickoime = '$korisnickoIme'";
    $korisnikPostoji = $konekcijaNaBazu->selectDB($sqlProvjeriKorisnickogImena);

    if (mysqli_num_rows($korisnikPostoji) > 0) {
        $sqlProvjeraLozinke = "SELECT 1 FROM korisnik WHERE korisnickoime = '$korisnickoIme' and lozinka = '$lozinka' AND status_korisnickog_racuna_id_status_korisnickog_racuna = 1";
        $korisnikLozinka = $konekcijaNaBazu->selectDB($sqlProvjeraLozinke);
        if (mysqli_num_rows($korisnikLozinka) > 0) {
            Sesija::kreirajKorisnika($korisnickoIme);
            $_SESSION["korisnik"] = $korisnickoIme;
            DrugiKorakPrijave();
            $konekcijaNaBazu->zatvoriDB();
        } else {
            BlokirajKorisnika();
            $napomena = "Korisničko ime ili lozinka nisu ispravni";
        }
    } else {
        $napomena = 'Ne postoji korisnicko ime' . "<br>";
    }
    return $napomena;
}

function DrugiKorakPrijave() {
    $korisnickoIme = $_POST["korisnickoime"];

    $konekcijaNaBazu = new Baza();
    $konekcijaNaBazu->spojiDB();
    $sqlProvjeraPrijaveUDvaKoraka = "SELECT 1 FROM korisnik WHERE korisnickoime = '$korisnickoIme' and dvorazinska_prijava = 1";
    $korisnikDvorazinskaPrijava = $konekcijaNaBazu->selectDB($sqlProvjeraPrijaveUDvaKoraka);

    if (mysqli_num_rows($korisnikDvorazinskaPrijava) > 0) {

        $tajniKljuc = rand(100000, 999999);
        $tajniKljuc = sha1($tajniKljuc);
        $sqlUnosTajnogKljuca = "UPDATE korisnik SET aktivacijski_token = '$tajniKljuc' WHERE korisnickoime = '$korisnickoIme'";

        $rezultatUpdate = $konekcijaNaBazu->updateDB($sqlUnosTajnogKljuca);

        $sqlEmail = "SELECT email FROM korisnik WHERE korisnickoime = '$korisnickoIme'";
        $rezultatEmail = $konekcijaNaBazu->selectDB($sqlEmail);
        $email = $rezultatEmail->fetch_array();


        $odredisniEmail = $email["email"];
        $naslov = "Aktivacijski kod";
        $sadrzaj = "Akticacijski kod: " . $tajniKljuc;
        $zaglavljeEmaila = "From: josbijeli\r\n";
        if (mail($odredisniEmail, $naslov, $sadrzaj, $zaglavljeEmaila)) {
            header("Location: DrugiKorakAktivacija.php");
        }
        $konekcijaNaBazu->zatvoriDB();
    } else {
        $sqlTipKorinsika = "SELECT tip_korisinika_tip_korisnika_id FROM korisnik"
                . " WHERE korisnickoime = '$korisnickoIme'";
        $rezultatTipKorisnika = $konekcijaNaBazu->selectDB($sqlTipKorinsika);
        $rezultatTipKorisnikaArray = $rezultatTipKorisnika->fetch_array();
        $tipKorisnika = $rezultatTipKorisnikaArray["tip_korisinika_tip_korisnika_id"];
        
        Sesija::kreirajKorisnika($korisnickoIme);
        Sesija::kreirajTip($tipKorisnika);
        UnosUDnevnik("Login", $korisnickoIme, $konekcijaNaBazu);
        $id = DohvatiKorisnikovID($korisnickoIme, $konekcijaNaBazu);
        $sqlProvjeraIzvrseneAkcije = "SELECT 1 FROM napravio_akciju WHERE akcija_id = 2 AND korisnik_id = '$id'";
        $rezultatProvjera = $konekcijaNaBazu->selectDB($sqlProvjeraIzvrseneAkcije);
        $vraceno = mysqli_num_rows($rezultatProvjera);
        if ($vraceno == 0) {
            $sqlAkcija = "INSERT INTO napravio_akciju VALUES(2, '$id')";
            $rezultatAkcije = $konekcijaNaBazu->updateDB($sqlAkcija);
        }
        header("Location: PocetnaStranica.php");
    }
}

function DohvatiKorisnikovID($korisnickoIme, $konekcijaNaBazu) {
    $sqlKorisnikID = "SELECT id_korisnik FROM korisnik WHERE korisnickoime = '$korisnickoIme'";
    $rezultatKorisnikID = $konekcijaNaBazu->selectDB($sqlKorisnikID);
    $rezultatKorisnikIDArray = $rezultatKorisnikID->fetch_array();
    $korisnikID = $rezultatKorisnikIDArray["id_korisnik"];
    return $korisnikID;
}

function BlokirajKorisnika() {
    $konekcijaNaBazu = new Baza();
    $konekcijaNaBazu->spojiDB();
    $korisnickoIme = $_POST["korisnickoime"];
    $sqlBrojNeuspjelihPokušaja = "SELECT broj_pogresaka FROM korisnik WHERE korisnickoime = '$korisnickoIme'";

    $rezultatUpita = $konekcijaNaBazu->selectDB($sqlBrojNeuspjelihPokušaja);
    $brojNeuspjelihPokusaja = $rezultatUpita->fetch_array();
    $brojPogresaka = $brojNeuspjelihPokusaja["broj_pogresaka"];
    $brojPogresaka += 1;

    $sqlUpdateNeuspjeliPokusaji = "UPDATE korisnik SET broj_pogresaka = '$brojPogresaka' WHERE korisnickoime = '$korisnickoIme'";
    $rezultatUpdate = $konekcijaNaBazu->updateDB($sqlUpdateNeuspjeliPokusaji);

    if ($brojPogresaka == 3) {
        $korisnikID = DohvatiKorisnikovID($korisnickoIme, $konekcijaNaBazu);
        $sqlBlokiranjeKorisnika = "UPDATE korisnik SET status_korisnickog_racuna_id_status_korisnickog_racuna = 3 WHERE korisnickoime = '$korisnickoIme'";
        $konekcijaNaBazu->updateDB($sqlBlokiranjeKorisnika);
        UnosUDnevnik("Korisnik je blokiran", $korisnickoIme, $konekcijaNaBazu);
    }
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
    <body>
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
        <section>
            <h2>Prijava</h2>
            <form id="forma_prijava" name="forma_prijava" method="post"
                  action = "prijava.php">
                <p>
                    <label for="korisnickoime">Korisničko ime: </label>
                    <input type ="text" id="korisnickoime" name="korisnickoime" <?php echo "value='$inputTekst'"; ?> ><br>
                    <label for="password">Password: </label>
                    <input type ="password" id ="password" name ="password"><br>
                    <input type ="submit" value="Prijavi se" id = "submit" name = "submit">
                    <a href="zaboravljenaLozinka.php">Zaboravljena lozinka?</a>
                </p>
            </form>
        </section>
        <div>
            <?php echo $napomena . "<br>";?>
        </div>
    </body>
    <footer>

    </footer>
</html>