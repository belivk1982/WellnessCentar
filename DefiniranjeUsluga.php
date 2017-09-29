<?php
include("baza.class.php");
include("sesija.class.php");
include("DohvacanjeBodova.php");

$konekcijaNaBazu = new Baza();
$konekcijaNaBazu->spojiDB();

Sesija::kreirajSesiju();
$korisnik = Sesija::dajKorisnika();
$korisnikID = DohvatiKorisnikovID($korisnik, $konekcijaNaBazu);
$tipKorisnik = Sesija::dajTip();

if(isset($_POST["unesiUslugu"])){
    $nazivUsluge = $_POST["nazivUsluge"];
    $opisUsluge = $_POST["opisUsluge"];
    $vrijemeTrajanja = $_POST["vrijemeTrajanja"];
    $cijenaUsluge = $_POST["cijenaUsluge"];
    $kategorija = $_POST["kategorija"];
    
    $sqlUnosUsluge = "INSERT INTO usluga(naziv_usluga, opis_usluge, cijena_usluge, vrijeme_trajanja, vrsta_usluge_id_usluga)"
                    . " VALUES('$nazivUsluge', '$opisUsluge', '$cijenaUsluge', '$vrijemeTrajanja', '$kategorija')";
    $rezultatUnosUsluge = $konekcijaNaBazu->updateDB($sqlUnosUsluge);
    
    if(!$rezultatUnosUsluge){
        echo "Nepravilan upit" . "<br>";
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
        <section>
            <h2>Definiranje Usluge</h2>
            <form id="forma__usluga" name="forma_usluga" method="post"
                  action = "DefiniranjeUsluga.php">
                <p>
                    <label for="nazivUsluge">Naziv usluge: </label>
                    <input type ="text" id="nazivUsluge" name="nazivUsluge"><br>
                    <label for="opisUsluge">Opis usluge: </label>
                    <input type ="textarea" id ="opisUsluge" name ="opisUsluge"><br>
                    <label for="cijenaUsluge">Cijena usluge: </label>
                    <input type ="text" id ="cijenaUsluge" name ="cijenaUsluge"><br>
                    <label for ="vrijemeTrajanja">Vrijeme trajanja</label>
                    <input type ="text" id="vrijemeTrajanja" name="vrijemeTrajanja"><br>
                    <label for="kategorija">Odaberi vrsti kategorije</label>
                     <?php
                    
                    $sqlKategorije = "SELECT id_kategorije_usluga, naziv_vrste_usluge FROM kategorije_usluga"
                                   . " WHERE Korsinik_id_korsinik = '$korisnikID'";
                    $rezultatKategorije = $konekcijaNaBazu->selectDB($sqlKategorije);
                    ?>
                    <select id = "kategorija" name = "kategorija"/>
                    <?php
                    while ($red = mysqli_fetch_array($rezultatKategorije)){
                    ?>
                        <option value = "<?php echo $red["id_kategorije_usluga"] ;?>" ><?php echo $red["naziv_vrste_usluge"] ?></option>
                    <?php
                    }
                    ?>
                     <br>
                    <input type ="submit" value="Unesi uslugu" id = "unesiUslugu" name = "unesiUslugu">
                </p>
            </form>
        </section>
    </body>
    <footer>

    </footer>
</html>