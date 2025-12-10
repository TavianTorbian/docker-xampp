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

    
    $query = "SELECT * FROM GiveMe WHERE username = '$username'";
    $result = $connection->query($query);

    if($result->num_rows == 0){
        $query = "INSERT INTO GiveMe(username, password) VALUES('$username','$password')";
        $result = $connection->query($query);
        echo "Registrazione effettuata! <br>";
    }
    else{
        echo "Registrazione non effettuata! <br>";
        echo "Utente già presente! <br>";
    }

    $connection->close();


?>