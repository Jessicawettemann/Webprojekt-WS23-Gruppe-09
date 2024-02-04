<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";

// Überprüfen, ob das Formular abgeschickt wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Den Benutzernamen des gefolgten Benutzers aus dem Formular holen und verarbeiten
    $followedUsername = htmlspecialchars($_POST["followed_username"]);

    // Überprüfung, ob der Benutzer bereits folgt
    $checkStatement = $pdo->prepare("SELECT * FROM Follower WHERE follower_username = ? AND followed_username = ?");
    $checkStatement->execute([$_SESSION["benutzername"], $followedUsername]);

    // Wenn der Benutzer bereits folgt, entferne den Eintrag
    if ($checkStatement->rowCount() > 0) {
        // Vorbereiten der SQL-Abfrage zum Löschen des Eintrags
        $deleteStatement = $pdo->prepare("DELETE FROM Follower WHERE follower_username = ? AND followed_username = ?");
        // Ausführen der vorbereiteten Abfrage, indem die Parameter eingesetzt werden
        $deleteStatement->execute([$_SESSION["benutzername"], $followedUsername]);
    }
}

// Zurück zur vorherigen Seite oder einer anderen Weiterleitungsseite
header("Location: " . $_SERVER["HTTP_REFERER"]);
// Beendet das Skript, um sicherzustellen, dass keine weiteren Anweisungen ausgeführt werden
exit();
?>
