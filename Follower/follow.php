<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";

// Überprüfen, ob das Formular abgeschickt wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Annahme: $_POST["followed_username"] enthält den Benutzernamen, dem gefolgt werden soll
    $followedUsername = htmlspecialchars($_POST["followed_username"]);

    // Überprüfen, ob der Benutzer bereits folgt
    $checkStatement = $pdo->prepare("SELECT * FROM Follower WHERE follower_username = ? AND followed_username = ?");
    $checkStatement->execute([$_SESSION["benutzername"], $followedUsername]);

    if ($checkStatement->rowCount() == 0) {
        // Der Benutzer folgt noch nicht, füge ihn hinzu
        $insertStatement = $pdo->prepare("INSERT INTO Follower (follower_username, followed_username) VALUES (?, ?)");
        $insertStatement->execute([$_SESSION["benutzername"], $followedUsername]);
        echo "Du folgst jetzt " . $followedUsername;
    } else {
        // Der Benutzer folgt bereits
        echo "Du folgst bereits " . $followedUsername;
    }
}
?>
