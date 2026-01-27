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

<div class="chat-container">
  <div class="chat-header">Chat</div>

  <div class="chat-messages" id="chatMessages">
    <!-- messaggi qui -->
  </div>

  <div class="chat-input">
    <input type="text" id="message" placeholder="Scrivi un messaggio">
    <button onclick="sendMessage()">Invia</button>
  </div>
</div>

<script src="/js/script.js"></script>

<?php

  $query = "SELECT * FROM messaggi";
  $result = $connection->query($query);

  if ($result->num_rows > 0) {
    echo "<h3>ChatRoom disponibili:</h3>";
    echo "<table border='1'>";
    echo "<tr>"; 
    echo "<th>Messaggi Precedenti</th>"; 
    echo "</tr>";

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo "<td>". $row['testo'] . "</td>";
        echo "<td>". $row['data'] . "</td>";
        echo '</tr>';
    }
    echo "</table>";

    if(isset($_POST['inserire'])) 
    {
      $testo = $_POST['testo'];
      $data = date("Y-m-d");

      $query = "INSERT INTO messaggi (testo, data) VALUES ('$testo', '$data')";
      $result = $connection->query($query);
      if ($connection->affected_rows > 0) {
        echo "Messaggio inserito con successo";
      } else {
        echo "Errore nell'inserimento del messaggio";
      }
    }
  }
$connection->close();
?>