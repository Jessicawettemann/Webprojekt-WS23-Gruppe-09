<?php

include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">

    <title>Aktvitäten</title>
</head>
<body>
<div>
    <h2>Playlist erstellen</h2>
</div>
<div>
    <form action="aktivitaeten_do.php" method="post" enctype="multipart/form-data">
        <br><br>
        <label for="name">Ereignis hinzufügen:</label>
        <input type="text" placeholder="name" name="name">

        <label for="beschreibung">Beschreibung hinzufügen:</label>
        <input type="text" placeholder="beschreibung" name="beschreibung">

        <label for="datum">Datum:</label>
        <input type="date" placeholder="datum" name="datum">

        <label for="ort">Ort:</label>
        <input type="text" placeholder="ort" name="ort">

        <button type="submit">Erstellen</button>
    </form>
</div>
</body>
</html>
