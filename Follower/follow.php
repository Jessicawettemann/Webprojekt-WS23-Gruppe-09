<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- Einbinden des CSS-Stils für Fehlermeldungen -->
    <link rel="stylesheet" type="text/css" href="fehlermeldung.css">
</head>
<body>

<?php
// Einbinden der Datei für die Datenbankverbindung und Sicherheitsüberprüfung
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";

// Überprüfen, ob der Benutzer nicht angemeldet ist
if (!isset($_SESSION["Nutzer_ID"])){
    // displayMessage-Funktion aufrufen und Fehlermeldung anzeigen
    include 'fehlermeldung.php';
    displayMessage("Bitte melde dich zunächst an. <br><a href='Login Formular.php'>Hier geht's zum Login</a>", 'fail');
} else {
    // Überprüfen, ob das Formular abgeschickt wurde
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
