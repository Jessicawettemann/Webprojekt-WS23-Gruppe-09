<?php
include "Header Sicherheit.php";
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Startseite</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 20px;
}

#calendar {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    grid-gap: 10px;
}

.day {
    border: 1px solid #ddd;
    padding: 10px;
}

.day:hover {
    background-color: #f5f5f5;
}

.events {
    list-style: none;
    padding: 0;
}

.events li {
    margin-bottom: 5px;
}
</style> <!-- Einrückung nochmal schauen -->

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