<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";

// Wenn das Formular abgesendet wurde
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Beitrag speichern
    $statement = $pdo->prepare("INSERT INTO Beitrag (beitrag, benutzername, profilbild) VALUES (?, ?, ?)");

    // Annahme: $_SESSION["benutzername"] enthält den aktuellen Benutzernamen
    $benutzername = $_SESSION["benutzername"];

    // Annahme: Das Profilbild ist in der Tabelle "Nutzer" in der Spalte "profilbild" als BLOB gespeichert
    $statementProfilbild = $pdo->prepare("SELECT profilbild FROM Nutzer WHERE benutzername = ?");
    $statementProfilbild->execute([$benutzername]);
    $profilbildRow = $statementProfilbild->fetch(PDO::FETCH_ASSOC);

    // Überprüfen, ob das Profilbild vorhanden ist, bevor Sie es verwenden
    if ($profilbildRow && isset($profilbildRow['profilbild'])) {
        $profilbild = $profilbildRow['profilbild'];
    } else {
        $profilbild = null; // Setzen Sie einen Standardwert oder NULL, falls kein Profilbild vorhanden ist
    }

    if ($statement->execute(array(htmlspecialchars($_POST["beitrag"]), $benutzername, $profilbild))) {
        header("Location: community.php");
        exit();
    } else {
        $errorInfo = $statement->errorInfo();
        die("<div class='fail'>Fehlgeschlagen. Fehlerdetails: " . implode(" ", $errorInfo) . "<br><br><a href='community.php'>Erneut versuchen</a></div>");
    }
}

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
    echo "<td>" . $row['profilbild'] . "</td>";
    echo "</tr>";
}

// Tabellenende
echo "</table>";
?>
