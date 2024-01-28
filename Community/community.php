<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();

// Fehlerprotokollierung aktivieren
error_reporting(E_ALL);
ini_set('display_errors', 1);
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

    if ($statementBeitrag->rowCount() > 0) {
        echo "<div class='forum-container'>";

        foreach ($statementBeitrag as $row) {
            echo "<div class='comment-container'>";
            echo "<div class='comment'>";

            // Profilbild anzeigen
            $statementProfilbild = $pdo->prepare("SELECT profilbild FROM Nutzer WHERE benutzername = ?");
            $statementProfilbild->execute([$row['benutzername']]);
            $profilbildRow = $statementProfilbild->fetch();

            // Profilbild einbetten, wenn ein Bildlink vorhanden ist
            if (!empty($profilbildRow['profilbild'])) {
                echo "<div><img class='profilpicture' src='https://mars.iuk.hdm-stuttgart.de/~jw170/Bilder/" . $profilbildRow['profilbild'] . "'></div>";
            } else {
                echo "<div>Kein Profilbild</div>";
            }

            echo "<p><strong>" . $row['vorname'] . " " . $row['nachname'] . "</strong></p>";
            echo "<p>" . $row['beitrag'] . "</p>";
            echo "<span>" . $row['datum'] . "</span>";


            
            // Follow-Button hinzufügen
            echo "<form action='follow.php' method='post'>";
            echo "<input type='hidden' name='followed_username' value='" . $row['benutzername'] . "'>";
            echo "<button type='submit'>Folgen</button>";
            echo "</form>";

            
            // ... (Rest deines Codes) ...

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
