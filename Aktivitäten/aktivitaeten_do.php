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

 // Überprüfe, ob die Verbindung erfolgreich hergestellt wurde, und behandle den Fehlerfall
    if (!$conn) {
           die("Verbindung zur Datenbank fehlgeschlagen: " . mysqli_connect_error());
       }

// SQL-Anweisung vorbereiten
$statement = $pdo->prepare("INSERT INTO Aktivitäten (thema, beschreibung, datum, ort) VALUES (?, ?, ?, ?)");

// Werte an die Platzhalter binden
$statement->bindValue(1, $thema, PDO::PARAM_STR);
$statement->bindValue(2, $beschreibung, PDO::PARAM_STR);
$statement->bindValue(3, $datum, PDO::PARAM_STR);
$statement->bindValue(4, $ort, PDO::PARAM_STR);

// SQL-Anweisung ausführen
$statement->execute();


echo "Neuer Eintrag wurde erfolgreich erstellt!";


$stmt->close();
