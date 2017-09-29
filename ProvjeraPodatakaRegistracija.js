function KreirajDogadaj() {
    var formular = document.getElementById("formaregistracija");
    formular.addEventListener("submit", function (event) {
        document.getElementById("greske").innerHTML = "";
        var uneseniSviElementi = ProvjeraUnosaSvihElemenata(formular);

        var lozinkeJednake = ProvjeraJednakostiLozinke(formular["password"].value, formular["password2"].value);
        if (lozinkeJednake === false) {
            event.preventDefault();
            document.getElementById("greske").innerHTML += "Lozinke nisu jednake" + '<br>';

        }
        var prvoVelikoSlovo = ProvjeraPrvogVelikogSlova(formular["ime"].value);
        if (prvoVelikoSlovo === false) {
            event.preventDefault();
            document.getElementById("greske").innerHTML += "Ime mora imati veliko slovo" + '<br>';

        }
        var prvoVelikoSlovo = ProvjeraPrvogVelikogSlova(formular["prezime"].value);
        if (prvoVelikoSlovo === false) {
            event.preventDefault();
            document.getElementById("greske").innerHTML += "Prezime mora imati veliko slovo" + '<br>';

        }

        var ispravanEmail = ProvjeriFormatEmaila(formular["email"].value);
        if (ispravanEmail === false) {
            event.preventDefault();
            document.getElementById("greske").innerHTML += "Email nije u dobrom formatu" + '<br>';

        }

        var korisnickoImeIspravno = ProvjeriKorisnickoIme(formular["korisnicko_ime"].value);
        if (korisnickoImeIspravno === false) {
            event.preventDefault();
            document.getElementById("greske").innerHTML += "Korisničko ime mora imati najmanje 5 znakova" + '<br>';

        }

        if (uneseniSviElementi === false) {
            event.preventDefault();
            document.getElementById("greske").innerHTML = "Nisu uneseni svi podaci" + '<br>';

        }
    });
}

function ProvjeraUnosaSvihElemenata(formular) {
    for (var i = 0; i < formular.length - 3; i++) {
        if (formular[i].value.length === 0) {
            return false;
        }
    }
    return true;
}

function ProvjeraJednakostiLozinke(lozinka, ponovljenaLozinka) {
    if (lozinka !== ponovljenaLozinka) {
        return false;
    }
    return true;
}

function ProvjeraPrvogVelikogSlova(unos) {
    var prvoVelikoSlovo = (unos.charAt(0)).toUpperCase();
    if (unos.charAt(0) !== prvoVelikoSlovo) {
        return false;
    }
    return true;
}

function ProvjeriFormatEmaila(email) {
    var re = /(^\w{2,}@(\w{2,}\.){1,2}\w{2,}$)/;
    var okDatum = re.test(email);
    if (okDatum === false) {
        return false;
    }
    return true;
}

function ProvjeriKorisnickoIme(korisnickoIme) {
    if (korisnickoIme.length < 5) {
        return false;
    }
    return true;
}