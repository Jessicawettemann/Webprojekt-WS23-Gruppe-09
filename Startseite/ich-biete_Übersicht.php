<?php
include "Header Sicherheit.php";
include "Datenbank Verbindung.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Angebotsübersicht</title>
    <link rel="stylesheet" href="Übersicht.css">
</head>

<body>
<br><br>
<h1> Ich biete</h1>
<br><br>
<div>
<a href= Upload.php> <button class=button1>Hinzufügen</button>
</div>

<?php

$statement=$pdo->prepare("SELECT * FROM Upload");
if ($statement->execute()){
    while($row=$statement->fetch()) {
        $chosenSong = $row["ID"];
        echo "<div class='card'>";
        echo "<h1>Beschreibung</h>";
        echo "<h2>".$row["beschreibung"]."</h2>";
        

        if (!empty($row["foto"])) {
            echo"<div class='image'>";
            echo "<img src='https://mars.iuk.hdm-stuttgart.de/~jw170/Bilder/" . $row["foto"] . "'>";
            echo "</div>";
        } else{
            echo "<div class='small'>keine Bilddatei vorhanden</div>";
        }
        if (!empty($row["optionalImage"])) {
            echo"<div class='pdf'>";
            echo "<img src='https://mars.iuk.hdm-stuttgart.de/~jw170/Bilder/" . $row["optionalImage"] . "'>";
            echo "</div>";
        } else{
            echo "<div class='small'>optional</div>";
        }
        echo "<h1>Zustand</h1>";
        echo "<h2>".$row["zustand"]."</h2>";
        echo "<h1>Preis</h1>";
        echo "<h2>".$row["preis"]."</h2>";
        echo "<h1>Ort</h1>";
        echo "<h2>".$row["ort"]."</h2>";
        echo "</div>";

        echo "<a href=Delete_do.php?id=".$row['ID']."> <button class=button>Löschen</button>";
        echo "<a href= Change.php?id=".$row ['ID']."> <button class=button>Bearbeiten</button>";

    }
}else{
    echo "<div class='fail'>Fehlermeldung!</div>";
    echo $statement->errorInfo()[2];
    die();
}
?>

</body>
</html>