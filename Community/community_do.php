<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();

// Beitrag in die Datenbank einfügen
$statement = $pdo->prepare("INSERT INTO Beitrag (beitrag, benutzername) VALUES (?, ?)");

if ($statement->execute(array(htmlspecialchars($_POST["beitrag"]), $_SESSION['benutzername']))) {
    echo "<div class='fine'>Beitrag gespeichert</div><br><br><a href='community.php'>Zu den Beiträgen</a>";
} else {
    die("<div class='fail'>Fehlgeschlagen.<br><br><a href='community.php'>Erneut versuchen</a></div>");
}
?>
