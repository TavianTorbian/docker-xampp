<?php
session_start();
if(isset($_SESSION['auth']))
{
    $host = 'db'; 
    $dbname = 'root_db'; 
    $user = 'user';
    $password = 'user';
    $port = 3306;

    $connection = new mysqli($host, $user, $password, $dbname, $port);

    if ($connection->connect_error) 
    {
        die("Errore di connessione: " . $connection->connect_error);
    }

    $query = "SELECT * FROM Giocattoli";
    $result = $connection->query($query);

    if($connection->affected_rows > 0)
    {
        echo "Tabella Utenti contiene: $result->num_rows <br><br>";
        echo "<table border=1>";
        echo "<tr>";
        echo "<th>Username</th>";
        echo "<th>Password</th>";
        echo "</tr>";
        while($row = $result->fetch_assoc())
        {
            echo "<tr>";
            echo "<td>". $row['nome_gioco'] . "</td>";
            echo  "<td>" . $row['nome_elfo'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    else{
        echo "Errore di Visualizzazione!";
    }

    
}