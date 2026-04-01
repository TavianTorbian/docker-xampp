<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: Login.html");

}else{    

    $host = 'db';
    $dbname = 'Drive';
    $user = 'user';
    $dbpassword = 'user';
    $port = 3306;

    $connection = new mysqli($host, $user, $dbpassword, $dbname, $port);

    if ($connection->connect_error) {
        die("Errore di connessione: " . $connection->connect_error);
    }

    $idUtente = $_SESSION['id'];
}
?>