<?php
include ("sesija.class.php");
Sesija::kreirajSesiju();
$tipKorisnik = Sesija::dajTip();
$korisnickoIme = Sesija::dajKorisnika();
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script type ="text/javascript" src ="ProvjeraPodatakaRegistracija.js"></script>
        <link href="https://fonts.googleapis.com/css?family=EB+Garamond|Signika" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="DizajnRegistracija.css" />
        <script>
            $(document).ready(function () {
                var korisnik = '<?php echo $korisnickoIme; ?>';
                $("#BrojSkupljenihBodova").load("BrojSkupljenihBodova.php", {
                    korisnik: korisnik
                });
            });
        </script>
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
        <section id ="BrojSkupljenihBodova">
            <h2>Broj skupljenih bodova</h2>

        </section>
    </body>

    <footer>

    </footer>