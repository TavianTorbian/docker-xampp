<?php
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

if(isset($_POST['inserire']))
{
    $testo = $_POST['text'];
    $data = date("Y-m-d");
  
  
    if ($connection->affected_rows > 0) {
      $query = "INSERT INTO messaggi (testo, data) VALUES ('$testo', '$data')";
      $result = $connection->query($query);
    } else {
        echo "Errore nell'inserimento del messaggio";
    }
}
$connection->close();
?>