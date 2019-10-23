<?php
require '../DB/db.php';
require '../DB/sesija.php'; //ako trazis file za include ctrl+space i nadji si file (probaj to napraviti poslije require)

if (isset($_POST['prijavaReg'])) {
    // var_dump($_POST);
    // $greska ce bit varijabla za zapis svih greski koje je user mozda napravio
    $greska = "";
    foreach ($_POST as $key => $value) {
        //echo $key . " => " . $value . "<br>";
        if (empty($value)) { //tu ces ubacivati #, ?, ! provjeru, ako je nesto zapisi u $greska
            $greska .= $key . " nije unesen";
        }
    }
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
        echo "checkpoint 1";
        //var_dump($red = mysqli_fetch_array($rezultat));
        while ($red = mysqli_fetch_array($rezultat)) {
            echo "checkpoint 2";
            if ($red) {
                echo "checkpoint 3";
                $autenticiran = true;
                $tip = $red['id_korisnik'];
            }

            if ($autenticiran) {
                echo "checkpoint 4";
                echo 'Uspjesna prijava!';
                Sesija::kreirajKorisnika($korime, $tip);
                //Da li je korisnik kreiran u sesiji, preglednik -> Inspect -> Applications -> Cookies
                //Brisanje sesija ista putanja Clear All
            } else {
                echo 'Neuspjesna prijava!';
            }
            echo "checkpoint 5";
            //var_dump($red);
            var_dump($red['id_korisnik']);
            //$red = lista
            //id_korisnik stupac u bazi
        }
        echo "checkpoint 6";
        $veza->zatvoriDB();
    }
}
?>

<!DOCTYPE html>

<html lang="hr">
    <head>
        <title>Prijava</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="naslov" content="Prijava">
        <meta name="autor" content="Ivan Slavko Matić">
        <meta name="kljucneRijeci" 
              content="korisničko ime, lozinka, 
              zapamti me">

        <link href="../css/imatic.css" 
              rel="stylesheet" type="text/css">
        <link href="./css/imatic_480.css"
              rel="stylesheet" type="text/css">
        <link href="./css/imatic_320.css"
              rel="stylesheet" type="text/css">
        <link href="./css/imatic_720.css"
              rel="stylesheet" type="text/css">
        <link href="./css/imatic_1024.css"
              rel="stylesheet" type="text/css">
        <script type="text/javascript" src="../javascript/imatic.js">
        </script>
    </head>
    <body onload="kreirajDogadaje();">
        <header>
            <h1 id="pocetak">Prijava</h1>
        </header>
        <br>
        <nav>
            <ul class="navigacija">
                <li><a href="-../index.html">Početna stranica</a></li>
                <li><a href="../ostalo/multimedija.html">Multimedija</a></li>  
                <li><a href="../ostalo/popis.html">Popis</a></li>     
                <li><a href="registracija.html">Registracija</a></li>                
                <li><a href="obrazac.html">Obrazac</a></li>                
            </ul>
            <hr style="margin-left: 4%;">
        </nav>
        <form novalidate id="prijava" method="post" name="prijava" action="">
            <table>
                <tr>
                    <td><label for="korisnickoIme">Korisničko ime: </label></td>
                    <td><input type="text" id="korimePrijava" name="korimePrijava" 
                               size="15" maxlength="20" placeholder="Korisničko ime" 
                               autofocus="autofocus" required="required"><br></td>
                </tr>
                <tr>
                    <td><label for="lozinkaPrijava">Lozinka: </label></td>
                    <td><input type="password" id="lozinkaPrijava" name="lozinkaPrijava" 
                               size="15" maxlength="15" placeholder="Lozinka" 
                               required="required"><br></td>
                </tr>
                <tr>
                    <td>Upamti korisničko ime: </td>
                    <td><input type="checkbox" name="zapamtiMe" 
                               value="1"> <br></td>
                </tr>
                <tr>
                    <td><input type="reset" value=" Reset "></td>
                    <td><input name="prijavaReg"type="submit" value=" Prijavi me "></td>
                </tr>
            </table>
        </form>
        <footer>
            <p><strong>Ime i prezime: </strong>Ivan Slavko Matić</p>
            <p><strong>Datum posljednje izmjene: </strong>Ožujak, 2019. </p>
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
