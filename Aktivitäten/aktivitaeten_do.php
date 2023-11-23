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

    <title>Kalender</title>
</head>
<body>

<?php





$statement = $pdo->prepare("INSERT INTO Aktivitäten (thema, beschreibung, datum,ort) VALUES (?,?,?,?)");
// Feld sollen nicht freigelassen werden:

if(($_POST["thema"]) !=null and ($_POST["beschreibung"]) !=null and ($_POST["datum"]) !=null and ($_POST["ort"]) !=null){
    if($statement->execute(array(htmlspecialchars($_POST["thema"]), htmlspecialchars($_POST["beschreibung"]), htmlspecialchars($_POST["datum"]), htmlspecialchars($_POST["ort"]),))){
        echo "<div class='fine'> Playlist wurde erstellt! </div>";
    } else {
        die("<div class='fail'> Diese Playlist existiert bereits" . "<br><br>" . "<a href='aktivitaten.php'>Erneut versuchen</a> </div>");
    }
}
?>




</body>
</html>
