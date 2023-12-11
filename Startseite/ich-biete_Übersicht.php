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
<h1> Das ist unsere Ich biete-Seite </h1>
<a href="Upload.php"> <h3>Hochladen</h3> </a>

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
        echo "<h1>Zustand</h1><br>";
        echo "<h2>".$row["zustand"]."</h2>";
        echo "<h1>Preis</h1><br>";
        echo "<h2>".$row["preis"]."</h2>";
        echo "<h1>Ort</h1><br>";
        echo "<h2>".$row["ort"]."</h2>";
        echo "</div>";
    }
}else{
    echo "<div class='fail'>Fehlermeldung!</div>";
    echo $statement->errorInfo()[2];
    die();
}
?>

</body>
</html>