<?php
session_start(); 

$host = 'db';
$dbname = 'Drive';
$user = 'user';
$dbpassword = 'user';
$port = 3306;

$connection = new mysqli($host, $user, $dbpassword, $dbname, $port);

if ($connection->connect_error) 
{
    die("Errore di connessione: " . $connection->connect_error);
}

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $connection->prepare("SELECT * FROM utenti WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) 
    {
        $row = $result->fetch_assoc();
        $hashSalvato = $row['password'];

        if (password_verify($password, $hashSalvato)) {
            session_regenerate_id(true);
            $_SESSION['email'] = $email;
            header("Location: Dashboard.php");
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