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
    
    $query = "SELECT * FROM utenti WHERE username = '$username'";
    $result = $connection->query($query);

    if($result->num_rows == 0)
    {
        $query = "INSERT INTO utenti(username, password) VALUES('$username','$password')";
        $result = $connection->query($query);
        $_SESSION['username']=true;
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