<?php
include "Header Sicherheit.php";
include "Datenbank Verbindung.php";
session_start();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="fehlermeldung.css">
</head>

<?php

if (!isset($_SESSION["admin"])) {  //prüft ob der Admin eingeloggt ist
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Du musst als Admin eingeloggt sein, um Angebote aus der Datenbank löschen zu können. <br><a href='Login_Admin.php'>Hier geht's zum Admin-Login/a>", 'fail');
    
}


// Stellt sicher ob eine Beitrags-ID vorhanden ist
if (isset($_GET['id'])) {
    $chosenAngebot = $_GET['id'];

    // Löschen des Beitrags aus der Datenbank
    $statement=$pdo->prepare("DELETE FROM Upload WHERE ID=:chosenAngebot");
    $statement->execute(['chosenAngebot' => $chosenAngebot]);

    // Umleitung des Benutzers zur Übersichtsseite
    header('Location: ich-biete_Übersicht.php');
    exit();

} else {
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Keine Beitrags-ID vorhanden. <br>", 'fail');
}
?>