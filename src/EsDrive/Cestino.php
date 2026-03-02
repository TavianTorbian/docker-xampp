<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header("Location: Login.html");
    }

    $host = 'db';
    $dbname = 'Drive';
    $user = 'user';
    $dbpassword = 'user';
    $port = 3306;

    $connection = new mysqli($host, $user, $dbpassword, $dbname, $port);

    $idUtente = $_SESSION['id'];

    $stmt = $connection->prepare("SELECT id, nome, data, percorso FROM documenti WHERE id_utente = ? AND cestinato = 1");
    $stmt->bind_param("i", $idUtente);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<h1>Cestino</h1>";

    if ($result->num_rows > 0) {
        echo "<table border='1'>
            <tr>
                <th>Nome</th>
                <th>Data</th>
                <th>Ripristina</th>
                <th>Elimina definitivamente</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['nome']}</td>";
            echo "<td>{$row['data']}</td>";
            //---------------Ripristina---------------------
            echo "<td>
                <form method='post' action='Ripristina.php'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <button type='submit'>Ripristina</button>
                </form>
              </td>";

            //----------------Elimina Definitivamente---------------------
            echo "<td>
                <form method='post' action='Elimina.php' onsubmit='return confermaEliminazione()'>
                    <input type='hidden' name='delete_id' value='{$row['id']}'>
                    <input type='hidden' name='definitivo' value='1'>
                    <button type='submit'>Elimina definitivamente</button>
                </form>
              </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
    echo "<p>Nessun file nel cestino.</p>";
    }
    
    if (isset($_GET['msg'])) {
        if ($_GET['msg'] === 'restored') {
            echo "<p style='color:green'>File ripristinato con successo!</p>";
        }
        if ($_GET['msg'] === 'deleted') {
            echo "<p style='color:green'>File eliminato definitivamente!</p>";
        }
        if ($_GET['msg'] === 'error') {
            echo "<p style='color:red'>Errore durante l'operazione.</p>";
        }
    }
    
    echo "<br><br>";
    echo "<a href='Dashboard.php'>Torna alla Dashboard!</a>";
?>
