<?php
include "Header Sicherheit.php";
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Startseite</title>

</head>

<body>
    <h1> Das ist unsere Aktivitäten-Seite </h1>
    <h2> Kalender </h2>
    
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