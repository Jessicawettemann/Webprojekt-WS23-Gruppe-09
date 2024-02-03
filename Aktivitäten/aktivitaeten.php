<?php
// Einbinden der Datei für Sicherheitsüberprüfungen
include "Header Sicherheit.php";

// Einbinden der Datei für die Datenbankverbindung
include "Datenbank Verbindung.php";
?>

<!DOCTYPE html>
<html lang="de">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Terminkalender</title>
   
   <!-- Einbinden des Stylesheets für die Darstellung -->
   <link rel="stylesheet" type="text/css" href="css_kalender.css">
</head>
<body>

<!-- Formular zum Hinzufügen von Ereignissen -->
<form action="aktivitaeten_do.php" method="post" enctype="multipart/form-data">
    <!-- Überschrift für das Formular -->
    <h1>Kalender</h1>
    <br><br>
    
    <!-- Eingabefelder für Thema, Beschreibung, Datum und Ort -->
    <label for="thema"></label>
    <input type="text" placeholder="Thema" id="thema" name="thema" required>

    <label for="beschreibung"></label>
    <input type="text" placeholder="Beschreibung" id="beschreibung" name="beschreibung" required>

    <label for="datum"></label>
    <input type="date" placeholder="Datum" id="datum" name="datum" required>

    <label for="ort"></label>
    <input type="text"  placeholder="Ort" id="ort" name="ort" required>

    <br>
    <br>
    
    <!-- Button zum Hinzufügen eines Ereignisses -->
    <button class="ereignis-button" type="submit">Ereignis hinzufügen</button>

    <br>
    <br>
</form>

<!-- Kalenderbereich -->
<div id="calendar">
    <?php include "calendar.php"; ?>
</div>

</body>
</html>
