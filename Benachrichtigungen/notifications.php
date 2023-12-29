<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";

// Benachrichtigungen abrufen
$notificationStatement = $pdo->prepare("SELECT * FROM Benachrichtigungen WHERE empfaenger_username = ?");
$notificationStatement->execute([$_SESSION["benutzername"]]);

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
