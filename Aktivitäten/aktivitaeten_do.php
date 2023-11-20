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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $beschreibung = $_POST['beschreibung'];
    $datum = $_POST['datum'];
    $ort = $_POST['ort'];

    // SQL-Query zum Hinzufügen des Ereignisses
    $sql = "INSERT INTO Aktivitäten (name, beschreibung, datum, ort) VALUES ('$name', '$beschreibung', '$datum', '$ort')";

    if ($conn->query($sql) === TRUE) {
        echo "Ereignis wurde erfolgreich hinzugefügt";
    } else {
        echo "Fehler beim Hinzufügen des Ereignisses: " . $conn->error;
    }
}

// Datenbankverbindung schließen
$conn->close();
?>

