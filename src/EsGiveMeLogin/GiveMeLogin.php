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
    
    $username=$_POST['username'];
    $password=$_POST['password'];

    echo "Connessione al database riuscita con mysqli! <br>";
    $query = "SELECT * FROM GiveMe WHERE username = '$username' AND password = '$password'";

    $result = $connection->query($query);

    var_dump($result);

    if ($result-> num_rows > 0)
    {
      echo "Login Effettuato!";
    }
    else {
        echo "Login non riuscito!";
    }
    
    $connection->close();


?>