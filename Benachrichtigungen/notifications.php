<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";

// Benachrichtigungen abrufen
$notificationStatement = $pdo->prepare("SELECT * FROM Benachrichtigungen WHERE empfaenger_username = ?");
$notificationStatement->execute([$_SESSION["benutzername"]]);

// E-Mail-Parameter für den externen SMTP-Dienst
$betreff = 'Neue Benachrichtigung';

// Konfigurieren Sie die Zugangsdaten für den externen SMTP-Dienst
$smtpHost = 'Ihr_SMTP_Host';
$smtpPort = 'Ihr_SMTP_Port';
$smtpUsername = 'Ihr_SMTP_Benutzername';
$smtpPassword = 'Ihr_SMTP_Passwort';

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css">
    <title>Benachrichtigungen</title>
</head>
<body>

<h1>Benachrichtigungen</h1>

<?php
// Beiträge von Nutzern abrufen, denen der angemeldete Benutzer folgt
$followedUsersStatement = $pdo->prepare("SELECT followed_username FROM Follower WHERE follower_username = ?");
$followedUsersStatement->execute([$_SESSION["benutzername"]]);

while ($followedUser = $followedUsersStatement->fetch(PDO::FETCH_ASSOC)) {
    // Beiträge des gefolgten Nutzers abrufen
    $postStatement = $pdo->prepare("SELECT * FROM Beitrag WHERE benutzername = ?");
    $postStatement->execute([$followedUser['followed_username']]);

    // Benachrichtigung anzeigen und E-Mail senden
    while ($post = $postStatement->fetch(PDO::FETCH_ASSOC)) {
        echo "<div>";
        echo "<p>Benachrichtigung: Neuer Beitrag von " . $followedUser['followed_username'] . "</p>";
        echo "<p>Inhalt: " . $post['beitrag'] . "</p>";
        echo "</div>";

        // E-Mail senden über den externen SMTP-Dienst
        $empfaenger = $_SESSION["email"]; // E-Mail-Adresse des angemeldeten Benutzers
        $headers = "From: webmaster@example.com\r\n";
        $headers .= "Reply-To: webmaster@example.com\r\n";

        mail($empfaenger, $betreff, "Neuer Beitrag von " . $followedUser['followed_username'] . ": " . $post['beitrag'], $headers);
    }
}

// Benachrichtigungen anzeigen
while ($notification = $notificationStatement->fetch(PDO::FETCH_ASSOC)) {
    echo "<div>";
    echo "<p>Benachrichtigung: " . $notification['nachricht'] . "</p>";
    echo "<p>Von: " . $notification['absender_username'] . "</p>";
    echo "</div>";
}
?>

</body>
</html>
