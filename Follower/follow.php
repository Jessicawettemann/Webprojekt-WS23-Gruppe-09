<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";

// Annahme: $_SESSION["benutzername"] enthält den aktuellen Benutzernamen
$benutzername = $_SESSION["benutzername"];

// Annahme: $_GET["followed_username"] enthält den Benutzernamen, dem gefolgt werden soll
$followedUsername = $_GET["followed_username"];

// Überprüfen, ob der Benutzer bereits folgt
$checkStatement = $pdo->prepare("SELECT * FROM Follower WHERE follower_username = ? AND followed_username = ?");
$checkStatement->execute([$benutzername, $followedUsername]);

if ($checkStatement->rowCount() == 0) {
    // Der Benutzer folgt noch nicht, füge ihn hinzu
    $insertStatement = $pdo->prepare("INSERT INTO Follower (follower_username, followed_username) VALUES (?, ?)");
    $insertStatement->execute([$benutzername, $followedUsername]);
    echo "Du folgst jetzt " . $followedUsername;
} else {
    // Der Benutzer folgt bereits
    echo "Du folgst bereits " . $followedUsername;
}
?>
