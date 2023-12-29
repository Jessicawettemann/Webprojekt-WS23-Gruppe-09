<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";

// Holen Sie Benachrichtigungen für den angemeldeten Benutzer
$benutzername = $_SESSION["benutzername"];
$notificationsStatement = $pdo->prepare("SELECT * FROM Benachrichtigungen WHERE benutzername = ? AND gelesen = 0");
$notificationsStatement->execute([$benutzername]);
$notifications = $notificationsStatement->fetchAll(PDO::FETCH_ASSOC);

// Markieren Sie die Benachrichtigungen als gelesen
$markAsReadStatement = $pdo->prepare("UPDATE Benachrichtigungen SET gelesen = 1 WHERE benutzername = ?");
$markAsReadStatement->execute([$benutzername]);

// Versenden von E-Mail-Benachrichtigungen
foreach ($notifications as $notification) {
    $empfaenger = $notification['email'];
    $betreff = 'Neue Benachrichtigung';
    $nachricht = 'Sie haben eine neue Benachrichtigung: ' . $notification['text'];
    
    // Senden Sie die E-Mail
    mail($empfaenger, $betreff, $nachricht);
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Benachrichtigungen</title>
    <!-- Fügen Sie hier Ihren Stylesheet-Link ein -->
</head>
<body>

<h1>Benachrichtigungen</h1>

<?php
if (count($notifications) > 0) {
    echo "<ul>";
    foreach ($notifications as $notification) {
        echo "<li>" . $notification['text'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Keine neuen Benachrichtigungen</p>";
}
?>

</body>
</html>
