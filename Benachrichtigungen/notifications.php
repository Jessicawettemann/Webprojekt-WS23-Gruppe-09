<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de" >
<head>
    <meta charset="UTF-8">
    <title>Startseite</title>
    <link rel="stylesheet" type="text/css" href="benachrichtigungen.css">
</head>
<body>
<?php
function getEmailFromDatabase($Nutzer) {
    global $pdo;

    $statement = $pdo->prepare("SELECT email FROM Nutzer WHERE benutzername =?");
    $statement->execute([$Nutzer]);

    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result['email'];
    } else {
        return 'default@example.com';
    }
}

// Benachrichtigungen abrufen
$notificationStatement = $pdo->prepare("SELECT * FROM Benachrichtigungen WHERE empfaenger_username = ? AND email_gesendet = 0");
$notificationStatement->execute([$_SESSION["benutzername"]]);

// E-Mail-Parameter
$benutzername = $_SESSION["benutzername"];

while ($notification = $notificationStatement->fetch(PDO::FETCH_ASSOC)) {
    echo "<div class='notification'>"; 
    echo "<p>Benachrichtigung: " . $notification['nachricht'] . "</p>";
    echo "<p>Von: " . $notification['absender_username'] . "</p>";
    echo "</div>";

    // E-Mail-Inhalte
    $absenderEmail = getEmailFromDatabase($notification['absender_username']);
    $empfaengerEmail = getEmailFromDatabase($notification['empfaenger_username']);
    $betreff = 'Neue Benachrichtigung';
    $nachricht = $notification['nachricht'];

    // Der Header wird mit der neuen Absender-E-Mail-Adresse erstellt
    $header = 'From: ' . $absenderEmail ='Landify';

    // E-Mail senden
    mail($empfaengerEmail, $betreff, $nachricht, $header);
    echo 'Message has been sent';

    // Markiere die Benachrichtigung als gesendet, um Doppelversand zu verhindern
    $updateNotificationStatement = $pdo->prepare("UPDATE Benachrichtigungen SET email_gesendet = 1 WHERE ID = ?");
    $updateNotificationStatement->execute([$notification['ID']]);
}
?>
</body>
</html>