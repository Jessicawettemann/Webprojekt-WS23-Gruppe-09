<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";

// Überprüfen, ob das Formular abgeschickt wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $followedUsername = htmlspecialchars($_POST["followed_username"]);

    // Überprüfen, ob der Benutzer bereits folgt
    $checkStatement = $pdo->prepare("SELECT * FROM Follower WHERE follower_username = ? AND followed_username = ?");
    $checkStatement->execute([$_SESSION["benutzername"], $followedUsername]);

    if ($checkStatement->rowCount() == 0) {
        // Der Benutzer folgt noch nicht, füge den Eintrag hinzu
        $insertStatement = $pdo->prepare("INSERT INTO Follower (follower_username, followed_username) VALUES (?, ?)");
        $insertStatement->execute([$_SESSION["benutzername"], $followedUsername]);
    }
}

// Zurück zur vorherigen Seite oder einer anderen Weiterleitungsseite
header("Location: " . $_SERVER["HTTP_REFERER"]);
exit();
?>
