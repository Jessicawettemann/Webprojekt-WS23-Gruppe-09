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
// Überprüfen, ob das Formular über die POST-Methode gesendet wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_SESSION["benutzername"])) {
        $statement = $pdo->prepare("INSERT INTO Beitrag (beitrag, benutzername, profilbild) VALUES (?, ?, ?)"); //Vorbereitung SQL-Abfrage
        $benutzername = $_SESSION["benutzername"];

        // Vorbereitung der SQL-Abfrage zum Abrufen des Profilbilds des Benutzers
        $statementProfilbild = $pdo->prepare("SELECT profilbild FROM Nutzer WHERE benutzername = ?");
        $statementProfilbild->execute([$benutzername]);
        $profilbildRow = $statementProfilbild->fetch(PDO::FETCH_ASSOC); // Abrufen des Ergebnisses der Profilbild-Abfrage

        // Prüfen, ob ein Profilbild vorhanden ist, andernfalls auf null setzen
        $profilbild = $profilbildRow && isset($profilbildRow['profilbild']) ? $profilbildRow['profilbild'] : null;

        // Ausführen der SQL-Abfrage zum Einfügen des neuen Beitrags in die Datenbank
        if ($statement->execute(array(htmlspecialchars($_POST["beitrag"]), $benutzername, $profilbild))) {
            
            //displaymessage Funktion
            include 'fehlermeldung.php';
            displayMessage("Ereignis erfolgreich gespeichert! <br><a href='community.php'>Zu den Beiträgen</a>", 'fine');

            
            // Ziehen der ID des letzten Beitrags (Methode, die die letzte eingefügte ID zurückgibt)
            $neuerBeitragID = $pdo->lastInsertId();

            // Erstellen von Benachrichtigungen und E-Mails nach dem Hinzufügen des Beitrags
            sendNotificationsAndEmails($pdo, $benutzername, $neuerBeitragID);

            // Deaktivieren des Formulars mit JavaScript
            echo "<script>document.getElementById('communityForm').disabled = true;</script>";
       
       
        } else {
            // displayMessage-Funktion
            include 'fehlermeldung.php';
            displayMessage("Fehler beim Speichern des Ereignisses. <br><a href='community.php'>Erneut versuchen</a>", 'fail');
        }
    } else {
        // displayMessage-Funktion
        include 'fehlermeldung.php';
        displayMessage("Bitte melde dich zunächst an! <br><a href='Login Formular.php'>Hier geht's zum Login</a>", 'fail');
    }
}
?>

</body>
</html>