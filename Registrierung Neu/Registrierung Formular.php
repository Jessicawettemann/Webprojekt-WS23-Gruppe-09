<?php
include"Datenbank Verbindung.php";

session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Registrierung</title>

</head>
<body>

<div>
    <form action="Registrierung_do.php" method="post">
        <h2>Registrieren</h2>


        <label class="label" for="Benutzername"></label>
        <input type="text"  placeholder="Benutzername" name="Benutzername">

        <label class="label" for="Vorname"></label>
        <input type="text" placeholder="Vorname" name="Vorname">

        <label class="label" for="Nachname"></label>
        <input type="text" placeholder="Nachname" name="Nachname">


        <label class="label" for="E-Mail"></label>
        <input type="text" placeholder="E-Mail Adresse" name="E-Mail">

        <label class="label" for="Passwort"></label>
        <input type="password" placeholder="Passwort" name="Passwort">

        <label class="label" for="Profilbild"></label>
        <input type="file" placeholder="Profilbild" name="Profilbild">

        <button type="submit">Registrieren</button>
    </form>
</div>

</body>
</html>
