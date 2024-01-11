<?php
include "Header Sicherheit.php";
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terminkalender</title>
    <link rel="stylesheet" type="text/css" href="css_kalender.css">
</head>
<body>

    <!-- Kalenderbereich -->
    <div id="calendar">
        <!-- Hier wird der Kalender angezeigt -->
    </div>
    <br>
    <br>

        <!-- Pfeile für den Monatswechsel -->
        <button id="prevMonth">Previous Month</button>
    <button id="nextMonth">Next Month</button>

    <!-- JavaScript-Datei einbinden -->
    <script src="calendar.js"></script>


    <!-- Formular zum Hinzufügen von Ereignissen -->
    <form action="aktivitaeten_do.php" method="post" enctype="multipart/form-data">
        <h1>Kalender</h1>
        <br><br>
        <label for="thema"></label>
        <input type="text" placeholder="Thema" id="thema" name="thema" required>

        <label for="beschreibung"></label>
        <input type="text" placeholder="Beschreibung" id="beschreibung" name="beschreibung" required>

        <label for="datum"></label>
        <input type="date" placeholder="Datum" id="datum" name="datum" required>

        <label for="ort"></label>
        <input type="text" placeholder="Ort" id="ort" name="ort" required>

        <br>
        <br>
        <button type="submit">Ereignis hinzufügen</button>
        <br>
        <br>

    </form>

</body>
</html>
