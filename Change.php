<?php
include "Header Sicherheit.php";
include "Datenbank Verbindung.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Bearbeiten</title>
    <link rel="stylesheet" href="Übersicht.css">
</head>

<body>
<br><br>
<h1> Bearbeiten</h1>
<br><br>

<?php
if(!isset($_SESSION["Upload_ID"])){
} else {
    $beitrag = $_SESSION["Upload_ID"];
}
    $statement=$pdo->prepare("SELECT * FROM Upload WHERE ID=?");
    if ($statement->execute([$beitrag])){
        while($row=$statement->fetch()){
            echo "<form action='Change_do.php' method='post' enctype='multipart/form-data'>";
            echo "<input type='hidden' name='id' value='".$row['ID']."'>";
            echo "<label for='beschreibung'>Beschreibung:</label><br>";
            echo "<input type='text' id='Beschreibung' name='beschreibung' value='".$row['Beschreibung']."'><br>";
            echo "<label for='foto'>Foto:</label><br>";
            echo "<input type='file' id='Foto' name='foto' value='".$row['Foto']."><br>";
            echo "<label for='optionalImage'>Optional:</label><br>";
            echo "<input type='file' id='optionalImage' name='Optional' value='".$row['Otional']."><br>";
            echo "<label for='zustand'>Zustand:</label><br>";
            echo "<input type='text' id='Zustand' name='zustand' value='".$row['Zustand']."'><br>";
            echo "<label for='preis'>Preis:</label><br>";
            echo "<input type='text' id='Preis' name='preis' value='".$row['Preis']."'><br>";
            echo "<label for='ort'>Ort:</label><br>";
            echo "<input type='text' id='Ort' name='ort' value='".$row['Ort']."'><br>";
            echo "<br><br>";
            echo "<input type='submit' name='submit' value='Bearbeiten'>";
            echo "</form>";
        }
    }else{
        echo "<div class='fail'>Fehlermeldung!</div>";
        echo $statement->errorInfo()[2];
        die();
    }
?>

</body>
</html>