<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
?>

<!DOCTYPE html>
<html lang="de">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="fehlermeldung.css">




</head>
<body>
<div>


</div>
</body>

<?php
if (!isset($_SESSION["Nutzer_ID"])) {
     //displayMessage-Funktion
     include 'fehlermeldung.php';
     displayMessage("Du bist nicht angemeldet. <br><a href='Login Formular.php'>Hier geht's zum Login</a>", 'fail');
}

session_destroy();
     //displayMessage-Funktion
     include 'fehlermeldung.php';
     displayMessage("Logout war erfolgreich. <br><a href='Startseite.php'>Zurück zur Startseite</a>", 'fine');
    
?>

