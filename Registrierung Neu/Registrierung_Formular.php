<?php
session_start();
include"Datenbank Verbindung.php";

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Registrierung</title>
    <link rel="stylesheet" type="text/css" href="Formulare.css">

</head>
<img src="https://mars.iuk.hdm-stuttgart.de/~jw170/Bilder/Teal Green Simple Illustrated Social Media Policy Presentation.png">
<body>

<div>
    <form1 action="Registrierung_do.php" method="post" enctype="multipart/form-data">
        <h2>Registrieren</h2>
        <label class="label" for="profilbild"></label>
        <input type="file" placeholder="Profilbild" name="profilbild">

        <label class="label" for="vorname"></label>
        <input type="text" placeholder="Vorname" name="vorname">

        <label class="label" for="nachname"></label>
        <input type="text" placeholder="Nachname" name="nachname">

        <label class="label" for="benutzername"></label>
        <input type="text"  placeholder="Benutzername" name="benutzername">

        <label class="label" for="email"></label>
        <input type="text" placeholder="E-Mail adresse" name="email">

        <label class="label" for="passwort"></label>
        <input type="password" placeholder="Passwort" name="passwort">

        <button type="submit">Registrieren</button>
    </form1>
</div>

</body>
</html>