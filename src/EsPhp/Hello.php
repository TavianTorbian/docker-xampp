<?php

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
    
    echo "Connessione al database riuscita con mysqli! <br>";

    $Nome = "mario.rossi";
    $password = "$2b$10$5cM8wE1tQ4rS7nL9oF2pG6bV3dH8xT0aK4mP2rN7gL6cQ3sJ1uZw";

    $query = "SELECT * FROM Utenti WHERE username = '$Nome' AND password = '$password'";

    echo $query;
    echo "<br>";

    $result = $connection->query($query);

    var_dump($result);
    
    $connection->close();
?>
