<?php
include("sesija.class.php");
include("baza.class.php");
include("DohvacanjeBodova.php");
include("UnosUDnevnik.php");
Sesija::kreirajSesiju();
$tipKorisnik = Sesija::dajTip();

$konekcijaNaBazu = new Baza();
$konekcijaNaBazu->spojiDB();

$korisnickoIme = Sesija::dajKorisnika();


$korisnikID = DohvatiKorisnikovID($korisnickoIme, $konekcijaNaBazu);
$ispisKupona = "";
$sqlProvjeraIzvrseneAkcije = "SELECT 1 FROM napravio_akciju WHERE akcija_id = 3 AND korisnik_id = '$korisnikID'";
$rezultatProvjera = $konekcijaNaBazu->selectDB($sqlProvjeraIzvrseneAkcije);
$vraceno = mysqli_num_rows($rezultatProvjera);
if ($vraceno == 0) {
    $sqlAkcija = "INSERT INTO napravio_akciju VALUES(3, '$korisnikID')";
    $rezultatAkcije = $konekcijaNaBazu->updateDB($sqlAkcija);
}

if (isset($_POST["dodajUKosaricu"])) {
    $postoji = false;
    $sqlDohvatiKosaricu = "SELECT * FROM kosarica WHERE Korsinik_id_korsinik = '$korisnikID'";
    $rezultatKosarica = $konekcijaNaBazu->selectDB($sqlDohvatiKosaricu);
    while ($red = mysqli_fetch_array($rezultatKosarica)) {
        if ($red["kupon_id_kupon"] == $_GET["id"]) {
            $postoji = true;
        }
    }
    if ($postoji == false) {
        $kuponID = $_GET["id"];
        $naziv = $_POST["imeSkriveno"];
        $bodovi = $_POST["bodoviSkriveno"];
        $sqlUnosUKosaricu = "INSERT INTO kosarica VALUES('$korisnikID', '$kuponID')";
        $rezultatUnos = $konekcijaNaBazu->updateDB($sqlUnosUKosaricu);
        $sqlProvjeraIzvrseneAkcije = "SELECT 1 FROM napravio_akciju WHERE akcija_id = 7 AND korisnik_id = '$korisnikID'";
        $rezultatProvjera = $konekcijaNaBazu->selectDB($sqlProvjeraIzvrseneAkcije);
        $vraceno = mysqli_num_rows($rezultatProvjera);
        if ($vraceno == 0) {
            $sqlAkcija = "INSERT INTO napravio_akciju VALUES(7, '$korisnikID')";
            $rezultatAkcije = $konekcijaNaBazu->updateDB($sqlAkcija);
        }

        UnosUDnevnik("Korisnik je dodao u košaricu", $korisnickoIme, $konekcijaNaBazu);
    } else {
        $greska = "Unijeli ste kupon koji već imate u kosarici";
    }
}


if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        $sqlDohvatiKosaricu = "SELECT * FROM kosarica WHERE Korsinik_id_korsinik = '$korisnikID'";
        $rezultatKosarica = $konekcijaNaBazu->selectDB($sqlDohvatiKosaricu);
        while ($red = mysqli_fetch_array($rezultatKosarica)) {
            if ($_GET["id"] == $red["kupon_id_kupon"]) {
                $kuponID = $_GET["id"];
                $sqlBrisanjeIzKosarice = "DELETE FROM `kosarica` WHERE kupon_id_kupon = $kuponID";
                $rezultatBrisanje = $konekcijaNaBazu->updateDB($sqlBrisanjeIzKosarice);
                echo '<script>window.location="GalerijaSlika2.php"</script>';
            }
        }
    }
    if ($_GET["action"] == "kupi") {
        $sqlDohvatiKosaricu = "SELECT id_kupon, naziv_kupona, potrebni_bodovi FROM kupon JOIN kosarica ON"
                . " id_kupon = kupon_id_kupon WHERE kosarica.Korsinik_id_korsinik = '$korisnikID'";
        $sqlDohvatiSumu = "SELECT SUM(potrebni_bodovi) as Ukupno FROM kupon JOIN kosarica ON"
                .  " id_kupon = kupon_id_kupon WHERE kosarica.Korsinik_id_korsinik = '$korisnikID'";

        $rezultatSuma = $konekcijaNaBazu->selectDB($sqlDohvatiSumu);
        $rezultatSumaArray = $rezultatSuma->fetch_array();
        $ukupniBodovi = $_GET["ukupniBodovi"];
        if ($rezultatSumaArray["Ukupno"] <= $ukupniBodovi) {
            $rezultatKosarica = $konekcijaNaBazu->selectDB($sqlDohvatiKosaricu);
            while ($red3 = mysqli_fetch_array($rezultatKosarica)) {
                $kuponID = $red3["id_kupon"];
                $sqlKupljeniKuponi = "INSERT INTO potroseni_bodovi VALUES ('$korisnikID', '$kuponID')";
                $randKod = RandKodZaKupon();
                $ispisKupona .= '<p>' . $randKod . '</p>';
                $sqlKod = "INSERT INTO kod_za_kupon(generirani_kod, kupon_id)"
                        . "VALUES ('$randKod', '$kuponID')";
                $rezultatUnosKoda = $konekcijaNaBazu->updateDB($sqlKod);
                $rezultatKupi = $konekcijaNaBazu->updateDB($sqlKupljeniKuponi);
                $sqlBrisanjeIzKosarice = "DELETE FROM `kosarica` WHERE kupon_id_kupon = $kuponID";
                $rezultatBrisi = $konekcijaNaBazu->updateDB($sqlBrisanjeIzKosarice);
                UnosUDnevnik("Korisnik je odabrao kupon", $korisnickoIme, $konekcijaNaBazu);
            }
            $sqlProvjeraIzvrseneAkcije = "SELECT 1 FROM napravio_akciju WHERE akcija_id = 8 AND korisnik_id = '$korisnikID'";
            $rezultatProvjera = $konekcijaNaBazu->selectDB($sqlProvjeraIzvrseneAkcije);
            $vraceno = mysqli_num_rows($rezultatProvjera);
            if ($vraceno == 0) {
                $sqlAkcija = "INSERT INTO napravio_akciju VALUES(8, '$korisnikID')";
                $rezultatAkcije = $konekcijaNaBazu->updateDB($sqlAkcija);
            }
        }
        else{
            echo "Previše kupona" . "<br>";
        }
    }
}

function RandKodZaKupon($duljinaKoda = 20) {
    $znakovi = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $brojZnakova = strlen($znakovi);
    $randomKod = '';
    for ($i = 0; $i < $duljinaKoda; $i++) {
        $randomKod .= $znakovi[rand(0, $brojZnakova - 1)];
    }
    return $randomKod;
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Galerija slika</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Registracija"/>
        <meta name="kljucne_rijeci" content="Projekt, Registracija"/>
        <meta name="datum_izrade" content="26.05.2017."/>
        <meta name="autor" content="Josip Bijelić"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script type ="text/javascript" src ="ProvjeraPodatakaRegistracija.js"></script>
        <link href="https://fonts.googleapis.com/css?family=EB+Garamond|Signika" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="DizajnRegistracija.css" />
    </head>
    <header>
        <?php
        if (!empty($tipKorisnik)) {
            ?>
            <a href="odjava.php">Odjava</a>
        <?php } ?>
    </header>
    <body>
        <nav id = "navigacija">
            <ul>
                <?php if (empty($tipKorisnik)) { ?>
                    <li>
                        <a href="Registracija.php">Registracija</a>
                    </li>
                    <li>
                        <a href="prijava.php">Prijava</a>
                    </li>
                <?php } ?>
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
        <section id ="kuponi">
            <?php
            $sqlKategorije = "SELECT naziv_vrste_usluge, id_kategorije_usluga FROM kategorije_usluga";
            $rezultatKategorije = $konekcijaNaBazu->selectDB($sqlKategorije);
            while ($red = mysqli_fetch_array($rezultatKategorije)) {
                $kategorija = $red["naziv_vrste_usluge"];
                $kategorijaID = $red["id_kategorije_usluga"];
                ?>
                <section id="<?php $red["id_kategorije_usluga"]; ?>">
                    <h2><?php echo "$kategorija" ?></h2>
                    <?php
                    $korisnikID = DohvatiKorisnikovID($korisnickoIme, $konekcijaNaBazu);
                    $potroseniBodovi = PotroseniBodovi($korisnikID, $konekcijaNaBazu);
                    $skupljeniBodovi = BrojSkupljenihBodova($korisnikID, $konekcijaNaBazu);
                    $ukupniBodovi = $skupljeniBodovi - $potroseniBodovi;
                    $danasnjiDatum = date("Y-m-d h:i:s");
                    $sqlSlike = "SELECT * FROM kupon WHERE kategorija_id = '$kategorijaID'"
                            . "AND '$danasnjiDatum' BETWEEN datum_aktivacije AND datum_deaktivacije AND potrebni_bodovi <= '$ukupniBodovi'";
                    $rezultatUsluga = $konekcijaNaBazu->selectDB($sqlSlike);
                    while ($red2 = mysqli_fetch_array($rezultatUsluga)) {
                        ?>
                        <article id ="<?php echo $red2["id_kupon"]; ?>">
                            <?php
                            $slika = $red2["slika"];
                            echo '<img src ="data:image/png;base64,' . base64_encode($slika) . '">' . "  ";
                            echo '<h4>' . $red2["naziv_kupona"] . "</h4>";
                            ?>
                            <form method = "post" action="GalerijaSlika2.php?action==add&id=<?php echo $red2["id_kupon"]; ?>">
                                <input type ="hidden" name ="imeSkriveno" value="<?php $red2["naziv_kupona"] ?>"/>
                                <input type ="hidden" name ="bodoviSkriveno" value="<?php $red2["potrebni_bodovi"]; ?>"/>
                                <input type="submit" name="dodajUKosaricu" value="Dodaj U Kosaricu">
                                </article>        
                            </form>

                            <?php
                        }
                        ?>
                </section>
                <?php
            }
            ?>

        </section>
        <section id ="kosarica">
            <div id ="tablica">
                <table>
                    <tr>
                        <th>
                            Naziv Kupona
                        </th>
                        <th>
                            Bodovi
                        </th>
                        <th>
                            Obrisi
                        </th>
                    </tr>
                    <?php
                    $sqlDohvatiKosaricu = "SELECT id_kupon, naziv_kupona, potrebni_bodovi FROM kupon JOIN kosarica ON"
                            . " id_kupon = kupon_id_kupon WHERE kosarica.Korsinik_id_korsinik = '$korisnikID'";

                    $rezultatKosarica = $konekcijaNaBazu->selectDB($sqlDohvatiKosaricu);
                    while ($red3 = mysqli_fetch_array($rezultatKosarica)) {
                        ?>
                        <tr>
                            <td><?php echo $red3["naziv_kupona"]; ?></td>
                            <td><?php echo $red3["potrebni_bodovi"]; ?></td>
                            <td><a href="GalerijaSlika2.php?action=delete&id=<?php echo $red3["id_kupon"] ?>"><span>Obrisi</span></a></td>
                        </tr>

                        <?php
                    }
                    ?>
                </table>
                <a href="GalerijaSlika2.php?action=kupi&ukupniBodovi=<?php echo $ukupniBodovi ?>">Kupi</a>
            </div>

            <div id="kodovi">
                <?php echo $ispisKupona; ?>
                <button onclick = "Printaj()">Printaj</button>
            </div>
        </section>
    </body>
    <footer>

    </footer>
    <script>
        function Printaj() {
            var prozorZaPrintanje = window.open('', 'PRINT', 'height=600,width=900');
            var naslov = "Generirani kodovi";
            prozorZaPrintanje.document.write('<html><head><title>' + naslov + '</title>');
            prozorZaPrintanje.document.write('</head><body >');
            prozorZaPrintanje.document.write('<h1>' + naslov + '</h1>');
            prozorZaPrintanje.document.write(document.getElementById("kodovi").innerHTML);
            prozorZaPrintanje.document.write('</body></html>');

            prozorZaPrintanje.print();
            prozorZaPrintanje.close();
        }
    </script>

</html>
