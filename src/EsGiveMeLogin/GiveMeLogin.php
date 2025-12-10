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
    
    $username=htmlspecialcharts($_POST['username']);
    $password=htmlspecialcharts($_POST['password']);

    echo "Connessione al database riuscita con mysqli! <br>";
    $stmt = $connection->prepare("SELECT * FROM GiveMe WHERE username = ? AND password = ?")

    $stmt->bind_param("s", $username);
    $stmt->bind_param("s", $password);

    $connection->execute();

    $result = $connection->get_result();

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