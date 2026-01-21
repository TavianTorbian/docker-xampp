<?php
    session_start();

    $host = 'db';
    $dbname = 'ChatRoom';
    $user = 'user';
    $dbpassword = 'user';
    $port = 3306;

    $connection = new mysqli($host, $user, $dbpassword, $dbname, $port);

    if ($connection->connect_error) 
    {
        die("Errore di connessione: " . $connection->connect_error);
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $connection->prepare("SELECT * FROM utenti WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) 
    {
        $row = $result->fetch_assoc();
        $hashSalvato = $row['password'];

        if (password_verify($password, $hashSalvato)) {
            session_regenerate_id(true);
            $_SESSION['username'] = $username;
            header("Location: Pannello.html");
        } else {
            echo "Password errata!";
        }
    } 
    else 
    {
        echo "Utente non trovato!";
    }
    $connection->close();

?>
