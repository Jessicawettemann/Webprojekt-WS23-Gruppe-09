<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="fehlermeldung.css">
</head>
<body>

<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";

// Überprüfung, ob der Benutzer NICHT angemeldet ist
if (!isset($_SESSION["Nutzer_ID"])){
    // displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Bitte melde dich zunächst an. <br><a href='Login Formular.php'>Hier geht's zum Login</a>", 'fail');
} else {
    // Überprüfung, ob das Formular abgeschickt wurde
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Den Benutzernamen des gefolgten Benutzers aus dem Formular holen
        $followedUsername = htmlspecialchars($_POST["followed_username"]);

        // Überprüfen, ob der Benutzer bereits folgt
        $checkStatement = $pdo->prepare("SELECT * FROM Follower WHERE follower_username = ? AND followed_username = ?");
        $checkStatement->execute([$_SESSION["benutzername"], $followedUsername]);

        // Wenn der Benutzer noch nicht folgt, füge den Eintrag hinzu
        if ($checkStatement->rowCount() == 0) {
            $insertStatement = $pdo->prepare("INSERT INTO Follower (follower_username, followed_username) VALUES (?, ?)");
            $insertStatement->execute([$_SESSION["benutzername"], $followedUsername]);
        }
    }
}
// Zurück zur vorherigen Seite oder einer anderen Weiterleitungsseite
header("Location: " . $_SERVER["HTTP_REFERER"]);
exit();
?>
