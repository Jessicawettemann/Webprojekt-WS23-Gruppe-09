<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";

// Annahme: $_SESSION["benutzername"] enthält den aktuellen Benutzernamen
$benutzername = $_SESSION["benutzername"];

// Annahme: $_GET["followed_username"] enthält den Benutzernamen, dem nicht mehr gefolgt werden soll
$followedUsername = $_GET["followed_username"];

// Überprüfen, ob der Benutzer bereits folgt
$checkStatement = $pdo->prepare("SELECT * FROM Follower WHERE follower_username = ? AND followed_username = ?");
$checkStatement->execute([$benutzername, $followedUsername]);

if ($checkStatement->rowCount() > 0) {
    // Der Benutzer folgt, entferne ihn
    $deleteStatement = $pdo->prepare("DELETE FROM Follower WHERE follower_username = ? AND followed_username = ?");
    $deleteStatement->execute([$benutzername, $followedUsername]);
    echo "Du folgst nicht mehr " . $followedUsername;
} else {
    // Der Benutzer folgt nicht
    echo "Du folgst nicht " . $followedUsername;
}
?>
