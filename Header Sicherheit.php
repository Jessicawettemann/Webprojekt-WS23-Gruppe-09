<?php
include "Datenbank Verbindung.php";
session_start();

// Annahme: Sie haben eine Tabelle "Benachrichtigungen" in Ihrer Datenbank, die neue Benachrichtigungen speichert.
// Sie sollten den Code entsprechend anpassen, um festzustellen, ob es neue Benachrichtigungen gibt.

// Beispiel: Annahme, dass Sie eine Spalte "gelesen" in Ihrer Benachrichtigungstabelle haben.
$hasNewNotifications = false; // Setzen Sie diesen Wert basierend auf Ihren Daten in der Datenbank.

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
            #wenn Nutzer angemeldet ist wird zum Logout verlinkt, anderenfalls zum Login
            if(isset($_SESSION["benutzername"])) {
                echo "<li class='li'><a href='Logout.php'>Logout</a></li";
            } else {
                echo "<li class='li'><a href='Login Formular.php'>Login</a></li";
            }
            ?>

            <?php
            #wenn Nutzer angemeldet ist wird zum Logout verlinkt, anderenfalls zum Login
            if(isset($_SESSION["admin"])) {
                echo "<li class='li'><a href='Logout_Admin.php'>Logout Admin</a></li";
            } else {
                echo "<li class='li'><a href='Login_Admin.php'>Login Admin</a></li";
            }
            ?>

            <div>
                <?php
                #ist Nutzer angemeldet wird das Profilbild angezeigt, wenn nicht dann der Platzhalter
                if (!isset($_SESSION["Nutzer_ID"])) {
                    echo "<div>nicht angemeldet</div>";
                } else {

                    $statement = $pdo->prepare("SELECT profilbild FROM Nutzer WHERE ID= :Nutzer_ID ");
                    $statement->bindParam(":Nutzer_ID", $_SESSION["Nutzer_ID"]);
                    if ($statement->execute()) {
                        if ($row = $statement->fetch()) {
                            if (($row["profilbild"]) == null or "") {
                                echo "<div>kein Profilbild</div>";
                            } else {
                                echo "<div><img class='profilpicture' src='https://mars.iuk.hdm-stuttgart.de/~jw170/Bilder/" . $row['profilbild'] . "'></div>";
                            }
                        }
                    }
                }
                ?>
            </div>
        </ul>
    </div>
</header>
</body>
