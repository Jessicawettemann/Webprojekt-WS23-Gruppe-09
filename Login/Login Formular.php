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

<body>
<form
<div class="input_container"
<form action="Login%20Do.php" method="post">
    <h1> Login</h1>
    <label class="label" for="benutzername"></label>
    <input type="text" placeholder= "Benutzername" name="benutzername">

    <label class="label" for="passwort"></label>
    <input type="password" placeholder="Passwort" name="passwort">

    <button type="submit">Einloggen</button>
    <br><br>
    <p>Noch keinen Account? <br><br> <a href="Registrierung_Formular.php">Hier registrieren</a>
    </p>
</form>
</div>
</form>

</body>

</html>

</html>

