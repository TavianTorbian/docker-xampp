<?php
session_start();

if (isset($_SESSION['email'])) {

    $host = 'db'; 
    $dbname = 'Drive'; 
    $user = 'user';
    $password = 'user';
    $port = 3306;

    $connection = new mysqli($host, $user, $password, $dbname, $port);

    if ($connection->connect_error) {
        die("Errore di connessione: " . $connection->connect_error);
    }

    if(isset($_FILES['file'])){
        $path = $_FILES['file']['tmp_name'];
        if(file_exists($path)){
            $content = file_get_contents($_FILES['file']['tmp_name']);
        }else{
            echo "<p style='color:red'>File non trovato!</p>";
        }
    }
}else{
    header("Location: Login.php");
}
?>
