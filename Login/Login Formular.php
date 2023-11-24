<?php
include "Datenbank Verbindung.php";

session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="Formulare.css">
    <title>Login</title>
</head>
<img src="https://mars.iuk.hdm-stuttgart.de/~jw170/Bilder/Teal Green Simple Illustrated Social Media Policy Presentation.png">
<body>
<div class="center">
    <h1>Login</h1>
    <form action="Login%20Do.php" method="post">
    <div class="txt_field">
        <label class="label" for="benutzername"></label>
        <input type="text" placeholder= "Benutzername" name="benutzername">
        <span> </span>

    </div>
        <div class="txt_field">
            <label class="label" for="passwort"></label>
            <input type="password" placeholder="Passwort" name="passwort">
            <span> </span>
        </div>
    </form>
    <button type="submit">Einloggen</button>
    <br><br>
    <p>Noch keinen Account? <br> <a href="Registrierung_Formular.php">Hier registrieren</a>
    </p>
</form>
</div>

</body>

</html>

