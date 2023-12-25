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

// Annahme: Das Profilbild ist in der Tabelle "Nutzer" in der Spalte "profilbild" als BLOB gespeichert
$statementProfilbild = $pdo->prepare("SELECT profilbild FROM Nutzer WHERE benutzername = ?");
$statementProfilbild->execute([$benutzername]);
$profilbildRow = $statementProfilbild->fetch(PDO::FETCH_ASSOC);

// Überprüfen, ob das Profilbild vorhanden ist, bevor Sie es verwenden
if ($profilbildRow && isset($profilbildRow['profilbild'])) {
    $profilbild = $profilbildRow['profilbild'];
} else {
    $profilbild = null; // Setzen Sie einen Standardwert oder NULL, falls kein Profilbild vorhanden ist
}


if ($statement->execute(array(htmlspecialchars($_POST["beitrag"]), $benutzername, $profilbild))) {
    echo "<div class='fine'> Ereignis gespeichert </div>". "<br><br>" . "<a href='community.php'>Zu den Beiträgen</a> </div>";
} else {
    die("<div class='fail'> Fehlgeschlagen." . "<br><br>" . "<a href='community.php'>Erneut versuchen</a> </div>");
}


?>