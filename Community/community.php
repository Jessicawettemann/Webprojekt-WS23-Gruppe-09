<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="css_community.css">
    <title>Forum</title>
</head>
<body>

<div class="container">

    <h1>Community</h1>

    <!-- Formular zum Hinzufügen von Beiträgen -->
    <form id="communityForm" action="community_do.php" method="post" placeholder="Gib hier deinen Beitrag ein..." enctype="multipart/form-data" class="forum-form">
        <label for="beitrag"></label>
        <input type="text" placeholder="Beitrag" id="beitrag" name="beitrag" required>
        <button type="submit">Beitrag hinzufügen</button>
    </form>

    <!-- Formular zur Suche nach einem Nutzer -->
    <form action="community.php" method="post" class="forum-form">
        <label for="search_user">Nutzer suchen:</label>
        <input type="text" id="search_user" name="search_user" required>
        <button type="submit">Suchen</button>
    </form>

    <?php
    $statementBeitrag = $pdo->prepare("SELECT * FROM Beitrag INNER JOIN Nutzer ON Beitrag.benutzername = Nutzer.benutzername");
    $statementBeitrag->execute();

    // Überprüfen, ob Daten vorhanden sind, bevor die foreach-Schleife gestartet wird
    if ($statementBeitrag->rowCount() > 0) {
        echo "<div class='forum-container'>";

        foreach ($statementBeitrag as $row) {
            echo "<div class='comment-container'>";

            echo "<div class='comment'>";
            echo "<p><strong>" . $row['vorname'] . " " . $row['nachname'] . "</strong></p>";
            echo "<p>" . $row['beitrag'] . "</p>";
            echo "<span>" . $row['datum'] . "</span>";

            // Profilbild anzeigen
            $statementProfilbild = $pdo->prepare("SELECT profilbild FROM Nutzer WHERE benutzername = ?");
            if (!$statementProfilbild->execute([$row['benutzername']])) {
                die("<div class='fail'>Datensatz nicht verfügbar</div>");
            }
            $rowProfilbild = $statementProfilbild->fetch();

            // Bild im HTML-Code einbetten
            if ($rowProfilbild && isset($rowProfilbild['profilbild'])) {
                echo "<div><img class='profilpicture' src='data:image/jpeg;base64," . base64_encode($rowProfilbild['profilbild']) . "'></div>";
            } else {
                echo "<div>Kein Profilbild</div>";
            }

            // ... (wie vorheriger Code für Follow-Button)

            echo "</div>";

            echo "</div>";
        }

        echo "</div>";
    } else {
        echo "<p>Es gibt keine Beiträge.</p>";
    }
    ?>

</div>

</body>
</html>
