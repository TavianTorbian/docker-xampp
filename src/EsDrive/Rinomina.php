<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: Login.html");
    exit;
}

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

if (!isset($_POST['rename_id']) || !isset($_POST['new_name'])) {
    header("Location: Dashboard.php?msg=error");
    exit;
}

$idDocumento = intval($_POST['rename_id']);
$nuovoNome = basename($_POST['new_name']);

$stmt = $connection->prepare("SELECT nome, percorso FROM documenti WHERE id = ? AND id_utente = ?");
$stmt->bind_param("ii", $idDocumento, $idUtente);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: Dashboard.php?msg=error");
    exit;
}

$row = $result->fetch_assoc();
$vecchioPercorso = $row['percorso'];
$estensione = pathinfo($vecchioPercorso, PATHINFO_EXTENSION);

$nuovoNomeCompleto = $nuovoNome . "." . $estensione;

$nuovoPercorso = "uploads/" . $idUtente . "_" . $nuovoNomeCompleto;

if (file_exists($vecchioPercorso)) {
    rename($vecchioPercorso, $nuovoPercorso);
}

$stmt = $connection->prepare("UPDATE documenti SET nome = ?, percorso = ? WHERE id = ? AND id_utente = ?");
$stmt->bind_param("ssii", $nuovoNomeCompleto, $nuovoPercorso, $idDocumento, $idUtente);
$stmt->execute();

header("Location: Dashboard.php?msg=renamed");
exit;
?>
