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
    
    $stmt = $connection->prepare("SELECT * FROM utenti WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result-> num_rows > 0)
    {
      $_SESSION['username']=true;
      header('Location: Pannello.php');
    }else {
      echo "Login non riuscito! <br>";
    }
    
    $connection->close();
?>