<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "Datenbank Verbindung.php";
include "Header Sicherheit.php";

function sendNotificationsAndEmails($pdo, $beitragErsteller, $neuerBeitragID) {
    $nutzerStatement = $pdo->prepare("SELECT benutzername, email FROM Nutzer");
    $nutzerStatement->execute();

    while ($nutzer = $nutzerStatement->fetch()) {
        $benachrichtigungsStatement = $pdo->prepare("INSERT INTO Benachrichtigungen (empfaenger_username, absender_username, beitrags_id, nachricht, email_gesendet) VALUES (?, ?, ?, ?, 0)");
        $benachrichtigungsStatement->execute([$nutzer['benutzername'], $beitragErsteller, $neuerBeitragID, "Neuer Beitrag veröffentlicht"]);

        if ($nutzer['email']) {
            $betreff = "Neuer Beitrag von $beitragErsteller";
            $nachricht = "Ein neuer Beitrag wurde veröffentlicht. Beitrag-ID: $neuerBeitragID";
            $header = "From: info@ihrewebseite.de";
            mail($nutzer['email'], $betreff, $nachricht, $header);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="fehlermeldung.css">
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["benutzername"])) {
        $statement = $pdo->prepare("INSERT INTO Beitrag (beitrag, benutzername, profilbild) VALUES (?, ?, ?)");
        $benutzername = $_SESSION["benutzername"];

        $statementProfilbild = $pdo->prepare("SELECT profilbild FROM Nutzer WHERE benutzername = ?");
        $statementProfilbild->execute([$benutzername]);
        $profilbildRow = $statementProfilbild->fetch(PDO::FETCH_ASSOC);
        $profilbild = $profilbildRow && isset($profilbildRow['profilbild']) ? $profilbildRow['profilbild'] : null;

        if ($statement->execute(array(htmlspecialchars($_POST["beitrag"]), $benutzername, $profilbild))) {
            include 'fehlermeldung.php';
            displayMessage("Ereignis erfolgreich gespeichert! <br><a href='community.php'>Zu den Beiträgen</a>", 'fine');

            $neuerBeitragID = $pdo->lastInsertId();
            sendNotificationsAndEmails($pdo, $benutzername, $neuerBeitragID);

            echo "<script>document.getElementById('communityForm').disabled = true;</script>";
        } else {
            include 'fehlermeldung.php';
            displayMessage("Fehler beim Speichern des Ereignisses. <br><a href='community.php'>Erneut versuchen</a>", 'fail');
        }
    } else {
        include 'fehlermeldung.php';
        displayMessage("Bitte melde dich zunächst an! <br><a href='Login Formular.php'>Hier geht's zum Login</a>", 'fail');
    }
}
?>
</body>
</html>