<?php
include "Header Sicherheit.php";

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terminkalender</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <h1>Kalender</h1>
    
    <!-- Kalenderbereich -->
    <div id="calendar">
        <!-- Hier wird der Kalender angezeigt -->
    </div>

    <!-- Formular zum Hinzufügen von Ereignissen -->
    <form action="aktivitaeten_do.php" method="post" enctype="multipart/form-data">
        <label for="thema">Ereignis hinzufügen:</label>
        <input type="text" id="thema" name="thema" required>

        <label for="beschreibung">Beschreibung hinzufügen:</label>
        <input type="text" id="beschreibung" name="beschreibung" required>

        <label for="datum">Datum:</label>
        <input type="date" id="datum" name="datum" required>

        <label for="ort">Ort:</label>
        <input type="text" id="ort" name="ort" required>

        <button type="submit">Ereignis hinzufügen</button>

    <br>
    <br>
    <br>


<?php 
// Daten aus der Datenbank abrufen
$statement = $pdo->prepare("SELECT * FROM Aktivitäten ORDER BY datum ASC");
$statement->execute();
$result = $statement->fetchAll();

// Überschrift für die Tabelle
echo "<table border='1'>
<tr>

<th>Thema</th>
<th>Beschreibung</th>
<th>Datum</th>
<th>Ort</th>
</tr>";

// Daten aus der Datenbank durchlaufen und in die Tabelle einfügen
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['thema'] . "</td>";
    echo "<td>" . $row['beschreibung'] . "</td>";
    echo "<td>" . $row['datum'] . "</td>";
    echo "<td>" . $row['ort'] . "</td>";
    echo "</tr>";
}

// Tabellenende
echo "</table>";
        
 ?>       
    </form>
</body>
</html>
