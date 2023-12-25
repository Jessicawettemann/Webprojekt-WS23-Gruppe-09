<?php
include "Header Sicherheit.php";
include "Datenbank Verbindung.php";
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" type="text/css" href="Formulare_1.css">
</head>
<body>

<!-- Formular zum Hinzufügen von Beiträgen -->
<form action="community_do.php" method="post" enctype="multipart/form-data">
    <h1>Forum</h1>
    <br><br>
    <label for="beitrag"></label>
    <input type="text" placeholder="Beitrag" id="beitrag" name="beitrag" required>

    <button type="submit">Beitrag hinzufügen</button>

    <br><br><br><br>

    <!-- Tabelle für Beiträge -->
    <?php
    // Daten aus der Datenbank abrufen
    $statement = $pdo->prepare("SELECT Beitrag.*, Nutzer.benutzername, Nutzer.profilbild FROM Beitrag JOIN Nutzer ON Beitrag.benutzername = Nutzer.benutzername ORDER BY Beitrag.datum ASC");
    $statement->execute();
    $result = $statement->fetchAll();

    // Überschrift für die Tabelle
    echo "<table border='1'>
          <tr>
          <th>Beitrag</th>
          <th>Datum</th>
          <th>Nutzer</th>
          <th>Profilbild</th>
          </tr>";

    // Daten aus der Datenbank durchlaufen und in die Tabelle einfügen
    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['beitrag']) . "</td>";
        echo "<td>" . $row['datum'] . "</td>";
        echo "<td>" . $row['benutzername'] . "</td>";
        echo "<td><img src='data:image/png;base64," . base64_encode($row['profilbild']) . "' alt='Profilbild' width='50' height='50'></td>";
        echo "</tr>";
    }

    // Tabellenende
    echo "</table>";
    ?>
</form>

</body>
</html>
