<?php
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
    
    $stmt = $connection->prepare("SELECT * FROM Utenti WHERE username = '$username'");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 0)
    {
        $stmt = $connection->prepare("INSERT INTO ChatRoom(username, password) VALUES(?, ?)");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $_SESSION['auth']=true;
        header('Location: Pannello.php');
        if ($result-> num_rows > 0)
        {
            echo "Registrazione Effettuata! <br>";
        }else{
            echo "Registrazione non effettuata! <br>";
            echo "Utente già presente! <br>";
        }
    }

    $connection->close();
?>