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
    $nome_gioco=$_POST['nome_gioco'];
    $nome_elfo=$_POST['nome_elfo'];

    $query = "INSERT INTO Giocattoli(nome_elfo, nome_gioco) VALUES('$nome_elfo','$nome_gioco')";
    $result = $connection->query($query);

    if($connection->affected_rows > 0)
    {
        echo "Giocattolo inserito!";
    }
    else{
        echo "Errore di Inserimento!";
    }
}
