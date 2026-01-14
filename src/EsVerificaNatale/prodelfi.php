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

    $nome_gioco=['nome_gioco'];

    $query = "SELECT nome_gioco, COUNT(*) AS numero_giochi FROM Giocattoli GROUP BY nome_gioco";
    $result = $connection->query($query);

    if($connection->affected_rows > 0)
    {
        echo "Tabella Utenti contiene: $result->num_rows <br><br>";
        echo "<table border=1>";
        echo "<tr>";
        echo "<th>Nomer Gioco</th>";
        echo "<th>Numero Volte Prodotto</th>";
        echo "</tr>";
        while($row = $result->fetch_assoc())
        {
            echo "<tr>";
            echo "<td>". $row['nome_gioco'] . "</td>";
            echo  "<td>" . $row['numero_giochi'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    else{
        echo "Errore di Visualizzazione!";
    }

    
}