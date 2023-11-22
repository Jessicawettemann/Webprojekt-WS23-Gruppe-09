<?php
include "Header Sicherheit.php";

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terminkalender</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <h1>Kalender</h1>
    
    <!-- Kalenderbereich -->
    <div id="calendar">
        <!-- Hier wird der Kalender angezeigt -->
    </div>

    <!-- Formular zum Hinzufügen von Ereignissen -->
    <form action="aktivitaeten_do.php" method="post" enctype="multipart/form-data">
        <label for="thema">Ereignis hinzufügen:</label>
        <input type="text" id="thema" name="thema" required>

        <label for="thema">Ereignis hinzufügen:</label>
        <input type="text" id="thema" name="thema" required>

        <label for="beschreibung">Beschreibung hinzufügen:</label>
        <input type="text" id="beschreibung" name="beschreibung" required>

        <label for="datum">Datum:</label>
        <input type="date" id="datum" name="datum" required>

        <label for="ort">Ort:</label>
        <input type="text" id="ort" name="ort" required>

        <button type="submit">Ereignis hinzufügen</button>
        
        
    </form>
</body>
</html>
