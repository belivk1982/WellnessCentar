<?php
include("baza.class.php");
include("sesija.class.php");
Sesija::kreirajSesiju();
$tipKorisnik = Sesija::dajTip();
$konekcijaNaBazu = new Baza();
$konekcijaNaBazu->spojiDB();
$napomena = "";
if (isset($_POST["unosKupona"])) {
    $nazivKupona = $_POST["nazivKupona"];
    $slika = addslashes(file_get_contents($_FILES["slikaKupona"]["tmp_name"]));
    $kategorijaID = $_POST["kategorija"];
   
    $sqlUnosKupona = "INSERT INTO kupon(naziv_kupona,slika,kategorija_id) VALUES ('$nazivKupona', '$slika', '$kategorijaID')";
    $rezultatUnosKupona = $konekcijaNaBazu->updateDB($sqlUnosKupona);
}

if(isset($_POST["dodjelaKategorije"])){
    $moderatorID = $_POST["moderator"];
    $nazivKategorije = $_POST["nazivKategorije"];
    
    $sqlUnosKategorije = "INSERT INTO kategorije_usluga(naziv_vrste_usluge, Korsinik_id_korsinik) VALUES('$nazivKategorije','$moderatorID')";
    $rezultatUnosKategorije = $konekcijaNaBazu->updateDB($sqlUnosKategorije);
}

if(isset($_POST["provjera"])){
    $greneriraniKod = $_POST["generiraniKod"];
    $sqlProvjeraKoda = "SELECT 1 FROM kod_za_kupon WHERE generirani_kod = '$greneriraniKod'";
    $rezultatProvjeraKoda = $konekcijaNaBazu->selectDB($sqlProvjeraKoda);
    $brojRedova = mysqli_num_rows($rezultatProvjeraKoda);
    if($brojRedova > 0){
        $napomena .= " Kupon važi" . "<br>";
    }
    else{
        $napomena .= " Kupon ne važi" . "<br>";
    }
}


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Unos Kupona</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Registracija"/>
        <meta name="kljucne_rijeci" content="Projekt, Unos Kupona"/>
        <meta name="datum_izrade" content="11.06.2017."/>
        <meta name="autor" content="Josip Bijelić"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
            <h1>Unos Kupona</h1>
        </header>
        <?php if($tipKorisnik <2){ ?>
        <section id = "sekcijaUnosKupona">
            <h2>Kreiranje kupona</h2>
            <form action="UnosKupona.php" method="post" id="formaUnosKupona" enctype="multipart/form-data" novalidate>
                <p><label for = "nazivKupona">Korisničko ime: </label>
                    <input type ="text" id ="nazivKupona" name="nazivKupona" placeholder = "Naziv kupona"><br>
                    <label for = "slikaKupona">Slika: </label>
                    <input type="file" id="slikaKupona" name="slikaKupona"><br>
                    <label for = "slikaKupona">PDF: </label>
                    <input type="file" id="pdfKupona" name="pdfKupona"><br>
                    <label for = "kategorija">Odabir kateogrije: </label>
                    
                    <?php
                    
                    $sqlKategorije = "SELECT id_kategorije_usluga, naziv_vrste_usluge FROM kategorije_usluga";
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
                    </select><br>
                    <input type ="submit"  id = "unosKupona" name="unosKupona" value="Unos kupona">
                </p>
             </form>
            
            <form action="UnosKupona.php" method="post" id="formaDodjeluKategorije" enctype="multipart/form-data" novalidate>
            <h2>Kreiranje kategorija usluga</h2>
                <p>
                    <label for ="nazivKategorije">Naziv kategorije: </label>
                    <input type="text" id ="nazivKategorije" name="nazivKategorije" placeholder = "Naziv kategorije">
                    <label for = "kategorija">Odabir kateogrije: </label>
                    <?php
                    
                    $sqlModerator = "SELECT id_korisnik, korisnickoime FROM korisnik WHERE tip_korisinika_tip_korisnika_id = 2";
                    $rezultatModerator = $konekcijaNaBazu->selectDB($sqlModerator);
                    ?>
                    <select id = "moderator" name = "moderator"/>
                    <?php
                    while ($red = mysqli_fetch_array($rezultatModerator)){
                    ?>
                        <option value = "<?php echo $red["id_korisnik"] ;?>" ><?php echo $red["id_korisnik"] . " " . $red["korisnickoime"] ?></option>
                    <?php
                    }
                    ?>
                    </select><br>
                    <input type ="submit"  id = "dodjelaKategorije" name="dodjelaKategorije" value="Dodjeli kategoriju">
                </p>
            </form>
        <?php } ?>
            <form id ="provjeraKoda" method = "post" action ="UnosKupona.php">
                <p>
                    <label for="generiraniKod">Generirani kod: </label>
                    <input type ="text" id="generiraniKod" name="generiraniKod">
                    <input type ="submit" id="provjera" name="provjera" value="Provjeri Kod"><?php echo $napomena ?>
                </p>
            </form>
            

        </section>
    </body>

    <script>
        $(document).ready(function () {
            $('#unosKupona').click(function () {
                var slika = $('#slikaKupona').val();
                if (slika == '') {
                    alert("Please Select Image");
                    return false;
                } else {
                    var ekstenzija = $('#slikaKupona').val().split('.').pop().toLowerCase();
                    if (jQuery.inArray(ekstenzija, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                        alert("Nepravilan format slike");
                        $('#slikaKupona').val('');
                        return false;
                    }
                }
            });
        });
    </script>
</html>