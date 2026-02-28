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

    if (isset($_POST['delete_id']) && !isset($_POST['definitivo'])) {

        $idDocumento = intval($_POST['delete_id']);
        $stmt = $connection->prepare("UPDATE documenti SET cestinato = 1 WHERE id = ? AND id_utente = ?");
        $stmt->bind_param("ii", $idDocumento, $idUtente);
        $stmt->execute();

        header("Location: Dashboard.php?msg=trashed");
        exit;
    }

    if (isset($_POST['delete_id']) && isset($_POST['definitivo'])) {

        $idDocumento = intval($_POST['delete_id']);
        $stmt = $connection->prepare("SELECT percorso FROM documenti WHERE id = ? AND id_utente = ?");
        $stmt->bind_param("ii", $idDocumento, $idUtente);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            header("Location: Cestino.php?msg=error");
        }

        $row = $result->fetch_assoc();
        $percorso = $row['percorso'];

        if (file_exists($percorso)) {
            unlink($percorso);
        }

       $stmt = $connection->prepare("DELETE FROM documenti WHERE id = ? AND id_utente = ?");
       $stmt->bind_param("ii", $idDocumento, $idUtente);
       $stmt->execute();

        header("Location: Cestino.php?msg=deleted");
        exit;
    }
?>
