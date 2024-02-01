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
function getEmailFromDatabase($pdo, $Nutzer) {
    $statement = $pdo->prepare("SELECT email FROM Nutzer WHERE benutzername = ?");
    $statement->execute([$Nutzer]);
    $result = $statement->fetch();

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
        $betreff = 'Es wurde auf Landify ein neuer Beitrag veröffentlicht!';
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
$notificationQuery= "SELECT Benachrichtigungen.*, Beitrag.datum AS beitrag_datum FROM Benachrichtigungen JOIN Beitrag ON Benachrichtigungen.beitrags_id = Beitrag.ID WHERE Benachrichtigungen.empfaenger_username = ? ORDER BY datum DESC";

$notificationStatement = $pdo->prepare($notificationQuery);
$notificationStatement->execute([$_SESSION["benutzername"]]);

while ($notification = $notificationStatement->fetch()) {
echo "<div class='notification'>"; 
echo "<p>Benachrichtigung: Neuer Beitrag </p>";
echo "<p>Datum des Beitrags: " . $notification['beitrag_datum'] . "</p>"; // Hier wird das  Datum des Beitrags hinzufügt (Aus der Datenbank)
echo "<p>Von: " . $notification['absender_username'] . "</p>"; // Hier wird der Username des Absenders bspw. fb106 hinzugefügt (Aus der Datenbank)
echo "</div>";
}
?>
</body>
</html>