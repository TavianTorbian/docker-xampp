<?php
session_start();
if((isset($_SESSION['username']) && $_SESSION['username']==true))
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
}
?>
<h1>Benvenuto nella ChatRoom!</h1>
<h3>Qui puoi scrivere i tuoi messaggi e visualizzare quelli degli altri utenti!!</h3>
<form method="post" action="Chat.php">
    <label>Messaggio:</label><br>
    <input type="text" name="testo" required>
    <br><br>
    <input type="submit" name="inserire" value="Invia Messaggio">
</form>
<br><br>
<h3>Visualizzazione Messaggi Precedenti...</h3>
<form method="get" action="Chat.php">
    <input type="submit" name="visualizza" value="Visualizza Messaggi">
</form>
<br><br>

<?php

  if(isset($_GET ["visualizza"])){

    $id = $_GET['nome']; 

    $query = "SELECT * FROM messaggi GROUP BY id";
    $result = $connection->query($query);
  
    if ($result->num_rows > 0) {
      echo "<h3>Messaggi Precedenti:</h3>";
      echo "<table border='1'>";
      echo "<tr>"; 
      echo "<th>Messaggio</th>"; 
      echo "<th>Data</th>";
      echo "</tr>";
  
      while ($row = $result->fetch_assoc()) {
          echo '<tr>';
          echo "<td>". $row['testo'] . "</td>";
          echo "<td>". $row['data'] . "</td>";
          echo '</tr>';
      }
      echo "</table>";
  }}

  if(isset($_POST['inserire'])) 
  {
      $id = $_GET['nome']; 
      $testo =$_POST['testo'];
      $data = date("Y-m-d");

      $query = "INSERT INTO messaggi (id, testo, data) VALUES ('$id', '$testo', '$data')";
      $result = $connection->query($query);
  
      if ($connection->affected_rows > 0) {
          echo "<p style='color:green'>Messaggio inserito con successo</p>";
      } else {
          echo "<p style='color:red'>Errore nell'inserimento del messaggio</p>";
      }
    }

$connection->close();
?>