<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: Login.html");

}else{    

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

    if (isset($_POST['delete_id'])) { 
        $idDocumento = intval($_POST['delete_id']); 
        $stmt = $connection->prepare("SELECT percorso FROM documenti WHERE id = ? AND id_utente = ?"); 
        $stmt->bind_param("ii", $idDocumento, $idUtente); 
        $stmt->execute(); 
        $result = $stmt->get_result(); 
        if ($result->num_rows > 0) { 
            $row = $result->fetch_assoc(); 
            $percorso = $row['percorso']; 
            if (file_exists($percorso)) { 
                unlink($percorso); 
            } 
            $stmt = $connection->prepare("DELETE FROM documenti WHERE id = ? AND id_utente = ?"); 
            $stmt->bind_param("ii", $idDocumento, $idUtente); 
            $stmt->execute(); 
            echo "<p style='color:green'>File eliminato con successo!</p>"; 
        } else { 
            echo "<p style='color:red'>Errore: file non trovato o non autorizzato.</p>"; 
        } 
    }
}
?>