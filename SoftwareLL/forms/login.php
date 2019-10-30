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