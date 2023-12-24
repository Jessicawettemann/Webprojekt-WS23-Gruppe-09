<?php

include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width">


   <title>Forum</title>
</head>
<body>

<?php
session_start();

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['beitrag'])) {
    $beitrag = $_POST['beitrag'];

    $stmt = $pdo->prepare('INSERT INTO Beitrag (benutzername, beitrag) VALUES (?, ?)');
    $stmt->execute([$_SESSION['benutzername'], $beitrag]);
}

$beitraege = $pdo->query('SELECT * FROM Beitrag ORDER BY ID DESC')->fetchAll();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community</title>
</head>
<body>
    <h1>Willkommen, <?php echo $_SESSION['benutzername']; ?>!</h1> 


  <!-- Forum -->
  <div id="forum">
    
    </div>
    <!-- Formular zum Hinzufügen von Beiträgen -->
    <form action="community_do.php" method="post" enctype="multipart/form-data">
        <h1>Forum</h1>
        <br><br>
        <label for="beitrag"></label>
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
</tr>";

// Daten aus der Datenbank durchlaufen und in die Tabelle einfügen
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" . $row['beitrag'] . "</td>";
    echo "<td>" . $row['datum'] . "</td>";
    echo "<td>" . $row['benutzername'] . "</td>";
    echo "</tr>";
}

// Tabellenende
echo "</table>";
        
 ?>       
    </form>
</body>
</html>