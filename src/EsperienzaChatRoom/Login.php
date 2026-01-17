<?php
    session_start();
    $host = 'db'; 
    $dbname = 'ChatRoom'; 
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
    
    $query = "INSERT INTO ChatRoom(username, password) VALUES('$username', '$password')";
    $result = $connection->query($query);

    if ($result-> num_rows > 0)
    {
      echo "Login Effettuato! <br>";
      $_SESSION['auth']=true;
      header('Location: Pannello.php');
    }
    
    $connection->close();
?>