<?php
include ("baza.class.php");
include ("UnosUDnevnik.php");
include ("sesija.class.php");
$konekcijaNaBazu = new Baza();
$konekcijaNaBazu->spojiDB();
$korisnickoIme = Sesija::dajKorisnika();
$tipKorisnik = Sesija::dajTip();


if (isset($_GET["action"])) {
    if ($_GET["action"] == "zakljucaj") {
        $korisnikID = $_GET["id"];
        $statusKorisnika = DohvatiStatus($korisnikID, $konekcijaNaBazu);
        if ($statusKorisnika == 1 || $statusKorisnika == 2) {
            $sqlBlokirajKorisnika = "UPDATE korisnik SET status_korisnickog_racuna_id_status_korisnickog_racuna = 3 WHERE id_korisnik = '$korisnikID'";
            $rezultatBlokriajKorisnika = $konekcijaNaBazu->updateDB($sqlBlokirajKorisnika);
            UnosUDnevnik("Administrator je zaključao korisnika", $korisnickoIme, $konekcijaNaBazu);
            echo '<script>window.location="PregledKorisnika.php"</script>';
        } else {
            echo '<script>window.location="PregledKorisnika.php"</script>';
        }
    }
    if ($_GET["action"] == "otkljucaj") {
        $korisnikID = $_GET["id"];
        $statusKorisnika = DohvatiStatus($korisnikID, $konekcijaNaBazu);
        if ($statusKorisnika == 3) {
            $sqlOtkljucajKorisnika = "UPDATE korisnik SET status_korisnickog_racuna_id_status_korisnickog_racuna = 1 WHERE id_korisnik = '$korisnikID'";
            $rezultatOtkljucajKorisnika = $konekcijaNaBazu->updateDB($sqlOtkljucajKorisnika);
            UnosUDnevnik("Administrator je otključao korisnika", $korisnickoIme, $konekcijaNaBazu);
        } else {
            echo '<script>window.location="PregledKorisnika.php"</script>';
        }
    }
}

function DohvatiStatus($korisnikID, $konekcijaNaBazu) {
    $sqlDohvatiStatus = "SELECT status_korisnickog_racuna_id_status_korisnickog_racuna FROM korisnik WHERE id_korisnik = '$korisnikID'";
    $rezultatDohvatiStatus = $konekcijaNaBazu->selectDB($sqlDohvatiStatus);
    $rezultatDohvatiStatusArray = $rezultatDohvatiStatus->fetch_array();

    return $rezultatDohvatiStatusArray["status_korisnickog_racuna_id_status_korisnickog_racuna"];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>PregledKorisnika</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Popis proizvoda"/>
        <meta name="kljucne_rijeci" content="zadaća 1,popis proizvoda"/>
        <meta name="datum_izrade" content="21.03.2017."/>
        <meta name="autor" content="Josip Bijelić"/>
        <link href="https://fonts.googleapis.com/css?family=EB+Garamond|Signika" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="DizajnRegistracija.css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
        <section id ="PopisKorisnika">
            <table id ="TablePopisKorisnika" border = 2px>
                <tr>
                    <th>
                        Korisnicko ime
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Ime
                    </th>
                    <th>
                        Prezime
                    </th>
                    <th>
                        Status korisnickog racuna
                    </th>
                    <th>
                        Akcija Blokiranje
                    </th>
                    <th>
                        Akcija Otključavanje
                    </th>
                </tr>
                <?php
                $sqlPopisKorisnika = "SELECT id_korisnik, korisnickoime, email, ime, prezime, status_korisnickog_racuna "
                        . " FROM korisnik JOIN status_korisnickog_racuna"
                        . " ON id_status_korisnickog_racuna = status_korisnickog_racuna_id_status_korisnickog_racuna";
                $rezultatPopisKorisnika = $konekcijaNaBazu->selectDB($sqlPopisKorisnika);
                while ($red = mysqli_fetch_array($rezultatPopisKorisnika)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $red["korisnickoime"]; ?>
                        </td>
                        <td>
                            <?php echo $red["email"]; ?>
                        </td>
                        <td>
                            <?php echo $red["ime"]; ?>
                        </td>
                        <td>
                            <?php echo $red["prezime"]; ?>
                        </td>
                        <td>
                            <?php echo $red["status_korisnickog_racuna"]; ?>
                        </td>
                        <td>
                            <a href="PregledKorisnika.php?action=zakljucaj&id=<?php echo $red["id_korisnik"]; ?>">Blokiraj</a>
                        </td>
                        <td>
                            <a href="PregledKorisnika.php?action=otkljucaj&id=<?php echo $red["id_korisnik"]; ?>">Otključaj</a>
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

    <script>
        $(document).ready(function () {
            UcitajPodatke();
            function UcitajPodatke(page) {
                $.ajax({
                    url: "Stranicenje.php",
                    method: "POST",
                    data: {page: page},
                    success: function (data) {
                        alert("Uspjesno dohvacnaje");
                        $('#PopisKorisnika').html(data);
                    }
                });
            }
        });
    </script>
</html>