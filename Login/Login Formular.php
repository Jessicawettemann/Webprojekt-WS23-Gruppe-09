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
        <label for="username">Benutzername:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Passwort:</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit">Absenden</button>
    </form>
</body>
