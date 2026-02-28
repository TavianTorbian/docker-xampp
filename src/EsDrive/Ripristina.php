<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header("Location: Login.html");
    }

    $host = 'db';
    $dbname = 'Drive';
    $user = 'user';
    $dbpassword = 'user';
    $port = 3306;

    $connection = new mysqli($host, $user, $dbpassword, $dbname, $port);

    if ($connection->connect_error) {
        die("Errore di connessione: " . $connection->connect_error);
    }

    $idUtente = $_SESSION['id'];

    if (!isset($_POST['id'])) {
        header("Location: Cestino.php?msg=error");
    }

    $idDocumento = intval($_POST['id']);

    $stmt = $connection->prepare("UPDATE documenti SET cestinato = 0 WHERE id = ? AND id_utente = ?");
    $stmt->bind_param("ii", $idDocumento, $idUtente);
    $stmt->execute();

    header("Location: Cestino.php?msg=restored");
?>
