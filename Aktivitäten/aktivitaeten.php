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
    <form action="add_event.php" method="post">
        <label for="event">Ereignis hinzufügen:</label>
        <label for="event">Beschreibung hinzufügen:</label>
        <input type="text" id="event" name="event" required>
        <label for="date">Datum:</label>
        <input type="date" id="date" name="date" required>
        <button type="submit">Ereignis hinzufügen</button>
    </form>
</body>
</html>
