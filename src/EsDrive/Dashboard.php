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
}
?>

<h1>Benvenuto nel Drive!</h1>
<h3> + Nuovo</h3>
<form method="post" action="Dashboard.php">
    <label>Carica File:</label><br>
    <input type="file" name="file" required><br>
    <br><br>
    <input type="submit" name="upload" value="Inserisci">
</form>
<br><br>
<h3>Visualizzazione File Caricati</h3>
<form method="get" action="Dashboard.php">
    <input type="submit" name="visualizza" value="Visualizza">
</form>
<br><br>

<?php

if (isset($_POST['upload'])) {

    $nome= $_POST['nome'];
    $query = "INSERT INTO Documenti(nome) VALUES ('$nome')";
    if ($connection->query($query)) {
        echo "<p style='color:green'>File caricato con successo!</p>";
    } else {
        echo "<p style='color:red'>Errore nel caricamento del file</p>";
    }
}

if (isset($_GET['visualizza'])) {

    $query = "SELECT nome FROM Documenti";
    $result = $connection->query($query);

    if ($result->num_rows > 0) {
        echo "<h3>File caricati:</h3>";
        echo "<table border='1'>";
        echo "<tr>"; 
        echo "<th>Nome File</th>"; 
        echo "<th>Link Contenuto</th>"; 
        echo "</tr>";

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo "<td>". $row['nome'] . "</td>";
            echo "<td><a href='File.php?nome=" . $row['nome'] . "'>Vedi Content</a></td>";
            echo '</tr>';
        }
        echo "</table>";
    } else {
        echo "<p style='color:orange'>Nessun File disponibile...</p>";
    }
}

$connection->close();
?>