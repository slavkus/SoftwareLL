<!DOCTYPE html>

<?php
require 'DB/db.php';
require 'DB/sesija.php';

if (isset($_POST['prijavaBtn'])) {
    // var_dump($_POST);
    // $greska ce bit varijabla za zapis svih greski koje je user mozda napravio
    $greska = "";
    foreach ($_POST as $key => $value) {
        //echo $key . " => " . $value . "<br>";
        if (empty($value)) { //tu ces ubacivati #, ?, ! provjeru, ako je nesto zapisi u $greska
            $greska .= $key . " nije unesen";
        }
    }
    var_dump($greska);
    if (empty($greska)) {
        echo 'Povezivanje na bazu!';

        $mail_to = "imatic@foi.hr";
        $mail_from = "From: WebDiP_2018@foi.hr";
        $mail_subject = "G6";
        $mail_body = "Slanje maila primjer.";

        mail($mail_to, $mail_subject, $mail_body, $mail_from);

        $veza = new Baza();
        $veza->spojiDB();

        //Prijava
        $korime = $_POST['korimePrijava'];
        $lozinka = $_POST['lozinkaPrijava'];
        $upit = "SELECT * FROM korisnik WHERE "
                . "korisnicko_ime='{$korime}' " //Tu ce se ispisati podaci koji se unose u obrazac
                . "AND lozinka='{$lozinka}'";
        $rezultat = $veza->selectDB($upit);

        //AUTENTIKACIJA KORISNIKA
        //If tip korisnika not admin ili moderator nema access tome i tome
        //else fetch, znaci if bi trebao biti nad while-om di on fetcha tip korisnika
        $autenticiran = false;
        while ($red = mysqli_fetch_array($rezultat)) {
            if ($red) {
                $autenticiran = true;
                $tip = $red['id_korisnik'];
            }

            if ($autenticiran) {
                echo 'Uspjesna prijava!';
                Sesija::kreirajKorisnika($korime, $tip);
                
                $ispis = Sesija::dajKorisnika();
                echo $ispis;
                //var_dump($red['korisnicko_ime']);
                //Da li je korisnik kreiran u sesiji, preglednik -> Inspect -> Applications -> Cookies
                //Brisanje sesija ista putanja Clear All
            } else {
                echo 'Neuspjesna prijava!';
            }
            //var_dump($red);
            //$red = lista
            //id_korisnik stupac u bazi
        }

        $veza->zatvoriDB();
    }
}
?>

<html>
    <head>
        <title>O autoru</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="naslov" content="Softverske licence">
        <meta name="autor" content="Ivan Slavko Matić">
        <meta name="kljucneRijeci" 
              content="volvo, alfa romeo, 
              predstavi se">

        <link href="css/imatic.css" 
              rel="stylesheet" type="text/css">
        <link href="css/imatic_screen_adjust.css" 
              rel="stylesheet" type="text/css">

        <script type="text/javascript" src="javascript/imatic.js">
        </script>

    </head>
    <body>
        <header style="font-weight:bold; margin-left: 15%;">
            <h1 id="pocetak">O autoru</h1>
        </header>
        <br>
        <nav>
            <ul id="urediNavigaciju">
                <li><a href="naslovna.php">Naslovna</a></li>
                <li style="background-color: #007AA4;"><a href="o_autoru.php">O autoru</a></li>
                <li><a href="dokumentacija.php">Dokumentacija</a></li> 
                <li style="cursor: pointer" onclick="document.getElementById('prijavaBtn').style.display = 'block'" style="width:auto;"><a>Prijava</a></li>
                <li><a href="obrasci/registracija.php">Registracija</a></li> 
            </ul>
        </nav>

        <!-- Prijava forma -->

        <!-- The Modal -->
        <div id="prijavaBtn" class="modal">
            <!-- Modal Content -->
            <form class="modal-content animate" novalidate method="post" name="prijava" action="">

                <div class="container">
                    <label for="korimePrijava" style="color: black;"><b>Korisničko ime</b></label>
                    <input type="text" placeholder="Korisničko ime" name="korimePrijava" required>

                    <label for="lozinkaPrijava" style="color: black;"><b>Lozinka</b></label>
                    <input type="password" placeholder="Lozinka" name="lozinkaPrijava" required>
                    <br>
                    <label style="color: black"><input type="checkbox" checked="checked" name="zapamtimeCheckbox"> Zapamti me</label>
                    <br><br>
                    <input name="prijavaBtn" type="submit" value="Prijava" class="inputPrijavaButton">&nbsp
                    <button type="button" onclick="document.getElementById('prijavaBtn').style.display = 'none'" class="cancelbtn">Odustani</button>

                </div>

            </form>
        </div>
        <table id="autorTablica">
            <col width="15%">
            <col width="45%">
            <tr>
                <td>
                    <figure>
                        <img src="multimedija/profilna.jpg" alt="Profilna slika" width="200" height="200">
                        <figcaption>
                            Profilna slika
                        </figcaption>
                    </figure> 
                </td>
                <td><h2 style="margin-left: 20px;">O autoru:</h2>
                    <p style="text-align: justify; margin-left: 20px; margin-top: 10px;">
                        Programirao sam u C++ i C#, te u zadnje vrijeme sam radio u Javi, 
                        Xml-u i Oracle okruženju. Iz WebDiP-a bih htio dobiti temeljno znanje iz 
                        PHP-a, što više naučiti iz Javascripta i napraviti projekt na koji ću se 
                        referencirati šta god radio ubuduće.
                    </p></td>
            </tr>
            <tr>
                <td style="text-align: right">
                    Osnovne informacije: 
                </td>
            </tr>
            <tr>
                <td style="text-align: right">Ime i prezime: </td>
                <td>Ivan Slavko Matić</td>
            </tr>
            <tr>
                <td style="text-align: right">Email: </td>
                <td>imatic@foi.hr</td>
            </tr>
            <tr>
                <td style="text-align: right">Matični broj: </td>
                <td>44007/15-R </td>
            </tr>
        </table>
        <br><br><br><br><br><br><br><br><br><br>
        <footer class="footer">
            <p><strong>Ime i prezime: </strong>Ivan Slavko Matić</p>
            <p><strong>Datum posljednje izmjene: </strong>Lipanj, 2019. </p>
            <address><strong>Email: </strong><a href="mailto:imatic@foi.hr">imatic@foi.hr</a></address>
            <figure id="footer">
                <a href="http://validator.w3.org/#validate_by_uri+with_options">
                    <img src="multimedija/HTML5.png" 
                         alt="HTML5 validator" width="50" height="50"></a>
                <a href="http://jigsaw.w3.org/css-validator/">
                    <img src="multimedija/CSS3.png" 
                         alt="CSS validator" width="50" height="50"></a>
            </figure>
        </footer>
    </body>
</html>
