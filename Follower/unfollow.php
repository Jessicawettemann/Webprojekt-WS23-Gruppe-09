<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";

// Überprüfen, ob das Formular abgeschickt wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Annahme: $_POST["followed_username"] enthält den Benutzernamen, dem nicht mehr gefolgt werden soll
    $followedUsername = htmlspecialchars($_POST["followed_username"]);

    // Überprüfen, ob der Benutzer bereits folgt
    $checkStatement = $pdo->prepare("SELECT * FROM Follower WHERE follower_username = ? AND followed_username = ?");
    $checkStatement->execute([$_SESSION["benutzername"], $followedUsername]);

    if ($checkStatement->rowCount() > 0) {
        // Der Benutzer folgt, entferne ihn
        $deleteStatement = $pdo->prepare("DELETE FROM Follower WHERE follower_username = ? AND followed_username = ?");
        $deleteStatement->execute([$_SESSION["benutzername"], $followedUsername]);
        echo "Du folgst nicht mehr " . $followedUsername;
    } else {
        // Der Benutzer folgt nicht
        echo "Du folgst nicht " . $followedUsername;
    }
}
?>
