<?php
// Einbinden der erforderlichen Dateien
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();

if (isset($_POST["add_friend"])) {
    // Fügt eine neue Zeile in die Follower-Tabelle ein
    $statement = $pdo->prepare("INSERT INTO Follower (follower_username, followed_username) VALUES (:follower_username, :followed_username)");
    $statement->bindParam(":follower_username", $_SESSION["username"]);
    $statement->bindParam(":followed_username", $_POST["user_id_friend"]);
    $statement->execute();

    // E-Mail-Benachrichtigung vorbereiten
    $subject = "Ein neuer Nutzer folgt dir nun!";
    $message = "Der Nutzer " . $_SESSION['username'] . " folgt dir nun";
    $headers = "From: fb106@hdm-stuttgart.de";

    // Abrufen der E-Mail-Adresse des Freundes
    $getNutzerDaten = $pdo->prepare("SELECT email FROM Nutzer WHERE benutzername = :benutzername");
    $getNutzerDaten->bindParam(":benutzername", $_POST["user_id_friend"]);
    $getNutzerDaten->execute();
    $NutzerDaten = $getNutzerDaten->fetch(PDO::FETCH_ASSOC);

    if ($NutzerDaten) {
        $friendsemail = $NutzerDaten["email"];

        // E-Mail senden
        mail($friendsemail, $subject, $message, $headers);

        // Benachrichtigung in der Datenbank speichern
        $insertNotification = $pdo->prepare("INSERT INTO Benachrichtigungen (empfaenger_username, absender_username, nachricht, gelesen) VALUES (:empfaenger_username, :absender_username, :nachricht, 0)");
        $insertNotification->bindParam(":empfaenger_username", $_POST["user_id_friend"]);
        $insertNotification->bindParam(":absender_username", $_SESSION["username"]);
        $insertNotification->bindParam(":nachricht", $message);
        $insertNotification->execute();
    }
}
?>