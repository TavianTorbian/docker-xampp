<?php
session_start();

    $host = 'db'; 
    $dbname = 'Drive'; 
    $user = 'user';
    $password = 'user';
    $port = 3306;
    
    $connection = new mysqli($host, $user, $password, $dbname, $port);
    
    if ($connection->connect_error) {
        die("Errore di connessione: " . $connection->connect_error);
    }
?>

<h1>Benvenuto nel tuo Drive!</h1>
<br><br>
<form method="post" action="Dashboard.php" enctype="multipart/form-data">
    <input type="file" name="file" id="file"><br>
    <br><br>
    <input type="submit" name="upload" value="Carica File">
</form>
<br><br>
<h3>Visualizzazione File Caricati...</h3>
<form method="get" action="Dashboard.php">
    <input type="submit" name="visualizza" value="Visualizza">
</form>
<br><br>

<?php
if (isset($_SESSION['email'])) {

    if (isset($_POST['upload']) && isset($_FILES['file'])) {

        $nome= $_POST['nome'];
        $path = $_FILES['file']['tmp_name'];
        if(file_exists($path)){

            $contenuto = file_get_contents($path);
            $query = "INSERT INTO Documenti(nome, data, content) VALUES ('$nome', 'CURDATE()', '$contenuto')";

            if ($connection->query($query)) {
                echo "<p style='color:green'>File caricato con successo!</p>";
            } else {
                echo "<p style='color:red'>Errore nel caricamento del file</p>";
            }
        }
    }

    if (isset($_GET['visualizza'])) {

        $query = "SELECT nome, data  FROM Documenti";
        $result = $connection->query($query);

        if ($result->num_rows > 0) {
            echo "<h3>File caricati:</h3>";
            echo "<table border='1'>";
            echo "<tr>"; 
            echo "<th>Nome File</th>"; 
            echo "<th>Data Inserimento</th>"; 
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
}else{
    header("Location: Login.php");
}
?>