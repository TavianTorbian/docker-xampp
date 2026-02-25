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

<h1>Benvenuto nel tuo Drive!</h1>
<h2>Carica un nuovo file</h2>
<form method="post" action="Dashboard.php" enctype="multipart/form-data">
    <input type="file" name="file" required><br><br>
    <input type="submit" name="upload" value="Carica File">
</form>
<br><br>
<h2>I tuoi file: </h2>
<form method="get" action="Dashboard.php">
    <input type="submit" name="visualizza" value="Visualizza File">
</form>
<br>

<?php

    if (isset($_POST['upload']) && isset($_FILES['file'])){ 
        $nome = $_FILES['file']['name']; 
        $path = $_FILES['file']['tmp_name']; 
        $dest = "uploads/" . $idUtente . "_" . $nome; 
        if (move_uploaded_file($path, $dest)){ 
            $stmt = $connection->prepare( "INSERT INTO documenti (id_utente, nome, data, percorso) VALUES (?, ?, CURDATE(), ?)" ); 
            $stmt->bind_param("iss", $idUtente, $nome, $dest); 
            $stmt->execute(); echo "<p style='color:green'>File caricato con successo!</p>"; 
        } else { 
            echo "<p style='color:red'>Errore nel caricamento del file.</p>";
        } 
    }

    if (isset($_GET['visualizza'])) {

        $stmt = $connection->prepare("SELECT id, nome, data, percorso FROM documenti WHERE id_utente = ?"); 
        $stmt->bind_param("i", $idUtente); 
        $stmt->execute(); 
        $result = $stmt->get_result();

        if ($result->num_rows > 0) { 
            echo "<table border='1'>"; 
            echo "<tr> <th>Nome File</th> <th>Data</th> <th>Apri</th> <th>Elimina</th> <th>Rinomina</th> </tr>"; 
            while ($row = $result->fetch_assoc()) { 
                echo "<tr>"; echo "<td>{$row['nome']}</td>"; 
                echo "<td>{$row['data']}</td>"; 
                echo "<td><a href='{$row['percorso']}' target='_blank'>Apri</a></td>"; 
                echo "<td> <form method='post' action='Dashboard.php' onsubmit='return confermaEliminazione()'> 
                            <input type='hidden' name='delete_id' value='{$row['id']}'> 
                            <button type='submit'>Elimina</button> 
                            </form> 
                    </td>"; 
                echo "<td><a href='#'>Rinomina</a></td>"; 
                echo "</tr>"; 
            } 
                echo "</table>"; 
        } else { 
            echo "<p style='color:orange'>Non hai ancora caricato file.</p>"; 
        }
    }
?>   

<script> 
function confermaEliminazione() { 
    return confirm("Sei sicuro di voler eliminare questo file?"); 
} 
</script>