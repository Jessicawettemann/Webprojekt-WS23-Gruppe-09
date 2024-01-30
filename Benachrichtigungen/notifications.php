<?php
// Start der Session am Anfang des Skripts
session_start();

// Einbinden der erforderlichen Dateien
include "Datenbank_Verbindung.php"; // Achten Sie darauf, dass Leerzeichen in Dateinamen vermieden werden
include "Header_Sicherheit.php";

// Überprüfen, ob der Benutzername in der Session gesetzt ist
if (!isset($_SESSION["benutzername"])) {
    // Umleitung auf eine andere Seite oder Fehlerbehandlung
    exit("Benutzer nicht angemeldet.");
}

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

function getEmailFromDatabase($pdo, $Nutzer) {
    $statement = $pdo->prepare("SELECT email FROM Nutzer WHERE benutzername = :benutzername");
    $statement->execute(['benutzername' => $Nutzer]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result ? $result['email'] : 'default@example.com';
}

// Benachrichtigungen abrufen
$notificationStatement = $pdo->prepare("SELECT * FROM Benachrichtigungen WHERE empfaenger_username = :benutzername AND email_gesendet = 0");
$notificationStatement->execute(['benutzername' => $_SESSION["benutzername"]]);

while ($notification = $notificationStatement->fetch(PDO::FETCH_ASSOC)) {
    // Escape von Output für HTML
    $nachricht = htmlspecialchars($notification['nachricht']);
    $absender = htmlspecialchars($notification['absender_username']);

    echo "<div class='notification'>"; 
    echo "<p>Benachrichtigung: " . $nachricht . "</p>";
    echo "<p>Von: " . $absender . "</p>";
    echo "</div>";

    // E-Mail-Parameter
    $absenderEmail = getEmailFromDatabase($pdo, $notification['absender_username']);
    $empfaengerEmail = getEmailFromDatabase($pdo, $notification['empfaenger_username']);
    $betreff = 'Neue Benachrichtigung';
    
    // Der Header wird mit der Absender-E-Mail-Adresse erstellt
    $header = 'From: ' . $absenderEmail;

    // E-Mail senden
    if(mail($empfaengerEmail, $betreff, $nachricht, $header)){
        echo 'Message has been sent';

        // Markiere die Benachrichtigung als gesendet, um Doppelversand zu verhindern
        $updateNotificationStatement = $pdo->prepare("UPDATE Benachrichtigungen SET email_gesendet = 1 WHERE ID = :id");
        $updateNotificationStatement->execute(['id' => $notification['ID']]);
    } else {
        echo 'Message could not be sent';
    }
}
?>
</body>
</html>