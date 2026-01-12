<?php
session_start();
if(isset($_SESSION['auth']))
{
    $host = 'db'; 
    $dbname = 'root_db'; 
    $user = 'user';
    $password = 'user';
    $port = 3306;

    $connection = new mysqli($host, $user, $password, $dbname, $port);

    if ($connection->connect_error) 
    {
        die("Errore di connessione: " . $connection->connect_error);
    }

    $query = "SELECT * FROM Giocattoli";
    $result = $connection->query($query);

    if($connection->affected_rows > 0)
    {
        echo "";
    }
    else{
        echo "Errore di Visualizzazione!";
    }

    
}