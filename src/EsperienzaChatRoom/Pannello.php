<?php
session_start();

if (!isset($_SESSION['username'])) {
    exit("Accesso non autorizzato");
}

$host = 'db'; 
$dbname = 'ChatRoom'; 
$user = 'user';
$password = 'user';
$port = 3306;

$connection = new mysqli($host, $user, $password, $dbname, $port);

if ($connection->connect_error) {
    die("Errore di connessione: " . $connection->connect_error);
}
?>

<h1>Benvenuto nella pagina di accesso alle ChatRoom!</h1>
<h3>Crea una nuova ChatRoom</h3>
<form method="post" action="Pannello.php">
    <label>Nome ChatRoom:</label><br>
    <input type="text" name="nome" required>
    <br><br>
    <input type="submit" name="crea" value="Crea ChatRoom">
</form>
<br><br>
<h3>Visualizzazione ChatRoom Disponibili</h3>
<form method="get" action="Pannello.php">
    <input type="submit" name="visualizza" value="Visualizza ChatRoom">
</form>
<br><br>

<?php

if (isset($_POST['crea'])) {

    $nome_chat= $_POST['nome'];
    $query = "INSERT INTO stanze(nome) VALUES ('$nome_chat')";
    if ($connection->query($query)) {
        echo "<p style='color:green'>ChatRoom creata con successo!</p>";
    } else {
        echo "<p style='color:red'>Errore nella creazione della ChatRoom</p>";
    }
}

if (isset($_GET['visualizza'])) {
    $query = "SELECT nome FROM stanze";
    $result = $connection->query($query);

    if ($result->num_rows > 0) {
        echo "<h3>ChatRoom disponibili:</h3>";
        echo "<table border='1'>";
        echo "<tr>"; 
        echo "<th>Nome ChatRoom</th>"; 
        echo "<th>Link ChatRoom</th>"; 
        echo "</tr>";

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo "<td>". $row['nome'] . "</td>";
            echo "<td><a href='Chat.php?nome=" . $row['nome'] . "'>Apri chat</a></td>";
            echo '</tr>';
        }
        echo "</table>";
    } else {
        echo "Nessuna ChatRoom disponibile...";
    }
}

$connection->close();
?>
