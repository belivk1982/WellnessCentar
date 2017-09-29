<?php
include ("baza.class.php");
include ("UnosUDnevnik.php");
include ("sesija.class.php");
$konekcijaNaBazu = new Baza();
$konekcijaNaBazu->spojiDB();
$korisnickoIme = Sesija::dajKorisnika();
$tipKorisnik = Sesija::dajTip();


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dnevnik</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Dnevnik"/>
        <meta name="kljucne_rijeci" content="Dnevnik"/>
        <meta name="datum_izrade" content="12.06.2017."/>
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
        <section id ="PopisDnevnik">
            <table id ="TablePopisDnevnik" border = 2px>
                <tr>
                    <th>
                        Opis
                    </th>
                    <th>
                        Datum
                    </th>
                    <th>
                        Korisnik
                    </th>
                </tr>
                <?php
                $sqlPopisDnevnik = "SELECT opis, datum, korisnickoime "
                        . " FROM dnevnik_rada JOIN korisnik"
                        . " ON id_korisnik = korisnik_id";
                $rezultatPopisDnevnik = $konekcijaNaBazu->selectDB($sqlPopisDnevnik);
                while ($red = mysqli_fetch_array($rezultatPopisDnevnik)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $red["opis"]; ?>
                        </td>
                        <td>
                            <?php echo $red["datum"]; ?>
                        </td>
                        <td>
                            <?php echo $red["korisnickoime"]; ?>
                        </td>
                    </tr>  
                    <?php
                }
                ?>
            </table>
        </section>
        <footer>

        </footer>
    </body>
</html>