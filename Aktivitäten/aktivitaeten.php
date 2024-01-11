<?php
include "Header Sicherheit.php";
include "Datenbank Verbindung.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Aktivitäten und Kalender</title>
    <link rel="stylesheet" type="text/css" href="css_kalender.css">
</head>
<body>

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
        <input type="text"  placeholder="Ort" id="ort" name="ort" required>

        <button type="submit">Ereignis hinzufügen</button>

    </form>

    <!-- Hier füge den Kalender ein -->
    <?php include "calendar.php"; ?>

</body>
</html>
