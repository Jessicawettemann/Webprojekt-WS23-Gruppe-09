<?php
include "Datenbank Verbindung.php"; 
include "Header Sicherheit.php";
session_start();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Startseite</title>
    <link rel="stylesheet" type="text/css" href="benachrichtigungen.css"> 
</head>
<body>

<?php
function getEmailFromDatabase($pdo, $Nutzer) {    // Definierung der Funktion, um die E-Mail-Adresse des Nutzers aus der Datenbank zu bekommen
    $statement = $pdo->prepare("SELECT email FROM Nutzer WHERE benutzername = ?");   // SQL-Abfrage vorbereiten
    $statement->execute([$Nutzer]);    // Starten der Abfrage mit Nutzer
    $result = $statement->fetch();    // Ergebnisse der Abfrage abrufen
    return $result;   //Rückgabe der Email -> Keine Fehlermeldung nötig, da Email verpflichtend für Anmeldung 
}
// Anzeigen der Benachrichtigungen, unabhängig davon, ob die E-Mail gesendet wurde oder nicht
$notificationStatement = $pdo->prepare("SELECT Benachrichtigungen.*, Beitrag.datum AS beitrag_datum FROM Benachrichtigungen JOIN Beitrag ON Benachrichtigungen.beitrags_id = Beitrag.ID WHERE Benachrichtigungen.empfaenger_username = ? ORDER BY datum DESC");  // Vorbereitung Abfrage (JOIN verbindet Tabelle aus Datenbank)
$notificationStatement->execute([$_SESSION["benutzername"]]); // Ausführung Abfrage auf Basis des Benutzernamens

while ($notification = $notificationStatement->fetch()) { // Ausgabe der Benachrichtigung
echo "<div class='notification'>"; // Erstellung eines Div- Elements mit der Klasse notification
echo "<p>Benachrichtigung: Neuer Beitrag </p>";
echo "<p>Datum des Beitrags: " . $notification['beitrag_datum'] . "</p>"; // Hier wird das  Datum des Beitrags hinzufügt (Aus der Datenbank)
echo "<p>Von: " . $notification['absender_username'] . "</p>"; // Hier wird der Username des Absenders bspw. fb106 hinzugefügt (Aus der Datenbank)
echo "</div>";
}
?>
</body>
</html>


