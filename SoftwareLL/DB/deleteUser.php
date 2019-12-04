<?php

session_start();

require '../DB/db.php';

$connection = new DB();
$connection->connectDB();

$userID = $_POST['id'];

$query = "DELETE FROM korisnik WHERE "
        . "id_korisnik='{$userID}' ";
$connection->selectDB($query);

?>

