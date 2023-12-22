<?php
include "Header Sicherheit.php";
include "Datenbank Verbindung.php";
session_start();

if(isset($_POST['change'])) {
    $change = $_POST['change'];
    $newValue = $_POST['newValue'];
    $ID = $_POST['ID'];

    $stmt = $pdo->prepare("UPDATE Upload SET " . $change . " = :newValue WHERE ID = :ID");
    $stmt->bindParam(':newValue', $newValue);
    $stmt->bindParam(':ID', $ID);

    if($stmt->execute()) {
        echo "<div class='success'>Der Wert wurde erfolgreich geändert.</div>";
    } else {
        echo "<div class='fail'>Fehlermeldung!</div>";
        echo $stmt->errorInfo()[2];
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ändern</title>
    <link rel="stylesheet" href="Übersicht.css">
</head>

<body>
<h1>Wert ändern</h1>
<br><br>

<form method="post">
    <label for="change">Zu ändernder Wert:</label>
    <select name="change" id="change">
        <option value="beschreibung">Beschreibung</option>
        <option value="zustand">Zustand</option>
        <option value="preis">Preis</option>
        <option value="ort">Ort</option>
    </select>
    <br><br>

    <label for="newValue">Neuer Wert:</label>
    <input type="text" name="newValue" id="newValue" required>
    <br><br>

    <label for="ID">ID:</label>
    <input type="number" name="ID" id="ID" required>
    <br><br>

    <input type="submit" value="Ändern">
</form>

<a href="Uploads.php"> <button class="button">Zurück</button></a>
</body>
</html>