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
// Admin kann diese Funktion nur nutzen
if (!isset($_SESSION["admin"])) {
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Diese Funktion steht nur den Admins zu. <br><a href='Login_Admin.php'>Hier geht's zum Admin-Login</a>", 'fail');
}

// Stellen Sie sicher, dass eine Beitrags-ID vorhanden ist
if (isset($_GET['id'])) {
    $chosenSong = $_GET['id'];

    // Löschen Sie den Beitrag aus der Datenbank
    $statement=$pdo->prepare("DELETE FROM Upload WHERE ID=:chosenSong");
    $statement->execute(['chosenSong' => $chosenSong]);

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