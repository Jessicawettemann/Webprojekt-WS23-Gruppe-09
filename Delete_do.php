<?php
include "Header Sicherheit.php";
include "Datenbank Verbindung.php";
session_start();

// Stellen Sie sicher, dass eine Beitrags-ID vorhanden ist
if (isset($_GET['id'])) {
    $chosenSong = $_GET['id'];

    // Löschen Sie den Beitrag aus der Datenbank
    $statement=$pdo->prepare("DELETE FROM Upload WHERE ID=:chosenSong");
    $statement->execute(['chosenSong' => $chosenSong]);

    // Umleiten Sie den Benutzer zur Übersichtsseite
    header('Location: ich-biete_Übersicht.php');
    exit();

} else {
    // Wenn keine Beitrags-ID vorhanden ist, zeigen Sie eine Fehlermeldung an
    echo "Keine Beitrags-ID vorhanden!";
}
?>