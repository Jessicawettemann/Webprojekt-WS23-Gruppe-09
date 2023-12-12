<?php
include "Header Sicherheit.php";

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



    
    <!-- Forum -->
    <div id="forum">
        <!-- Hier wird der das Forum angezeigt -->
    </div>
    <!-- Formular zum Hinzufügen von Beiträgen -->
    <form action="community_do.php" method="post" enctype="multipart/form-data">
        <h1>Forum</h1>
        <br><br>
        <label for="beitrag">Beitrag hinzufügen:</label>
        <input type="text" placeholder="Beitrag" id="beitrag" name="beitrag" required>

        <button type="submit">Beitrag hinzufügen</button>

    <br>
    <br>
    <br><br><br><br>


<?php 
// Daten aus der Datenbank abrufen
$statement = $pdo->prepare("SELECT * FROM Beitrag ORDER BY datum ASC");
$statement->execute();
$result = $statement->fetchAll();


// Überschrift für die Tabelle

echo "<table border='1'>
<br><br><br>
<tr>
<th>Beitrag</th>
<th>Datum</th>
<th>Benutzername</th>
<th>Profilbild</th>
</tr>";

// Daten aus der Datenbank durchlaufen und in die Tabelle einfügen
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" . $row['beitrag'] . "</td>";
    echo "<td>" . $row['datum'] . "</td>";

    echo "</tr>";
}

// Tabellenende
echo "</table>";
        
 ?>       
    </form>
</body>
</html>
