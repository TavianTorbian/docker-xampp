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

    <h1>Sei Entrato nella ChatRoom!</h1>
    <h3>Qui puoi scrivere un messaggio e visualizzare quelli scritti da altri utenti!</h3>
    <form method="post" action="Chat.php">
        <label>Scrivi un messaggio...</label><br>
        <input type="text" name="nome" required>
        <br><br>
        <input type="submit" name="crea" value="Invia Messaggio">
    </form>
    <a href="Pannello.php">Torna Al Pannello!</a>

<?php

if(isset($_POST['inserire']))
{

}

?>