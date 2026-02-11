<?php
    session_start();

    $host = 'db';
    $dbname = 'Drive';
    $user = 'user';
    $dbpassword = 'user';
    $port = 3306;

    $connection = new mysqli($host, $user, $dbpassword, $dbname, $port);

    if ($connection->connect_error) {
        die("Errore di connessione: " . $connection->connect_error);
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    $conferma_password = $_POST['confermapassword'];

    if ($password !== $conferma_password) {
        echo "<p style='color:orange'>Le password non corrispondono!</p>";
        echo "<br><br>";
        echo "<a href='SignUp.html'>Torna alla Registrazione!</a>";
    }else{

        $stmt = $connection->prepare("SELECT * FROM utenti WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) 
        {
            echo "<p style='color:orange'>Utente già presente!</p>";
            echo "<br><br>";
            echo "<a href='Login.html'>Torna al Login!</a>";
        }else{
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $connection->prepare("INSERT INTO utenti (email, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $email, $hash);
    
            if ($stmt->execute()) 
            {
                header("Location: Dashboard.php");
            }else{
                echo "<p style='color:red'>Registrazione non effettuata!</p>";
            }
        }
    }

    $connection->close();
?>