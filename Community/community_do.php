<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//normaler Code
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";


// Beitrag speichern
$statement = $pdo->prepare("INSERT INTO Beitrag (beitrag, benutzername, profilbild) VALUES (?, ?, ?)");

// Annahme: $_SESSION["benutzername"] enthält den aktuellen Benutzernamen
$benutzername = $_SESSION["benutzername"];

if ($statement->execute(array(htmlspecialchars($_POST["beitrag"]), $benutzername, $profilbild))) {
    header("Location: community.php");
    exit();
} else {
    $errorInfo = $statement->errorInfo();
    die("<div class='fail'>Fehlgeschlagen. Fehlerdetails: " . implode(" ", $errorInfo) . "<br><br><a href='community.php'>Erneut versuchen</a></div>");
}


?>