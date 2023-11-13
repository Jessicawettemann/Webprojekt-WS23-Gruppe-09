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

        <div class="input_container"
        <form action=" /Login/Login%20Do.php" method="post">

            <label class="label" for="benutzername"></label>
            <input type="text" placeholder= "Benutzername" name="benutzername">

            <label class="label" for="passwort"></label>
            <input type="password" placeholder="Passwort" name="passwort">

            <button type="submit">Einloggen</button>
            <br><br>
            <p>Noch keinen Account? <br> <a href="../Registrierung%20Neu/Registrierung_Formular.php">Hier registrieren</a>
            </p>
        </form>
        </div>
    </form>
</body>
