<?php
include"Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="Logout.css">
    <title>Logout</title>
</head>
<br><br><br><br>
<body>
<div>
<br<br><br>
    <h2>Logout</h2>
    <br><br>
</div>

<?php
if (!isset($_SESSION["Nutzer_ID"])){ //Überprüfen, ob Nutzer angemeldet ist und Zugriff hat
    die("<div class='fail'> Du bist nicht angemeldet.</div>.<br>.<a href='Login Formular.php'>Klicke hier</a>, um dich anzumelden");
}
?>



<p class="logout_text">Möchtest du dich wirklich ausloggen?</p><br>
<div class="logout">
    <form action="logout_do.php" method="post">
        <button class="logout_button" type="submit">Ja</button>
    </form>

</div>

</body>
</html>
