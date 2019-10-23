<!DOCTYPE html>


<?php
require '../DB/db.php';
require '../DB/sesija.php';

//Prijava

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
        echo 'Povezivanje na bazu! --> Prijava';

        /*
          $mail_to = "imatic@foi.hr";
          $mail_from = "From: WebDiP_2018@foi.hr";
          $mail_subject = "G6";
          $mail_body = "Slanje maila primjer.";

          mail($mail_to, $mail_subject, $mail_body, $mail_from);
         */

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

//Registracija

if (isset($_POST['registrirajBtn'])) {
    $greska = "";
    foreach ($_POST as $key => $value) {
        //echo $key . " => " . $value . "<br>";
        if (empty($value)) { //tu ces ubacivati #, ?, ! provjeru, ako je nesto zapisi u $greska
            $greska .= $key . " nije unesen";
        }
    }
    if (isset($_POST['ime']) 
            && isset($_POST['prezime']) 
            && isset($_POST['korisnickoImeReg']) 
            && isset($_POST['lozinkaReg']) 
            && isset($_POST['emailAdresa'])) {
        if (empty($greska)) {
            echo 'Povezivanje na bazu! --> Registracija';
            
            $veza = new Baza();
            $veza->spojiDB();

            $ime = $_POST['ime'];
            $prezime = $_POST['prezime'];
            $korime = $_POST['korisnickoImeReg'];
            $lozinka = $_POST['lozinkaReg'];
            $email = $_POST['emailAdresa'];
            $upit = "INSERT INTO korisnik (uloga_korisnika_id_uloga, ime, prezime, korisnicko_ime, lozinka, email) VALUES ('{3}','{$ime}','{$prezime}','{$korime}','{$lozinka}','{$email}')";
            $rezultat = $veza->selectDB($upit);

            $veza->zatvoriDB();
        }
    }
}
?>

<html lang="hr">
    <head>
        <title>Registracija</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="naslov" content="Registracija">
        <meta name="autor" content="Ivan Slavko Matić">
        <meta name="kljucneRijeci" 
              content="Ime i prezime, Datum posljednje izmjene, 
              Email">

        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">        
        <link href="../css/imatic.css" 
              rel="stylesheet" type="text/css">
        <link href="../css/imatic_screen_adjust.css" 
              rel="stylesheet" type="text/css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>      
        <script type="text/javascript" src="../javascript/imatic_jquery.js">
        </script>

    </head>
    <body>
        <header>
            <h1 id="pocetak">Registracija</h1>
        </header>
        <br>
        <nav>
            <ul id="urediNavigaciju">
                <li><a href="../naslovna.php">Naslovna</a></li>
                <li><a href="../o_autoru.php">O autoru</a></li>
                <li><a href="../dokumentacija.php">Dokumentacija</a></li> 
                <li style="cursor: pointer" onclick="document.getElementById('prijavaBtn').style.display = 'block'" style="width:auto;"><a>Prijava</a></li>
                <li style="background-color: #007AA4;"><a href="registracija.php">Registracija</a></li> 

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

        <form novalidate id="registracijaForm" method="post" name="registracijaForm" action="">
            <table id="registracijaFormTable">
                <tr>
                    <td><label for="ime">Ime: </label></td>
                    <td><input type="text" name="ime" size="40" maxlength="20" placeholder="Ime" 
                               required="required"></input><br></td>
                </tr>
                <tr>
                    <td><label for="prezime">Prezime: </label></td>
                    <td><input type="text" name="prezime" size="40" maxlength="20" placeholder="Prezime" 
                               required="required"></input><br></td>
                </tr>

                <tr>
                    <td><label for="korisnickoImeReg">Korisničko ime: </label></td>
                    <td><input type="text" id="korisnickoIme" name="korisnickoImeReg" 
                               size="15" maxlength="20" placeholder="Korisničko ime" 
                               required="required"><br></td>
                </tr>
                <tr>
                    <td><label for="emailAdresa">Email adresa: </label></td>
                    <td><input type="email" id="emailAdresa" name="emailAdresa" 
                               size="25" maxlength="20" placeholder="someEmail@yahoo.com">
                        <br></td>
                </tr>
                <tr>
                    <td><label for="lozinka">Lozinka: </label></td>
                    <td><input type="password" id="lozinka" name="lozinka" size="15" 
                               maxlength="15" placeholder="Lozinka" required="required">
                        <br></td>
                </tr>
                <tr>
                    <td><label for="lozinkaReg">Potvrdite lozinku: </label></td>
                    <td><input type="password" id="lozinkaPotvrdi" name="lozinkaReg" size="15" 
                               maxlength="15" placeholder="Potvrdite lozinku" required="required">
                        <br></td>
                </tr>
                <tr>
                    <td><input class="inputPrijavaButton" type="reset" value="Reset"><br></td>
                    <td><input name="registrirajBtn" class="inputPrijavaButton" type="submit" value="Registriraj"></td>
                </tr>
            </table>
        </form> 
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <footer class="footer">
            <p><strong>Ime i prezime: </strong>Ivan Slavko Matić</p>
            <p><strong>Datum posljednje izmjene: </strong>Lipanj, 2019. </p>
            <address><strong>Email: </strong><a href="mailto:imatic@foi.hr">imatic@foi.hr</a></address>
            <figure id="footer">
                <a href="http://validator.w3.org/#validate_by_uri+with_options">
                    <img src="../multimedija/HTML5.png" 
                         alt="HTML5 validator" width="50" height="50"></a>
                <a href="http://jigsaw.w3.org/css-validator/">
                    <img src="../multimedija/CSS3.png" 
                         alt="CSS validator" width="50" height="50"></a>
            </figure>
        </footer>
    </body>
</html>