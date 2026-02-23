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

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $email = $_POST['email'];
        $password = $_POST['password'];
        $conferma_password = $_POST['confermapassword'];

        if ($password !== $conferma_password) {
            echo "<p style='color:orange'>Le password non corrispondono!</p>";
        }

        $stmt = $connection->prepare("SELECT id FROM utenti WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<p style='color:orange'>Utente già registrato!</p>";
            echo "<a href='Login.html'>Vai al Login!</a>";
        }else{ 
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $connection->prepare("INSERT INTO utenti (email, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $email, $hash);

            if ($stmt->execute()) {
                header("Location: Dashboard.php");
            } else {
                echo "<p style='color:red'>Errore durante la registrazione!</p>";
            }
        }
    }

$connection->close();
?>
