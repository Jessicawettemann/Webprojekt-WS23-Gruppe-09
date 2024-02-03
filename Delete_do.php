<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="fehlermeldung.css">
</head>
<?php
include "Header Sicherheit.php";
include "Datenbank Verbindung.php";
session_start();
?>

<?php

if (!isset($_SESSION["admin"])) {#prüft, ob Admin eingeloggt ist
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Du musst als Admin eingeloggt sein, um Angebote aus der Datenbank löschen zu können. <br><a href='Login_Admin.php'>Hier geht's zum Admin-Login/a>", 'fail');
    
}


// Stellen Sie sicher, dass eine Beitrags-ID vorhanden ist
if (isset($_GET['id'])) {
    $chosenAngebot = $_GET['id'];

    // Löschen Sie den Beitrag aus der Datenbank
    $statement=$pdo->prepare("DELETE FROM Upload WHERE ID=:chosenAngebot");
    $statement->execute(['chosenSong' => $chosenAngebot]);

    // Umleiten Sie den Benutzer zur Übersichtsseite
    header('Location: ich-biete_Übersicht.php');
    exit();

} else {
    // Wenn keine Beitrags-ID vorhanden ist, zeigen Sie eine Fehlermeldung an
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Keine Beitrags-ID vorhanden. <br>", 'fail');
}
?>