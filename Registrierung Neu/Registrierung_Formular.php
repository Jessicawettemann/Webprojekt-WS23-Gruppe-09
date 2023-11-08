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
    <form action="Registrierung_do.php" method="post" enctype="multipart/form-data">
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
    </form>
</div>

</body>
</html>