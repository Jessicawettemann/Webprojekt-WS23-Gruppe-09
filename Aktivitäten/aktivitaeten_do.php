<?php
include 'Datenbank Verbindung.php';
include "Header Sicherheit.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Kalender</title>

</head>

<body>
<?php

// Binde die Werte der Felder an Parametermarkierungen
$statement = $pdo->prepare("INSERT INTO Aktivitäten (beschreibung, datum, ort) VALUES (?,?,?)"); 
// In der ersten Klammer fehlt noch name

// Setze die Werte der Parameter und führe den Anweisungsvorgang aus
$beschreibung = $_POST['beschreibung'];
$datum = $_POST['datum'];
$ort = $_POST['ort'];
$stmt->execute();

echo "Neuer Eintrag wurde erfolgreich erstellt!";

$stmt->close();
$conn->close();

?>

