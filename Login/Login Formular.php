<?php
include"Datenbank Verbindung.php";

session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Login Formular</title>
</head>
<body>
    <h1>Login</h1>
    <form action="Login Do.php" method="post">
        <label for="benutzername">Benutzername:</label>
        <input type="text" id="benutzername" name="benutzername" required><br>

        <label for="passwort">Passwort:</label>
        <input type="passwort" id="passwort" name="passwort" required><br>

        <button type="submit">Absenden</button>
    </form>
</body>
