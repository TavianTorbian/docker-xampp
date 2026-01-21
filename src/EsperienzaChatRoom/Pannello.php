<?php
session_start();
if(isset($_SESSION['username']))
{
    $host = 'db'; 
    $dbname = 'ChatRoom'; 
    $user = 'user';
    $password = 'user';
    $port = 3306;
    
    $connection = new mysqli($host, $user, $password, $dbname, $port);
    
    if ($connection->connect_error) 
    {
        die("Errore di connessione: " . $connection->connect_error);
    }

    echo '<h1>Benvenuto nelle ChatRoom!</h1>';
    echo '<h3>Crea una nuova ChatRoom...</h3>';
    echo '<section>';
    echo '<form method="post" action="Pannello.php">';
    echo '<label for="NomeChat">Nome ChatRoom:</label><br>';
    echo '<input type="text" id="NomeChat" name="NomeChat"><br><br>';
    echo '<input type="submit" value="Crea ChatRoom">';
    echo '<br><br>';
    echo '</form>';
    echo '</section>';
    echo '<br><br>';
    //echo '<h3>ChatRoom Disponibili: </h3>';
    echo '<section>';
    echo '<form method="get" action="Pannello.php">';
    echo '</form>';
    echo '</section>';

    $nome_chat=$_POST['nome'];

    $query1= "INSERT INTO stanze(nome) VALUES ('$nome_chat')";
    $result1 = $connection->query($query1);

    if ($connection->affected_rows > 0) 
    {
        $query = "SELECT nome FROM stanze";
        $result = $connection->query($query);
        if ($result->num_rows > 0) 
        {
            echo "ChatRoom Disponibili: $result->num_rows <br><br>";
            echo "<table border=1>";
            echo "<tr>";
            echo "<th>Nome ChatRoom</th>";
            echo "</tr>";
            while($row = $result->fetch_assoc())
            {
                echo "<tr>";
                echo "<td>". $row['nome'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    
    $connection->close();
}
?>