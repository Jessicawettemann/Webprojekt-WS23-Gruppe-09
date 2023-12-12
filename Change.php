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
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $statement=$pdo->prepare("SELECT * FROM Upload WHERE ID=?");
    if ($statement->execute([$id])){
        while($row=$statement->fetch()){
            echo "<form action='Change_do.php' method='post' enctype='multipart/form-data'>";
            echo "<input type='hidden' name='id' value='".$row['ID']."'>";
            echo "<label for='beschreibung'>Beschreibung:</label><br>";
            echo "<input type='text' id='beschreibung' name='beschreibung' value='".$row['beschreibung']."'><br>";
            echo "<label for='foto'>Foto:</label><br>";
            echo "<input type='file' id='foto' name='foto'><br>";
            echo "<label for='zustand'>Zustand:</label><br>";
            echo "<input type='text' id='zustand' name='zustand' value='".$row['zustand']."'><br>";
            echo "<label for='preis'>Preis:</label><br>";
            echo "<input type='text' id='preis' name='preis' value='".$row['preis']."'><br>";
            echo "<label for='ort'>Ort:</label><br>";
            echo "<input type='text' id='ort' name='ort' value='".$row['ort']."'><br>";
            echo "<br><br>";
            echo "<input type='submit' name='submit' value='Bearbeiten'>";
            echo "</form>";
        }
    }else{
        echo "<div class='fail'>Fehlermeldung!</div>";
        echo $statement->errorInfo()[2];
        die();
    }
}
?>

</body>
</html>