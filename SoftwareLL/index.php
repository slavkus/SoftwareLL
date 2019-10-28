<!DOCTYPE html>

<?php
require 'DB/db.php';
require 'DB/session.php';
/*
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
*/
 
?>


<html>
    <head>
        <title>SoftwareLL</title>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">

        <meta name="title" content="SoftwareLL">
        <meta name="author" content="Ivan Slavko Matić">
        <meta name="keywords" 
              content="license, price, 
              company">

        <link href="css/main.css" 
              rel="stylesheet" type="text/css">

        <script type="text/javascript" src="javascript/main_jscript.js">
        </script>

    </head>
    <body>
        <header style="font-weight:bold">
            <h1 id="headerID">SoftwareLL</h1>
        </header>
        <nav>
            <ul>
                <li style="background-color: #007AA4;"><a href="ostalo/multimedija.html">Home</a></li>
                <li><a href="ostalo/multimedija.html">Gallery</a></li>
                <li><a href="ostalo/popis.html">Tables</a></li>   
                <li><a href="navigacijski.html">Documentation</a></li> 
                <li style="cursor: pointer" onclick="document.getElementById('modalLoginButton').style.display = 'block'" style="width:auto;"><a>Log in</a></li> 
                <li><a href="obrasci/registracija.html">Registration</a></li> 
            </ul>
            <hr>
        </nav>

        <!-- Login form -->

        <!-- The Modal -->
        <div id="modalLoginButton" class="modal">
            <!-- Modal Content -->
            <form class="modal-content animate" novalidate method="post" name="login" action="">

                <div class="container">
                    <label for="usernameLogin" style="color: whitesmoke;"><b>Username</b></label>
                    <input type="text" placeholder="Username" name="usernameLogin" required>

                    <label for="passwordLogin" style="color: whitesmoke;"><b>Password</b></label>
                    <input type="password" placeholder="Password" name="passwordLogin" required>
                    <br>
                    <label style="color: whitesmoke"><input type="checkbox" checked="checked" name="rememberMeCheckbox"> Remember me</label>
                    <br><br>
                    <input name="loginBtn" type="submit" value="Log in" class="inputLoginButton">&nbsp
                    <button type="button" onclick="document.getElementById('modalLoginButton').style.display = 'none'" class="cancelBtn">Cancel</button>

                </div>
            </form>
        </div>

        <footer class="footer">
            <p><strong>Name & Surname: </strong>Ivan Slavko Matić</p>
            <p><strong>Last updated: </strong>Listopad, 2019. </p>
            <address><strong>Email: </strong><a href="mailto:bluebloodslaiver1@gmail.com">bluebloodslaiver1@gmail.com</a></address>
            <figure id="footer">
                <a href="http://validator.w3.org/#validate_by_uri+with_options">
                    <img src="multimedia/HTML5.png" 
                         alt="HTML5 validator" width="50" height="50"></a>
                <a href="http://jigsaw.w3.org/css-validator/">
                    <img src="multimedia/CSS3.png" 
                         alt="CSS validator" width="50" height="50"></a>
            </figure>
        </footer>
    </body>
</html>