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
    <link rel="stylesheet" type="text/css" href="Formulare.css">

</head>
<body>


<form action="Login_Admin_do.php" method="post">
    <h1> Login Admin</h1>
    <label class="label" for="benutzername"></label>
    <input type="text" placeholder= "Benutzername" name="benutzername">

    <label class="label" for="passwort"></label>
    <input type="password" placeholder="Passwort" name="passwort">

    <button type="submit">Einloggen</button>
    <br><br>
     <a href="Startseite.php">Zum Start</a>
    </p>
</form>





</body>
</html>

