<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
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
// Annahme: Der Benutzer ist bereits angemeldet, und $_SESSION["benutzername"] enthält seinen Benutzernamen
$benutzername = $_SESSION["benutzername"];

// Lade ungelesene Benachrichtigungen für den Benutzer
$benachrichtigungenStatement = $pdo->prepare("SELECT * FROM Benachrichtigungen WHERE empfaenger_username = ? AND gelesen = 0");
$benachrichtigungenStatement->execute([$benutzername]);

// Markiere gelesene Benachrichtigungen als gelesen
$markiereAlsGelesenStatement = $pdo->prepare("UPDATE Benachrichtigungen SET gelesen = 1 WHERE empfaenger_username = ?");
$markiereAlsGelesenStatement->execute([$benutzername]);

// Anzeige der Benachrichtigungen
while ($benachrichtigung = $benachrichtigungenStatement->fetch(PDO::FETCH_ASSOC)) {
    echo "<p>" . $benachrichtigung['nachricht'] . "</p>";
}

?>

</body>
</html>
