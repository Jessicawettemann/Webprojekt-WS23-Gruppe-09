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
    $eventName = $_POST['event_name'];
    $eventBeschreibung = $_POST['event_beschreibung'];
    $eventDatum = $_POST['datum'];
    $eventOrt = $_POST['ort'];

    // SQL-Query zum Hinzufügen des Ereignisses
    $sql = "INSERT INTO events (name, beschreibung, date, location) VALUES ('$eventName', '$eventBeschreibung', '$eventDatum', '$eventOrt')";

    if ($conn->query($sql) === TRUE) {
        echo "Ereignis wurde erfolgreich hinzugefügt";
    } else {
        echo "Fehler beim Hinzufügen des Ereignisses: " . $conn->error;
    }
}

// Datenbankverbindung schließen
$conn->close();
?>

