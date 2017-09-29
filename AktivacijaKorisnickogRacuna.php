<?php
include("baza.class.php");
$konekcija = new Baza();
$konekcija->spojiDB();
$trenutnoVrijeme = new DateTime();
$trenutnoVrijeme->modify('-1 day');
if (!empty($_GET["id"])) {
    $id = $_GET["id"] + 0;
    $sqlDatumRegistracije = "SELECT datum_registracije FROM korisnik WHERE id_korisnik = '$id'";
    $rezultatDatumRegistracije = $konekcija->selectDB($sqlDatumRegistracije);
    $rezultatDatumRegistracijeArray = $rezultatDatumRegistracije->fetch_array();
    $datumRegistracije = $rezultatDatumRegistracijeArray["datum_registracije"];
    if ($trenutnoVrijeme > $datumRegistracije) {
        $sqlOdgovorAktivacija = "UPDATE korisnik set status_korisnickog_racuna_id_status_korisnickog_racuna = 1 WHERE id_korisnik='" . $id . "'";
        $result = $konekcija->updateDB($sqlOdgovorAktivacija);
        if (!empty($result)) {
            $message = "Account je aktiviran.";
            $sqlProvjeraIzvrseneAkcije = "SELECT 1 FROM napravio_akciju WHERE akcija_id = 1 AND korisnik_id = '$id'";
            $rezultatProvjera = $konekcija->selectDB($sqlProvjeraIzvrseneAkcije);
            $vraceno = mysqli_num_rows($rezultatProvjera);
            if ($vraceno == 0) {
                $sqlAkcija = "INSERT INTO napravio_akciju VALUES(1, '$id'))";
                $rezultatAkcije = $konekcija->updateDB($sqlAkcija);
            }
        } else {
            $message = "Problem kod aktivacije.";
        }
    }
    else{
        $napomena .= "Isteklo vrijeme!";
    }
}
?>
<html>
    <head>
        <title>Aktivacija</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Registracija"/>
        <meta name="kljucne_rijeci" content="Projekt, Aktivacij"/>
        <meta name="datum_izrade" content="26.05.2017."/>
        <meta name="autor" content="Josip Bijelić"/>
        <link href="https://fonts.googleapis.com/css?family=EB+Garamond|Signika" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="DizajnRegistracija.css" />
    </head>
    <body>
<?php if (isset($message)) { ?>
            <div class="message"><?php echo $message; ?></div>
        <?php } ?>
    </body></html>
