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
    <title>Login Admin</title>
</head>

<body>
<form
<div class="input_container"
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
</div>
</form>

</body>

</html>

</html>



