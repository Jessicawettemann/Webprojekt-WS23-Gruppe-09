<?php
include 'Datenbank Verbindung.php';
include "Header Sicherheit.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Kalender</title>

</head>

<body>
<?php

// Binde die Werte der Felder an Parametermarkierungen
$einfuegen = $db->prepare(
        "INSERT INTO Aktivitäten (thema, beschreibung, datum, ort) 
        VALUES (?, ?, ?, ?, NOW())");

$einfuegen->bind_param('ssss', $thema, $beschreibung, $datum, $ort);

// Setze die Werte der Parameter und führe den Anweisungsvorgang aus


if ($einfuegen->execute()) {
    header('Location: index.php');
    die("Neuer Eintrag wurde erfolgreich erstellt!");
}


$stmt->close();


// Daten ausgeben lassen


// Überprüfe, ob die Verbindung erfolgreich war
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Führe eine SELECT-Anweisung aus, um alle Datensätze aus der Tabelle Aktivitäten abzurufen
$sql = "SELECT id, beschreibung, datum, ort FROM Aktivitäten ORDER BY datum";
$result = $conn->query($sql);

// Starte eine HTML-Tabelle, um die Daten anzuzeigen
echo "<table border='1'>
<tr>
<th>ID</th>
<th>Beschreibung</th>
<th>Datum</th>
<th>Ort</th>
</tr>";

// Gehe durch alle Zeilen in den Abfrageergebnissen und füge sie in die Tabelle ein
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"]. "</td>";
        echo "<td>" . $row["beschreibung"]. "</td>";
        echo "<td>" . $row["datum"]. "</td>";
        echo "<td>" . $row["ort"]. "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>Keine Aktivitäten gefunden</td></tr>";
}

// Schließe die HTML-Tabelle ab
echo "</table>";

// Schließe die Verbindung zur Datenbank
$conn->close();

?>

