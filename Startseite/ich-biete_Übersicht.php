<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Angebotsübersicht</title>

</head>

<body>
    <h1> Das ist unsere Ich biete-Seite </h1>
    <a href="Upload.php"> <h3>Hochladen</h3> </a>






    <?php

    # Einbindung von Hinzufüge-Button (Submit); hinterlegter Link href= playlistauswahl.php - in URL ausgewählter Song_ID in Variable speichern und mitschicken - $_GET("id")

    $statement=$pdo->prepare("SELECT * FROM Upload");
    if ($statement->execute()){
        while($row=$statement->fetch()) {
            $chosenSong = $row["ID"];
            echo  "<h4>".$row["beschreibung"]."</h4>" ."<body class='small'>"." </body>";


            if (!empty($row["foto"])) {
                echo"<div class='image'>";
                echo "<br> <img src='https://mars.iuk.hdm-stuttgart.de/~jw170/Bilder/" . $row["foto"] . "'>" . "<br>";
                echo "</div>";
            } else{
                echo "<div class='small'>keine Bilddatei vorhanden</div>";
            }

            echo  "<h4>".$row["zustand"]."</h4>" ."<body class='small'>"." </body>";

            echo  "<h4>".$row["preis"]."</h4>" ."<body class='small'>"." </body>";

            echo  "<h4>".$row["ort"]."</h4>" ."<body class='small'>"." </body>";


        }
    }else{
        echo "<div class='fail'>Fehlermeldung!</div>";
        echo $statement->errorInfo()[2];
        die();
    }
    ?>




</body>
</html>