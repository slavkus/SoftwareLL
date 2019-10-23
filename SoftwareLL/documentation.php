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
                //var_dump($red['korisnicko_ime']);
                $ispis = Sesija::dajKorisnika();
                echo $ispis;
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

<html lang="hr">
    <head>
        <title>Dokumentacija</title>
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
        <header style="font-weight:bold">
            <h1 id="pocetak">Dokumentacija</h1>

        </header>
        <br>
        <nav>
            <ul id="urediNavigaciju">
                <li><a href="naslovna.php">Naslovna</a></li>
                <li><a href="o_autoru.php">O autoru</a></li>
                <li style="background-color: #007AA4;"><a href="dokumentacija.php">Dokumentacija</a></li> 
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

        <div class="indexClanci" style="margin-top: 60px">
            <div class="indexClanakStupac">
                <table>
                    <tr>
                        <th>VOLVO S80<td>
                    </tr>
                    <tr> 
                        <td>

                        </td>
                    </tr>
                </table>
            </div>
            <hr>
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