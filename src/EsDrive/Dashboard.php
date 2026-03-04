<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: Login.html");

}else{    

    $host = 'db';
    $dbname = 'Drive';
    $user = 'user';
    $dbpassword = 'user';
    $port = 3306;

    $connection = new mysqli($host, $user, $dbpassword, $dbname, $port);

    if ($connection->connect_error) {
        die("Errore di connessione: " . $connection->connect_error);
    }

    $idUtente = $_SESSION['id'];
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
<link rel="stylesheet" href="style.css">
<h1>Benvenuto nel tuo Drive!</h1>
<h2>Carica un nuovo file</h2>
<form method="post" action="Dashboard.php" enctype="multipart/form-data">
    <div class="file has-name is-boxed is-primary">
        <label class="file-label">
            <input class="file-input" type="file" name="file" required>
            <span class="file-cta">
                <span class="file-icon">
                    📁
                </span>
                <span class="file-label">
                    Scegli un file…
                </span>
            </span>
            <span class="file-name">
                Nessun file selezionato
            </span>
        </label>
    </div>
    <br>
    <button class="button is-primary" type="submit" name="upload">
        Carica File
    </button>
</form>

<br><br>
<h2>I tuoi file: </h2>
<br>

<?php

    if (isset($_POST['upload']) && isset($_FILES['file'])){ 
        $nome = $_FILES['file']['name']; 
        $path = $_FILES['file']['tmp_name']; 
        $dest = "uploads/" . $idUtente . "_" . $nome; 
        if (move_uploaded_file($path, $dest)){ 
            $stmt = $connection->prepare( "INSERT INTO documenti (id_utente, nome, data, percorso) VALUES (?, ?, CURDATE(), ?)" ); 
            $stmt->bind_param("iss", $idUtente, $nome, $dest); 
            $stmt->execute(); 
            echo "<p style='color:green'>File caricato con successo!</p>"; 
        } else { 
            echo "<p style='color:red'>Errore nel caricamento del file.</p>";
        } 
    }

        $stmt = $connection->prepare("SELECT id, nome, data, percorso FROM documenti WHERE id_utente = ? AND cestinato = 0"); 
        $stmt->bind_param("i", $idUtente); 
        $stmt->execute(); 
        $result = $stmt->get_result();

        if ($result->num_rows > 0) { 
            echo "<table border='1'>"; 
            echo "<tr> <th>Nome File</th> <th>Data</th> <th>Apri</th> <th>Elimina</th> <th>Rinomina</th> </tr>"; 
            while ($row = $result->fetch_assoc()) { 
                echo "<tr>"; 
                echo "<td>{$row['nome']}</td>"; 
                echo "<td>{$row['data']}</td>"; 
                //------------------Apri-------------------
                echo "<td><a href='{$row['percorso']}' target='_blank'>Apri</a></td>"; 
                //------------------Eliminazione--------------------
                echo "<td> 
                <form method='post' action='Elimina.php' onsubmit='return confermaEliminazione()'> 
                <input type='hidden' name='delete_id' value='{$row['id']}'> 
                <button class='button button-delete'>Elimina</button>
                </form> 
                </td>";
                //----------------Rinominazione----------------------
                echo "<td> 
                <form method='post' action='Rinomina.php' onsubmit='return rinominaFile(this)'> 
                <input type='hidden' name='rename_id' value='{$row['id']}'> 
                <input type='hidden' name='old_name' value='{$row['nome']}'> 
                <button class='button button-rename'>Rinomina</button>
                </form> 
                </td>";
            } 
                echo "</table>"; 
        } else { 
            echo "<p style='color:orange'>Non hai ancora caricato file.</p>"; 
        }

        echo "<br><br>";
        echo "<a href='Cestino.php'>Vai al Cestino!</a>";

    if (isset($_GET['msg'])) { 
        if ($_GET['msg'] === 'deleted') { 
            echo "<p style='color:green'>File eliminato con successo!</p>"; 
        } 
        if ($_GET['msg'] === 'renamed') { 
            echo "<p style='color:green'>File rinominato con successo!</p>"; 
        } 
    }


?>   

<script> 
function confermaEliminazione() { 
    return confirm("Sei sicuro di voler eliminare questo file?"); 
} 

function rinominaFile(form) { 
    let oldName = form.querySelector("input[name='old_name']").value; 
    let nuovoNome = prompt("Inserisci il nuovo nome del file:", oldName); 
    if (nuovoNome === null || nuovoNome.trim() === "") { 
        return false; 
    } 
    let input = document.createElement("input"); 
    input.type = "hidden"; 
    input.name = "new_name"; 
    input.value = nuovoNome; 
    form.appendChild(input); 
    return true; 
}

document.addEventListener('DOMContentLoaded', () => {
    const fileInput = document.querySelector('.file-input');
    const fileName = document.querySelector('.file-name');

    fileInput.addEventListener('change', () => {
        if (fileInput.files.length > 0) {
            fileName.textContent = fileInput.files[0].name;
        }
    });
});

</script>