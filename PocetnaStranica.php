<?php
header('Content-Type: text/html; charset=utf-8');
include ("sesija.class.php");
$tipKorisnik = Sesija::dajTip();
$korisnik = Sesija::dajKorisnika();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Početna stranica</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Registracija"/>
        <meta name="kljucne_rijeci" content="Projekt, Registracija"/>
        <meta name="datum_izrade" content="26.05.2017."/>
        <meta name="autor" content="Josip Bijelić"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script type ="text/javascript" src ="ProvjeraPodatakaRegistracija.js"></script>
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <link href="https://fonts.googleapis.com/css?family=EB+Garamond|Signika" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="DizajnRegistracija.css" />       
        <script type="text/javascript">
            if (document.cookie.indexOf("UvjetiKoristenja") === -1) {
                while (1) {
                    if (PostaviCookie()) {
                        break;
                    }
                }
                alert("Kolačić je postavljen!");
                function PostaviCookie() {
                    if (confirm('Prihvaćate li uvjete korištenja kolačića?')) {
                        var d = new Date();
                        d.setDate(d.getDate() + 3);
                        document.cookie = "UvjetiKoristenja" + "=" + escape("Prihvacanje uvjeta korištenja") + ";path=/" + ";expires=" + d;
                        return true;
                    }
                    return false;
                }
            }
        </script>
    </head>
    <body>

        <header>
            <h1 class = "dobrodosli">Početna stranica</h1>
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
                <li>
                    <a href="dokumentacija.html">Dokumentacija</a>
                </li>
                <li>
                    <a href="OAutoru.html">O autoru</a>
                </li>
            </ul>
        </nav>
        <section id = "pocetna_stranica">
            <h1 class ="dobrodosli">Dobrodošli na stranicu našeg i Vašeg Wellness centra BELI</h1>
            <p class="dobrodosli">Stranica omogućava puno pogodnosti korištenja usluga koje pružamo.
                Registrirajte se, kupujte kupone i iskoristite sve pogodnosti koje pružamo
            </p>

        </section>
        <section id="slike">
            <img src="CvijeceKamenje.jpg" alt="Cvijece" width="350px"/>
            <img src="ljubicastirucnici.jpg" alt="ljubicasti" width="350px"/>
            <img src="rucnik.jpg" alt="rucnik" width="350px"/>
        </section>

        <footer>

            <g:plus action="share" class="google"></g:plus>

        </footer>
    </body>
</html>