<?php
include"Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>

    <link rel="stylesheet" href="Formulare.css">
</head>
<body>


<form action="Login_Admin_do.php" method="post">
    <h2>Admin-Login</h2>
    <input type="text" placeholder="admin" name="admin">

    <input type="password" placeholder="Passwort" name="password">
    <br>
    <button type="submit">Einloggen</button>
    <br><br>
    <a href="Startseite.php"> zurück zum Start </a>
</form>
</div>




</body>
</html>

