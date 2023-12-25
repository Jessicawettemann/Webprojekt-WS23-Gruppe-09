<?php

include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();

// Beitrag speichern
$statement = $pdo->prepare("INSERT INTO Beitrag (beitrag, benutzername) VALUES (?, ?)");

if ($statement->execute(array(htmlspecialchars($_POST["beitrag"]), $_SESSION["benutzername"]))) {
    header("Location: community.php");
} else {
    die("<div class='fail'> Fehlgeschlagen." . "<br><br>" . "<a href='community.php'>Erneut versuchen</a> </div>");
}

?>