<?php
include ("baza.class.php");
$konekcijaNaBazu = new Baza();
$konekcijaNaBazu->spojiDB();



if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $sqlZaboravljenaLozinka = "SELECT 1 FROM korisnik WHERE email = '$email'";
    $rezultatUpita = $konekcijaNaBazu->selectDB($sqlZaboravljenaLozinka);

    if (mysqli_num_rows($rezultatUpita) > 0) {
        $emailArray = $rezultatUpita->fetch_array();
        $randomLozinka = RandLozinka();
        PosaljiEmail($randomLozinka);
        $kriptiranaLozinka = sha1($randomLozinka);
        settype($randomLozinka, "string");
        $sqlPromjenaLozinke = "UPDATE korisnik SET lozinka = '$randomLozinka' WHERE email = '$email'"; 
        $sqlPromjenaKriptiraneLozinke = "UPDATE korisnik SET krptirana_lozinka = '$kriptiranaLozinka' WHERE email = '$email'";
        $konekcijaNaBazu->updateDB($sqlPromjenaLozinke);
        $konekcijaNaBazu->updateDB($sqlPromjenaKriptiraneLozinke);
        $konekcijaNaBazu->zatvoriDB();
    }
}

function RandLozinka($duljinaLozinke = 10) {
    $znakovi = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $brojZnakova = strlen($znakovi);
    $randomLozinka = '';
    for ($i = 0; $i < $duljinaLozinke; $i++) {
        $randomLozinka .= $znakovi[rand(0, $brojZnakova - 1)];
    }
    return $randomLozinka;
}

function PosaljiEmail($randomLozinka) {
    $email = $_POST["email"];
    $naslov = "Zaboravljena lozinka";
    $sadrzaj = "Nova lozinka: " . $randomLozinka;
    $zaglavljeEmaila = "From: josbijeli\r\n";
    if (mail($email, $naslov, $sadrzaj, $zaglavljeEmaila)) {
        echo 'Poslan Vam je novi paswword na email.';
    }
}
?>
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

    </header>
    <section>
        <h2>Prijava</h2>
        <form id="forma_zaboravljena_lozinka" name="forma_zaboravljena_lozinka" method="post"
              action = "zaboravljenaLozinka.php">
            <p>
                <label for="email">Email: </label>
                <input type ="text" id="email" name="email"><br>
                <input type ="submit" value="Pošalji" id = "submit" name = "submit">
            </p>
        </form>
    </section>
    <footer>

    </footer>
</html>