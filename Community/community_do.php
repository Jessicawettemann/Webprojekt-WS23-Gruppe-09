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
// Beiträge eintragen
$statement = $pdo->prepare("INSERT INTO Beitrag (beitrag, benutzername) VALUES (?, ?)");

// Überprüfen, ob das Feld nicht freigelassen wird
if(isset($_POST["beitrag"]) && isset($_POST["benutzername"])) {
    $beitrag = htmlspecialchars($_POST["beitrag"]);
    $benutzername = $_POST["benutzername"];

    if($statement->execute(array($beitrag, $benutzername))) {
        echo "<div class='fine'> Ereignis gespeichert </div>". "<br><br>" . "<a href='community.php'>Zu den Beiträgen</a> </div>";
    } else {
        die("<div class='fail'> Fehlgeschlagen." . "<br><br>" . "<a href='community.php'>Erneut versuchen</a> </div>");
    }
}
?>

</body>
</html>
