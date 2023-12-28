<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="Formulare_1.css">
    <title>Forum</title>
</head>
<body>

<h1>Community</h1>


    <!-- Formular zum Hinzufügen von Beiträgen -->
    <form action="community_do.php" method="post" placeholder="Gib hier deinen Beitrag ein..." enctype="multipart/form-data">
        <h1>Forum</h1>
        <br><br>
        <label for="beitrag"></label>
        <input type="text" placeholder="Beitrag" id="beitrag" name="beitrag" required>

        <button type="submit">Beitrag hinzufügen</button>

    <br>    
    <br>
    <br><br><br><br>


<?php

// Alle Beiträge aus der Datenbank auslesen
$statement = $pdo->prepare("SELECT * FROM Beitrag INNER JOIN Nutzer ON Beitrag.benutzername = Nutzer.benutzername");
$statement->execute();

// Beiträge in einer Tabelle anzeigen
echo "<table border='1'>";
echo "<tr>";
echo "<th>Beitrag</th>";
echo "<th>Datum</th>";
echo "<th>Nutzer</th>";
echo "<th>Profilbild</th>";
echo "<th>Folgen</th>";
echo "</tr>";

// Durch alle Beiträge iterieren
foreach ($statement as $row) {
    echo "<tr>";
    echo "<td>" . $row['beitrag'] . "</td>";
    echo "<td>" . $row['datum'] . "</td>";
    echo "<td>" . $row['vorname'] . " " . $row['nachname'] . "</td>";

    echo "<td>" . $row['profilbild'] . "</td>";

    // Hier füge den Follow-Button hinzu
    echo "<td>";

    // Überprüfen, ob der Benutzer bereits folgt
    $checkStatement = $pdo->prepare("SELECT * FROM Follower WHERE follower_username = ? AND followed_username = ?");
    $checkStatement->execute([$_SESSION["benutzername"], $row['benutzername']]);

    if ($checkStatement->rowCount() == 0) {
        // Der Benutzer folgt noch nicht, zeige den Follow-Button
        echo "<form action='follow.php' method='post'>";
        echo "<input type='hidden' name='followed_username' value='" . $row['benutzername'] . "'>";
        echo "<button type='submit'>Follow</button>";
        echo "</form>";
    } else {
        // Der Benutzer folgt bereits, zeige den Unfollow-Button
        echo "<form action='unfollow.php' method='post'>";
        echo "<input type='hidden' name='followed_username' value='" . $row['benutzername'] . "'>";
        echo "<button type='submit'>Unfollow</button>";
        echo "</form>";
    }

    echo "</td>";
    echo "</tr>";
}

// Tabellenende
echo "</table>";

?>

</body>
</html>
