<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            
            $statementProfilbild = $pdo->prepare("SELECT profilbild FROM Nutzer WHERE benutzername = :Benutzername ");
            $statementProfilbild->bindParam(":Benutzername", $row['benutzername']);
            
            if ($statementProfilbild->execute()) {
                $profilbildRow = $statementProfilbild->fetch();
                
                echo "<div class='comment'>";
                echo "<p><strong>" . $row['vorname'] . " " . $row['nachname'] . "</strong></p>";
                echo "<p>" . $row['beitrag'] . "</p>";
                echo "<span>" . $row['datum'] . "</span>";
                
                if ($profilbildRow && !empty($profilbildRow["profilbild"])) {
                    // Wenn Profilbild vorhanden ist, zeige es an
                    $imageFileName = "Bilder/" . $row['benutzername'] . ".jpg";  // Annahme: Die Bilder werden als JPEG gespeichert
                    echo "<img class='profilpicture' src='$imageFileName' alt='Profilbild'>";
                } else {
                    echo "<div>Kein Profilbild</div>";
                }

                // Hier fügen Sie den Follow-Button hinzu
                echo "<form action='follow.php' method='post'>";
                echo "<input type='hidden' name='followed_username' value='" . $row['benutzername'] . "'>";
                // ... (wie vorheriger Code für Follow-Button)
                echo "</form>";

                echo "</div>";
            }

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
