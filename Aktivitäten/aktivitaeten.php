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

<!-- Vorheriger und Nächster Monat Buttons -->
<div style="text-align: center; margin-top: 20px;">
    <button onclick="loadPreviousMonth()">Vorheriger Monat</button>
    <button onclick="loadNextMonth()">Nächster Monat</button>
</div>

<!-- Kalenderbereich -->
<div id="calendar">
    <!-- Hier wird der Kalender angezeigt -->
</div>

<!-- Formular zum Hinzufügen von Ereignissen -->
<form action="aktivitaeten_do.php" method="post" enctype="multipart/form-data">
    <h1>Kalender</h1>
    <br><br>
    <!-- Weitere Eingabefelder für Ereignisse hier einfügen -->
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
    <button type="submit">Ereignis hinzufügen</button>
</form>

<!-- JavaScript für die Monatsnavigation -->
<script>
    let currentDate = new Date(); // Aktuelles Datum

    // Funktion zum Laden des vorherigen Monats
    function loadPreviousMonth() {
        currentDate.setMonth(currentDate.getMonth() - 1);
        loadCalendar();
    }

    // Funktion zum Laden des nächsten Monats
    function loadNextMonth() {
        currentDate.setMonth(currentDate.getMonth() + 1);
        loadCalendar();
    }

    // Funktion zum Laden des Kalenders basierend auf dem aktuellen Datum
    function loadCalendar() {
        // Hier kannst du die Logik implementieren, um den Kalender für das aktuelle Datum zu laden
        // und die Ereignisse für den aktuellen Monat anzeigen
        // Tipp: Du kannst Ajax verwenden, um Daten vom Server zu laden oder die Seite neu zu rendern
    }

    // Initialen Kalender laden
    loadCalendar();
</script>

</body>
</html>
