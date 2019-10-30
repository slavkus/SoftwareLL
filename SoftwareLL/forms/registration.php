<?php

require '../DB/db.php';
require '../DB/session.php';

//Registracija
/*
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
 */
?>