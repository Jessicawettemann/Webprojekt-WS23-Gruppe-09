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

// SQL-Anweisung vorbereiten
$statement = $pdo->prepare("INSERT INTO Aktivitäten (thema, beschreibung, datum, ort) VALUES (?, ?, ?, ?)");

// Wenn die Vorbereitung fehlschlägt, wird eine Fehlermeldung ausgegeben
if (!$statement) {
    die("Fehler bei der Datenbankabfrage: " . $pdo->errorInfo()[2]);
}

// Werte an die Platzhalter binden
$statement->bindValue(1, $thema, PDO::PARAM_STR);
$statement->bindValue(2, $beschreibung, PDO::PARAM_STR);
$statement->bindValue(3, $datum, PDO::PARAM_STR);
$statement->bindValue(4, $ort, PDO::PARAM_STR);

// SQL-Anweisung ausführen
if (!$statement->execute()) {
    die("Fehler bei der Datenbankabfrage: " . $pdo->errorInfo()[2]);
}

$stmt = null;
$result = $statement->fetch(PDO::FETCH_ASSOC);
?>