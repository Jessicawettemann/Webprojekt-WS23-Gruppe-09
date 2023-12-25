<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">

    <title>Forum</title>
</head>
<body>

<h1>Community</h1>

<form action="community_do.php" method="post">
    <textarea name="beitrag" id="beitrag" rows="5" cols="50" placeholder="Gib hier deinen Beitrag ein..."></textarea><br>
    <input type="submit" value="Beitrag senden">
</form>

<?php

// Datenbankverbindung herstellen
include "Datenbank Verbindung.php";

// Alle Beiträge aus der Datenbank auslesen
$statement = $pdo->prepare("SELECT * FROM Beitrag INNER JOIN Nutzer ON Beitrag.benutzername = Nutzer.benutzername");
$statement->execute();

// Beiträge in einer Tabelle anzeigen
echo "<table border='1'>";
echo "<tr>";
echo "<th>Beitrag</th>";
echo "<th>Datum</th>";
echo "<th>Nutzer</th>";
echo "</tr>";

// Durch alle Beiträge iterieren
foreach ($statement as $row) {
    echo "<tr>";
    echo "<td>" . $row['beitrag'] . "</td>";
    echo "<td>" . $row['datum'] . "</td>";
    echo "<td>" . $row['vorname'] . " " . $row['nachname'] . "</td>";
    echo "</tr>";
}

// Tabellenende
echo "</table>";

?>

</body>
</html>