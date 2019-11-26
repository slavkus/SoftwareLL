<?php

class Session {

    const USER = "user";
    const SHOPPINGCART = "cart";
    const SESSION_NAME = "login_session";
    //prosirujemo sa tipom/ulogom, zelimo spremiti ulogu u sesiju
    const TYPE = "type";

    static function createSession() {
        session_name(self::SESSION_NAME);

        if (session_id() == "") {
            session_start(); //Dovoljno je napraviti session start na pocetku svake stranice ako ne zelimo zvati funkciju svaki put
        }
    }

    static function createUser($user, $type) {
        self::createSession();
        $_SESSION[self::USER] = $user;
        //dodan argument i postavljanje tipa
        $_SESSION[self::TYPE] = $type;
    }

    static function createShoppingCart($cart) {
        self::createSession();
        $_SESSION[self::SHOPPINGCART] = $cart;
    }

    static function getUser() {
        self::createSession();
        if (isset($_SESSION[self::USER])) {
            //array $user sprema vrijednost 
            $user = $_SESSION[self::USER];
            $user[self::TYPE] = $_SESSION[self::TYPE];
        } else {
            return null;
        }
        return $user;
    }

    static function getShoppingCart() {
        self::createSession();
        if (isset($_SESSION[self::SHOPPINGCART])) {
            $cart = $_SESSION[self::SHOPPINGCART];
        } else {
            return null;
        }
        return $cart;
    }
    
    /*
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


