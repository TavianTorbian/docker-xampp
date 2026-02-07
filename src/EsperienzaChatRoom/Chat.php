<?php
session_start();

if (isset($_SESSION['username'])) {

    // Connessione al DB
    $host = 'db'; 
    $dbname = 'ChatRoom'; 
    $user = 'user';
    $password = 'user';
    $port = 3306;

    $connection = new mysqli($host, $user, $password, $dbname, $port);

    if ($connection->connect_error) {
        die("Errore di connessione: " . $connection->connect_error);
    }

    $nome = $_GET['nome'] ?? $_POST['nome'] ?? null;
}else{
    header("Location: Login.php");
}
?>

<h1>Benvenuto nella ChatRoom!</h1>
<h3>Qui puoi scrivere i tuoi messaggi e visualizzare quelli degli altri utenti!!</h3>
<form method="post" action="Chat.php">
    <input type="hidden" name="nome" value="<?php echo $nome; ?>">
    <label>Messaggio:</label><br>
    <input type="text" name="testo" required>
    <br><br>
    <input type="submit" name="inserire" value="Invia Messaggio">
</form>
<br><br>
<h3>Visualizzazione Messaggi Precedenti...</h3>
<form method="get" action="Chat.php">
    <input type="hidden" name="nome" value="<?php echo $nome; ?>">
    <input type="submit" name="visualizza" value="Visualizza Messaggi">
</form>
<br><br>

<?php

    if (isset($_POST['inserire']) && $nome) {

        $testo = $_POST['testo'];
        $data = date("Y-m-d");

        $query = "INSERT INTO messaggi (id, testo, data) VALUES ('$nome', '$testo', '$data')";
        $result = $connection->query($query);

        if ($connection->affected_rows > 0) {
            echo "<p style='color:green'>Messaggio inserito con successo</p>";
        } else {
            echo "<p style='color:red'>Errore nell'inserimento del messaggio</p>";
        }
    }

    $query = "SELECT * FROM messaggi WHERE id = '$nome' ORDER BY data DESC";
    $result = $connection->query($query);

    if ($result && $result->num_rows > 0) {
        echo "<h3>Messaggi Precedenti nella chat: <b>$nome</b></h3>";
        echo "<table border='1'>";
        echo "<tr><th>Messaggio</th><th>Data</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['testo'] . "</td>";
            echo "<td>" . $row['data'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>Nessun messaggio presente in questa chat.</p>";
    }
    
$connection->close();
?>
