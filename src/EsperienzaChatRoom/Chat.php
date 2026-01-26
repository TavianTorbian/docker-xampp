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

    $connection->close();
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

<script src="script.js"></script>

<?php

if(isset($_POST['inserire']))
{
    
}

?>