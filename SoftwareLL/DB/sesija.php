<?php

class Sesija {

    const KORISNIK = "korisnik";
    const KOSARICA = "kosarica";
    const SESSION_NAME = "prijava_sesija";
    //prosirujemo sa tipom/ulogom, zelimo spremiti ulogu u sesiju
    const TIP = "tip";

    static function kreirajSesiju() {
        session_name(self::SESSION_NAME);

        if (session_id() == "") {
            session_start(); //Dovoljno je napraviti session start na pocetku svake stranice ako ne zelimo zvati funkciju svaki put
        }
    }

    static function kreirajKorisnika($korisnik, $tip) {
        self::kreirajSesiju();
        $_SESSION[self::KORISNIK] = $korisnik;
        //dodan argument i postavljanje tipa
        $_SESSION[self::TIP] = $tip;
    }

    static function kreirajKosaricu($kosarica) {
        self::kreirajSesiju();
        $_SESSION[self::KOSARICA] = $kosarica;
    }

    static function dajKorisnika() {
        self::kreirajSesiju();
        if (isset($_SESSION[self::KORISNIK])) {
            //array $korisnik sprema vrijednost 
            $korisnik = $_SESSION[self::KORISNIK];
            $korisnik[self::TIP] = $_SESSION[self::TIP];
        } else {
            return null;
        }
        return $korisnik;
    }

    static function dajKosaricu() {
        self::kreirajSesiju();
        if (isset($_SESSION[self::KOSARICA])) {
            $kosarica = $_SESSION[self::KOSARICA];
        } else {
            return null;
        }
        return $kosarica;
    }

    /**
     * Odjavljuje korisnika tj. briše sesiju
     */
    static function obrisiSesiju() {
        session_name(self::SESSION_NAME);

        if (session_id() != "") {
            session_unset();
            session_destroy();
        }
    }

}

?>


