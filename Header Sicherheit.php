<?php
include "Datenbank Verbindung.php";
session_start();

// Annahme: Sie haben eine Tabelle "Benachrichtigungen" in Ihrer Datenbank, die neue Benachrichtigungen speichert.
// Sie sollten den Code entsprechend anpassen, um festzustellen, ob es neue Benachrichtigungen gibt.

// Beispiel: Annahme, dass Sie eine Spalte "gelesen" in Ihrer Benachrichtigungstabelle haben.
$hasNewNotifications = false; // Setzen Sie diesen Wert basierend auf Ihren Daten in der Datenbank.

// Beispiel: Überprüfen Sie, ob es neue Benachrichtigungen gibt
if (isset($_SESSION["benutzername"])) {
    $checkNewNotifications = $pdo->prepare("SELECT COUNT(*) FROM Benachrichtigungen WHERE benutzername = ? AND gelesen = 0");
    $checkNewNotifications->execute([$_SESSION["benutzername"]]);
    $hasNewNotifications = ($checkNewNotifications->fetchColumn() > 0);
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Übersicht</title>
    <link rel="stylesheet" type="text/css" href="Header.css">
    <style>
        /* Beispielstil für den Benachrichtigungspunkt */
        .notification-dot {
            width: 10px;
            height: 10px;
            background-color: red; /* Ändern Sie die Farbe entsprechend */
            border-radius: 50%;
            display: inline-block;
            margin-left: 5px; /* Passen Sie den Abstand zum Navigationslink an */
        }
    </style>
</head>
<body>
<header>
    <div class="header">
        <ul class="ul">

            <li class="li"><a href="Startseite.php">Startseite</a></li>
            <li class="li"><a href="Profil_do.php">Mein Profil</a></li>

            <!-- Neuer Navigationslink zu den Benachrichtigungen -->
            <li class="li">
                <a href="notifications.php">
                    Benachrichtigungen
                    <?php if ($hasNewNotifications): ?>
                        <span class="notification-dot"></span>
                    <?php endif; ?>
                </a>
            </li>

            <?php
            #wenn Nutzer angemeldet ist wird zum Logout verlink
