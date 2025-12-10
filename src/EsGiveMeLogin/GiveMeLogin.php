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
    
    $username=htmlspecialchars($_POST['username']);
    $password=htmlspecialchars($_POST['password']);

    echo "Connessione al database riuscita con mysqli! <br>";
    $stmt = $connection->prepare("SELECT * FROM GiveMe WHERE username = ? AND password = ?");

    $stmt->bind_param("ss", $username, $password);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result-> num_rows > 0)
    {
      echo "Login Effettuato!";
      if($username=='Thomas' && $password=='tavianipezzoschifo')
      {
        $query = "SELECT * FROM GiveMe";
        $result = $connection->query($query);

      }
    }
    else {
        echo "Login non riuscito!";
    }
    
    $connection->close();
?>