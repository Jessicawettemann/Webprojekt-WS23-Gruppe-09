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
    <title>Angebote löschen</title>
</head>
<body>
<?php
if(!isset($_SESSION["Nutzer_ID"])) { #prüft, ob User eingeloggt ist
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Du musst eingeloggt sein, um deine Angebote löschen zu können. <br><a href='Login Formular.php'>Hier geht's zum Login</a>", 'fail');
}
if(isset($_GET["Ich_biete_ID"])){
    $statement=$pdo->prepare("DELETE FROM Ich_biete WHERE ID=?");
    if($statement->execute(array($_GET["ID"]))){

        //displayMessage-Funktion
        include 'fehlermeldung.php';
        displayMessage("Angebot wurde erfolgreich gelöscht. <br>", 'fine');

    }else{
        //displayMessage-Funktion
        include 'fehlermeldung.php';
        displayMessage("Datenbank-Fehler. <br>", 'fail');
    }
}
?>
<a class="back" href="ich-biete_Übersicht.php"> zu den Angeboten </a>
</body>
</html>
