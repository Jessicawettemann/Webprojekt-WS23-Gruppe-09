<?php
include "Header Sicherheit.php";

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <h1>Forum</h1>
    
    <!-- Forumbereich -->
    <div id="forum">
        <!-- Hier wird das Forum angezeigt -->
    </div>

    <!-- Formular zum Hinzufügen von Beiträgen -->
    <form action="community_do.php" method="post" enctype="multipart/form-data">
        <label for="beitrag">Beitrag hinzufügen:</label>
        <input type="text" id="beitrag" name="beitrag" required>

        <button type="submit">Beitrag hinzufügen</button>
    
    </form>
</body>
</html>
