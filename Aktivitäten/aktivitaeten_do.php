<?php
include 'Datenbank Verbindung.php'; 

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



// Verarbeite die Ereignisinformationen
if(isset($_POST['thema']) && isset($_POST['beschreibung']) && isset($_POST['datum']) && isset($_POST['ort'])) {
    $thema = $_POST['thema'];
    $beschreibung = $_POST['beschreibung'];
    $datum = $_POST['datum'];
    $ort = $_POST['ort'];

    // Erstelle den SQL-Befehl zum Hinzufügen des Ereignisses
    $sql = "INSERT INTO aktivitaeten (thema, beschreibung, datum, ort) VALUES ('$thema', '$beschreibung', '$datum', '$ort')";

    // Führe den SQL-Befehl aus
    if(mysqli_query($conn, $sql)) {
        echo "<script>alert('Ereignis wurde erfolgreich hinzugefügt.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Ein Fehler ist aufgetreten. Bitte versuche es erneut.'); window.location.href='index.php';</script>";
    }

    // Schließe die Datenbankverbindung
    mysqli_close($conn);
}
?>


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

