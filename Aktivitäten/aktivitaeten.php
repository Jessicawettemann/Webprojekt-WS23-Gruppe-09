<?php
include "Header Sicherheit.php";


?>


<!DOCTYPE html>
<html lang="de">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Terminkalender</title>
   <link rel="stylesheet" type="text/css" href="css_kalender.css">
</head>
<body>






  
   <!-- Kalenderbereich -->
   <div id="calendar">
       <!-- Hier wird der Kalender angezeigt -->
   </div>
   <!-- Formular zum Hinzufügen von Ereignissen -->
   <form action="aktivitaeten_do.php" method="post" enctype="multipart/form-data">
       <h1>Kalender</h1>
       <br><br>
       <label for="thema"></label>
       <input type="text" placeholder="Thema" id="thema" name="thema" required>


       <label for="beschreibung"></label>
       <input type="text" placeholder="Beschreibung" id="beschreibung" name="beschreibung" required>


       <label for="datum"></label>
       <input type="date" placeholder="Datum" id="datum" name="datum" required>


       <label for="ort"></label>
       <input type="text"  placeholder="Ort" id="ort" name="ort" required>


       <br>
       <br>
       <button type="submit">Ereignis hinzufügen</button>


   <br>
   <br>




<?php
// Daten aus der Datenbank abrufen
$statement = $pdo->prepare("SELECT * FROM Aktivitäten ORDER BY datum ASC");
$statement->execute();
$result = $statement->fetchAll();


// Überschrift für die Tabelle


echo "<table border='1'>
<br><br><br>
<tr>
<th>Thema</th>
<th>Beschreibung</th>
<th>Datum</th>
<th>Ort</th>
</tr>";


// Daten aus der Datenbank durchlaufen und in die Tabelle einfügen
foreach ($result as $row) {
   echo "<tr>";
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
