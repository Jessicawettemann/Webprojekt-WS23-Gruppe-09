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
echo "</tr>";

// Durch alle Beiträge iterieren
foreach ($statement as $row) {
    echo "<tr>";
    echo "<td>" . $row['beitrag'] . "</td>";
    echo "<td>" . $row['datum'] . "</td>";
    echo "<td>" . $row['vorname'] . " " . $row['nachname'] . "</td>";
    // Zeige das Profilbild in einem kleinen Kreis an
    echo "<td class='profile-image' style='background-image: url(\"" . $row['profilbild'] . "\");'></td>";
    
    echo "</tr>";
}

// Tabellenende
echo "</table>";

?>

</body>
</html>
