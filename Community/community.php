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

    <div class="forum-container">
        <?php
        // ... (wie vorheriger Code)

        foreach ($statement as $row) {
            echo "<div class='comment-container'>";
            echo "<img src='" . $row['profilbild'] . "' alt='Profilbild' class='profile-picture'>";
            echo "<div class='comment'>";
            echo "<p><strong>" . $row['vorname'] . " " . $row['nachname'] . "</strong></p>";
            echo "<p>" . $row['beitrag'] . "</p>";
            echo "<span>" . $row['datum'] . "</span>";
            // Hier fügen Sie den Follow-Button hinzu
            echo "<form action='follow.php' method='post'>";
            echo "<input type='hidden' name='followed_username' value='" . $row['benutzername'] . "'>";
            // ... (wie vorheriger Code für Follow-Button)
            echo "</form>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>

</div>

</body>
</html>
