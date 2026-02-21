<?php
    session_start();

    $host = 'db';
    $dbname = 'ChatRoom';
    $user = 'user';
    $dbpassword = 'user';
    $port = 3306;
    
    $connection = new mysqli($host, $user, $dbpassword, $dbname, $port);
    
    if ($connection->connect_error) {
        die("Errore di connessione: " . $connection->connect_error);
    }
    
    $username = htmlspecialcharts($_POST['username']);
    $password = htmlspecialcharts($_POST['password']);
    $conferma_password = htmlspecialcharts($_POST['confermapassword']);

    if ($password !== $conferma_password) {
        echo "Le password non corrispondono!";
        echo "<br><br>";
        echo "<a href='SignUp.html'>Torna alla Registrazione!</a>";
    }else{

        $stmt = $connection->prepare("SELECT * FROM utenti WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) 
        {
            echo "Utente già presente!";
            echo "<br><br>";
            echo "<a href='Login.html'>Torna al Login!</a>";
        }else{
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $connection->prepare("INSERT INTO utenti (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hash);
        
            if ($stmt->execute()) 
            {
                header("Location: Pannello.php");
            }else{
                echo "Registrazione non effettuata!";
            }
        }
    }

    $connection->close();
?>