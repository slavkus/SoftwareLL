<?php

class Session {

    const USER = "korisnik";
    const SHOPPINGCART = "kosarica";
    const SESSION_NAME = "prijava_sesija";
    //prosirujemo sa tipom/ulogom, zelimo spremiti ulogu u sesiju
    const TYPE = "tip";

    static function createSession() {
        session_name(self::SESSION_NAME);

        if (session_id() == "") {
            session_start(); //Dovoljno je napraviti session start na pocetku svake stranice ako ne zelimo zvati funkciju svaki put
        }
    }

    static function createUser($korisnik, $tip) {
        self::kreirajSesiju();
        $_SESSION[self::KORISNIK] = $korisnik;
        //dodan argument i postavljanje tipa
        $_SESSION[self::TIP] = $tip;
    }

    static function createShoppingCart($kosarica) {
        self::kreirajSesiju();
        $_SESSION[self::KOSARICA] = $kosarica;
    }

    static function getUser() {
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

    static function getShoppingCart() {
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
    static function deleteSession() {
        session_name(self::SESSION_NAME);

        if (session_id() != "") {
            session_unset();
            session_destroy();
        }
    }

}

?>


