<?php
include ("baza.class.php");
include ("sesija.class.php");
Sesija::kreirajSesiju();
$tipKorisnik = Sesija::dajTip();
$konekcijaNaBazu = new Baza();
$konekcijaNaBazu->spojiDB();

function DohvatiKategorije($kategorijaID, $konekcijaNaBazu) {
    $sqlUsluga = "SELECT naziv_usluga, opis_usluge, cijena_usluge  FROM usluga WHERE vrsta_usluge_id_usluga = '$kategorijaID' ORDER BY broj_prodaje_usluge";
    $rezultatUsluge = $konekcijaNaBazu->selectDB($sqlUsluga);

    if (mysqli_num_rows($rezultatUsluge) > 0) {
        echo '
            <table style="border:2px">
                <tr>
                    <th>
                        Naziv Usluge
                    </th>
                    <th>
                        Opis Usluge
                    </th>
                    <th>
                        Cijena Usluge
                    </th>
                </tr>
            ';
        while ($red = mysqli_fetch_assoc($rezultatUsluge)) {
            echo '
                <tr>
                    <td>'
            . $red['naziv_usluga'] .
            '</td>
                    <td>'
            . $red['opis_usluge'] .
            '</td>
                    <td>'
            . $red['cijena_usluge'] .
            '</td>
                </tr>
            
            ';
        }
        echo '</table>';
    }
}
?>
<html>
    <head>
        <title>Popis proizvoda</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Popis proizvoda"/>
        <meta name="kljucne_rijeci" content="zadaća 1,popis proizvoda"/>
        <meta name="datum_izrade" content="21.03.2017."/>
        <meta name="autor" content="Josip Bijelić"/>
        <link href="https://fonts.googleapis.com/css?family=EB+Garamond|Signika" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="DizajnRegistracija.css" />

    </head>

    <body>
        <header>
            <?php
            if (!empty($tipKorisnik)) {
                ?>
                <a href="odjava.php">Odjava</a>
            <?php } ?>
        </header>
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
        <section id ="popisKategorija">
            <?php
            $sqlKategorije = 'SELECT id_kategorije_usluga, naziv_vrste_usluge FROM kategorije_usluga';
            $rezultatKategorije = $konekcijaNaBazu->selectDB($sqlKategorije);

            if (mysqli_num_rows($rezultatKategorije) > 0) {
                $kategorija = "";
                while ($red = mysqli_fetch_assoc($rezultatKategorije)) {
                    $kategorija = $red['naziv_vrste_usluge'];
                    $kategorijaID = $red['id_kategorije_usluga'];
                    ?>
                    <a href="PopisKategorija.php?id=<?php echo $kategorijaID; ?>"> <?php echo $kategorija; ?></a>
                    <?php
                    echo "<br>";
                }
            }
            if (isset($_GET["id"])) {
                $kategorijaID = $_GET["id"];
                ?>
                <section id="<?php echo $kategorija ?>">
                    <?php
                    DohvatiKategorije($kategorijaID, $konekcijaNaBazu);
                    ?>
                </section>        
                <?php
            }
            ?>
        </section>
        <footer>

        </footer>
    </body>
</html>