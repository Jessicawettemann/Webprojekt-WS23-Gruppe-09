<?php
include "Datenbank Verbindung.php"; // Stellen Sie sicher, dass diese die korrekte Verbindung herstellt
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
function getEmailFromDatabase($pdo, $Nutzer) {
    $statement = $pdo->prepare("SELECT email FROM Nutzer WHERE benutzername = ?");
    $statement->execute([$Nutzer]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result ? $result['email'] : 'default@example.com';
}

// E-Mail-Versand für ausstehende Benachrichtigungen
$notificationStatement = $pdo->prepare("SELECT * FROM Benachrichtigungen WHERE email_gesendet = 0");
if (!$notificationStatement->execute()) {
    echo "Fehler bei der Datenbankabfrage.";
} else {
    while ($notification = $notificationStatement->fetch(PDO::FETCH_ASSOC)) {
        $absenderEmail = getEmailFromDatabase($pdo, $notification['absender_username']);
        $empfaengerEmail = getEmailFromDatabase($pdo, $notification['empfaenger_username']);
        $betreff = 'Es wurde ein neuer Beitrag veröffentlicht!';
        $nachricht = $notification['nachricht'];
        $header = 'From:' . ($absenderEmail);

        if (!mail($empfaengerEmail, $betreff, $nachricht, $header)) {
            echo "Fehler beim Senden der E-Mail.";
        } else {
            $updateNotificationStatement = $pdo->prepare("UPDATE Benachrichtigungen SET email_gesendet = 1 WHERE ID = ?");
            if (!$updateNotificationStatement->execute([$notification['ID']])) {
                echo "Fehler beim Aktualisieren der Datenbank.";
            }
        }
    }
}
// Anzeigen der Benachrichtigungen, unabhängig davon, ob die E-Mail gesendet wurde oder nicht
$notificationQuery= "SELECT Benachrichtigungen.*, Beitrag.datum AS beitrag_datum FROM Benachrichtigungen JOIN Beitrag ON Benachrichtigungen.beitrags_id = Beitrag.ID WHERE Benachrichtigungen.empfaenger_username = ?";

$notificationStatement = $pdo->prepare($notificationQuery);
$notificationStatement->execute([$_SESSION["benutzername"]]);

while ($notification = $notificationStatement->fetch(PDO::FETCH_ASSOC)) {
echo "<div class='notification'>"; // Änderung hier, um die Klasse hinzuzufügen
echo "<p>Datum des Beitrags: " . $notification['beitrag_datum'] . "</p>"; // Hier das Datum des Beitrags hinzufügen
echo "<p>Benachrichtigung: " . $notification['nachricht'] . "</p>";
echo "<p>Von: " . $notification['absender_username'] . "</p>";

// Hier das Datum der Benachrichtigung hinzufügen (falls vorhanden)
echo "<p>Datum der Benachrichtigung: " . $notification['datum'] . "</p>";
}
?>
</body>
</html>