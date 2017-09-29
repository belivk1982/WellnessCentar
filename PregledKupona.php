<?php
include("baza.class.php");
include ("DohvacanjeBodova.php");
include ("sesija.class.php");
Sesija::kreirajSesiju();
$konekcijaNaBazu = new Baza();
$konekcijaNaBazu->spojiDB();
$korisnik = Sesija::dajKorisnika();
$tipKorisnik = Sesija::dajTip();
$korisnikID = DohvatiKorisnikovID($korisnik, $konekcijaNaBazu);


if(isset($_POST["definiranjeKupona"])){
    $datum = $_POST["datum_aktivacije"];
    $vrijeme = $_POST["vrijeme_aktivacije"];
    $trajanje = $_POST["trajanje"];
    $bodovi = $_POST["bodovi"];
    $kuponID = $_POST["kupon"];
    
    list($dan, $mjesec, $godina) = split('[.]', $datum);
    
    list($sat, $minuta, $sekunda) = split('[:]', $vrijeme);
    
    $danDeaktivacije = $dan + $trajanje;
    
    $d = mktime($sat, $minuta, $sekunda, $mjesec, $dan, $godina);
    $datumAktivacije = date("Y-m-d h:i:s", $d);
    
    $d = mktime($sat, $minuta, $sekunda, $mjesec, $danDeaktivacije, $godina);
    $datumDeaktivacije = date("Y-m-d h:i:s", $d);
    
    $sqlDefiniranjeKupona = "UPDATE kupon SET datum_aktivacije = '$datumAktivacije'"
            . "WHERE id_kupon = '$kuponID'";
    $sqlDefiniranjeKupona = $konekcijaNaBazu->updateDB($sqlDefiniranjeKupona);
    $sqlDefiniranjeKupona = "UPDATE kupon SET datum_deaktivacije = '$datumDeaktivacije'"
            . "WHERE id_kupon = '$kuponID'";
    $sqlDefiniranjeKupona = $konekcijaNaBazu->updateDB($sqlDefiniranjeKupona);
    $sqlDefiniranjeKupona = "UPDATE kupon SET potrebni_bodovi = '$bodovi'"
            . "WHERE id_kupon = '$kuponID'";
    $sqlDefiniranjeKupona = $konekcijaNaBazu->updateDB($sqlDefiniranjeKupona);
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
        <script type ="text/javascript" src ="ProvjeraPodatakaRegistracija.js"></script>
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
        <header>
            <h1>Pregled Kupona</h1>
        </header>
        <section id = "sekcija_definiranje_kupona">
            <h2>Definiranje Kupona</h2>
            <form action="PregledKupona.php" method="post" id="formaPregledKupona" novalidate>
                <p><label for = "datum_aktivacije">Datum aktivacije: </label>
                    <input type ="text" id ="datum_aktivacije" name="datum_aktivacije"
                           placeholder = "dd.mm.yyyyy"><br>
                    <label for ="vrijeme_aktivacije">Vrijeme aktivacije: </label>
                    <input type ="text" name="vrijeme_aktivacije" id="vrijeme_aktivacije" placeholder="##:##:##"><br>
                    <label for = "trajanje">Vrijeme trajanja: </label>
                    <input type="text" id="trajanje" name="trajanje" placeholder="u danima"><br>
                    <label for = "bodovi">Bodovi: </label>
                    <input type="text" id="bodovi" name="bodovi" placeholder="bodovi"><br>
                     <label for = "kupon">Odabir kupona: </label>
                    <?php
                    
                    $sqlKupon = "SELECT id_kupon, naziv_kupona FROM kupon JOIN kategorije_usluga ON kategorija_id = id_kategorije_usluga"
                            . " WHERE potrebni_bodovi IS NULL AND Korsinik_id_korsinik = '$korisnikID'";
                    $rezultatKupon = $konekcijaNaBazu->selectDB($sqlKupon);
                    ?>
                    <select id = "kupon" name = "kupon"/>
                    <?php
                    while ($red = mysqli_fetch_array($rezultatKupon)){
                    ?>
                        <option value = "<?php echo $red["id_kupon"] ;?>" ><?php echo $red["id_kupon"] . " " . $red["naziv_kupona"] ?></option>
                    <?php
                    }
                    ?>
                    </select><br>
                <input type ="submit"  id = "definiranjeKupona" name="definiranjeKupona" value="Definiraj Kupon">
                </p>
            </form>
        </section>
    </body>
</html>