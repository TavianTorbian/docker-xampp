<?php
session_start();

if(isset($_SESSION['auth']))
{
    echo '<section>';
    echo '<form method="post" action="prodgiochi.php"'
    echo '<label for="username">Nome Elfo:</label><br>'
    echo '<input type="text" id="nome_elfo" name="nome_elfo"><br>'
    echo '<label for="password">Nome Giocattolo:</label><br>'
    echo '<input type="text" id="nome_gioco" name="nome_gioco"><br><br>'
    echo '<input type="submit" value="Inserisci">'
    echo '</form></section>'
}