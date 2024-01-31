<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Normaler Code
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
include "fehlermeldung.css";

// Überprüfen, ob das Formular abgeschickt wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Überprüfen, ob der Benutzer angemeldet ist
    if (isset($_SESSION["benutzername"])) {
        // Beitrag speichern
        $statement = $pdo->prepare("INSERT INTO Beitrag (beitrag, benutzername, profilbild) VALUES (?, ?, ?)");

        // $_SESSION["benutzername"] enthält den aktuellen Benutzernamen
        $benutzername = $_SESSION["benutzername"];

        // Das Profilbild ist in der Tabelle "Nutzer" in der Spalte "profilbild" als BLOB gespeichert
        $statementProfilbild = $pdo->prepare("SELECT profilbild FROM Nutzer WHERE benutzername = ?");
        $statementProfilbild->execute([$benutzername]);
        $profilbildRow = $statementProfilbild->fetch(PDO::FETCH_ASSOC);

        // Überprüfen, ob das Profilbild vorhanden ist, bevor Sie es verwenden
        if ($profilbildRow && isset($profilbildRow['profilbild'])) {
            $profilbild = $profilbildRow['profilbild'];
        } else {
            $profilbild = null; // Setzen Sie einen Standardwert oder NULL, falls kein Profilbild vorhanden ist
        }

        if ($statement->execute(array(htmlspecialchars($_POST["beitrag"]), $benutzername, $profilbild))) {
            // Rufe die displayMessage-Funktion auf
            include 'fehlermeldung.php';
            displayMessage("Ereignis erfolgreich gespeichert! <br><a href='community.php'>Zu den Beiträgen</a>", 'fine');

            // Benachrichtigungen für Follower erstellen
            $neuerBeitragID = $pdo->lastInsertId();

            $followerStatement = $pdo->prepare("SELECT follower_username FROM Follower WHERE followed_username = ?");
            $followerStatement->execute([$benutzername]);

            while ($follower = $followerStatement->fetch(PDO::FETCH_ASSOC)) {
                $empfaenger = $follower['follower_username'];
                $absender = $benutzername;
                $nachricht = "Neuer Beitrag von " . $benutzername;

                $benachrichtigungsStatement = $pdo->prepare("INSERT INTO Benachrichtigungen (empfaenger_username, absender_username, beitrags_id, nachricht) VALUES (?, ?, ?, ?)");
                $benachrichtigungsStatement->execute([$empfaenger, $absender, $neuerBeitragID, $nachricht]);
            }

            // Deaktiviere das Formular nach dem Absenden, um doppelte Einreichungen zu verhindern
            echo "<script>document.getElementById('communityForm').disabled = true;</script>";
        } else {
            // Rufe die displayMessage-Funktion auf
            include 'fehlermeldung.php';
            displayMessage("Fehler beim Speichern des Ereignisses. <br><a href='community.php'>Erneut versuchen</a>", 'fail');
        }
    } else {
        // Benutzer ist nicht angemeldet
        // Rufe die displayMessage-Funktion auf
        include 'fehlermeldung.php';
        displayMessage("Bitte melde dich zunächst an! <br><a href='Login Formular.php'>Hier geht's zum Login</a>", 'fail');
    }
}

?>
