<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";

// Benachrichtigungen abrufen
$notificationStatement = $pdo->prepare("SELECT * FROM Benachrichtigungen WHERE empfaenger_username = ?");
$notificationStatement->execute([$_SESSION["benutzername"]]);

// E-Mail-Parameter
$empfaenger = $_SESSION["email"];
$betreff = 'Neue Benachrichtigung';


// Der Header wird mit der neuen Absender-E-Mail-Adresse erstellt
$header = 'From: ' . $absenderEmail;

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="benachrichtigungen.css">
    <title>Benachrichtigungen</title>
</head>
<body>

<div class="notification-container">

    <h1>Benachrichtigungen</h1>

<?php
// Benachrichtigungen anzeigen
while ($notification = $notificationStatement->fetch(PDO::FETCH_ASSOC)) {
    echo "<div>";
    echo "<p>Benachrichtigung: " . $notification['nachricht'] . "</p>";
    echo "<p>Von: " . $notification['absender_username'] . "</p>";
    echo "</div>";

    // E-Mail senden
    mail($empfaenger, $betreff, $notification['nachricht'], $header);
}
?>
</div>

</body>
</html>
