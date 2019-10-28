<?php

class DB {

    const server = "http://softwarell.epizy.com";
    const user = "epiz_24665850"; //korisnik i baza su isti
    const password = "BtQY7SN5QQsi-7/";
    const db = "epiz_24665850_SoftwareLLDB";

    private $connection = null;
    private $error = '';

    function connectDB() {
        $this->connection = new mysqli(self::server, self::user, self::password, self::db);
        if ($this->connection->connect_errno) {
            echo "Connecting unsuccessful: " . $this->connection->connect_errno . ", " .
            $this->connection->connect_error;
            $this->error = $this->connection->connect_error;
        }
        $this->connection->set_charset("utf8");
        if ($this->connection->connect_errno) {
            echo "Unsuccessful character setting: " . $this->connection->connect_errno . ", " .
            $this->connection->connect_error;
            $this->error = $this->connection->connect_error;
        }
        return $this->connection;
    }

    function closeDB() {
        $this->connection->close();
    }

    function selectDB($query) {
        $result = $this->connection->query($query);
        if ($this->connection->connect_errno) {
            echo "Query error: {$query} - " . $this->connection->connect_errno . ", " .
            $this->connection->connect_error;
            $this->error = $this->connection->connect_error;
        }
        if (!$result) {
            $result = null;
        }
        return $result;
    }

    function updateDB($query, $script = '') {
        $result = $this->connection->query($query);
        if ($this->connection->connect_errno) {
            echo "Query error: {$query} - " . $this->connection->connect_errno . ", " .
            $this->connection->connect_error;
            $this->error = $this->connection->connect_error;
        } else {
            if ($script != '') {
                header("Location: $script");
            }
        }

        return $result;
    }
    
    function errorDB() {
        if ($this->error != '') {
            return true;
        } else {
            return false;
        }
    }
    
}

?>