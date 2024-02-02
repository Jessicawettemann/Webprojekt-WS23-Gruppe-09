<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>

    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="fehlermeldung.css">

    <title>Logout</title>

</head>
<div>

    <h2>Logout</h2>
</div>
</body>

<?php
if (!isset($_SESSION["Admin_ID"])) {
    
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Du bist nicht angemeldet. <br><a href='Login_Admin.php'>Hier geht's zum Login</a>", 'fail');

}
session_destroy();

    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Logout war erfolgreich. <br><a href='Startseite.php'>Zurück zur Startseite</a>", 'fine');

?>
</html>