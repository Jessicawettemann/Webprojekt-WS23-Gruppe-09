<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "Datenbank Verbindung.php";
include "Header Sicherheit.php";

function sendNotificationsAndEmails($pdo, $beitragErsteller, $neuerBeitragID) { // Definierung der Funktion (Benutzername des Erstellers u. ID des Beitrags)
    $nutzerStatement = $pdo->prepare("SELECT benutzername, email FROM Nutzer"); // Vorbereitung Abfrage ( Alle Benutzernamen u. Emails der Tabelle Nutzer)
    $nutzerStatement->execute(); // Abfrage ausführen 

    while ($nutzer = $nutzerStatement->fetch()) { // Durchlaufen der while Schleife (für jeden Nutzer der Tabelle Nutzer)
        $benachrichtigungsStatement = $pdo->prepare("INSERT INTO Benachrichtigungen (empfaenger_username, absender_username, beitrags_id, nachricht, email_gesendet) VALUES (?, ?, ?, ?, 0)");  // Vorbereitung Abfrage (Einfügen der Benachrichtigung in Tabelle / email_gesendet auf 0 d.h. noch nicht gesendet)
        $benachrichtigungsStatement->execute([$nutzer['benutzername'], $beitragErsteller, $neuerBeitragID, "Neuer Beitrag veröffentlicht"]); // Abfrage wird ausgeführt ( Werte werden eingesetzt) -> Nachricht an alle Nutzer

        if ($nutzer['email']) {  // prüft ob Email vorhanden 
            $betreff = "Neuer Beitrag von $beitragErsteller"; // Betreff wird festgelegt (Namen Beitragsersteller)
            $nachricht = "Ein neuer Beitrag wurde veröffentlicht. Beitrag-ID: $neuerBeitragID"; // Inhalt wird festgelegt (Mit ID des neuen Beitrags)
            $header = "From: info@landify.de"; // Absender wird festgelegt (Absenderemail)
            mail($nutzer['email'], $betreff, $nachricht, $header); // Versand der Email an Nutzer
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

            $neuerBeitragID = $pdo->lastInsertId(); // Zieht die ID des letzten Beitrags (Methode die den letzten Beitrag zurückgibt)
            sendNotificationsAndEmails($pdo, $benutzername, $neuerBeitragID); // Erstellen der Benachrichtigung     => Aufruf der obigen Funktion nach erstellung des Beitrags

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