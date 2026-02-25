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

    if (isset($_POST['rename_id']) && isset($_POST['new_name'])) { 
        $idDocumento = intval($_POST['rename_id']); 
        $nuovoNome = basename($_POST['new_name']); 
        $stmt = $connection->prepare("SELECT nome, percorso FROM documenti WHERE id = ? AND id_utente = ?"); 
        $stmt->bind_param("ii", $idDocumento, $idUtente); 
        $stmt->execute(); 
        $result = $stmt->get_result(); 
        if ($result->num_rows > 0) { 
            $row = $result->fetch_assoc(); 
            $vecchioPercorso = $row['percorso']; 
            $estensione = pathinfo($vecchioPercorso, PATHINFO_EXTENSION); 
            $nuovoPercorso = "uploads/" . $idUtente . "_" . $nuovoNome . "." . $estensione; 
            if (file_exists($vecchioPercorso)) { rename($vecchioPercorso, $nuovoPercorso); } 
            $stmt = $connection->prepare("UPDATE documenti SET nome = ?, percorso = ? WHERE id = ? AND id_utente = ?"); 
            $stmt->bind_param("ssii", $nuovoNome, $nuovoPercorso, $idDocumento, $idUtente); 
            $stmt->execute(); 
            echo "<p style='color:green'>File rinominato con successo!</p>"; 
        } else { 
            echo "<p style='color:red'>Errore: file non trovato o non autorizzato.</p>"; 
        } 
    }

}