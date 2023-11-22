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

    <title>Playlist erstellen</title>
</head>
<body>

<?php





$statement = $pdo->prepare("INSERT INTO Aktivitäten (name, beschreibung, datum,ort) VALUES (?,?,?,?)");
// Feld sollen nicht freigelassen werden:
if(($_POST["name"]) !=null) {
    if ($statement->execute(array(htmlspecialchars($_POST["name"]), htmlspecialchars($_POST["beschreibung"]), htmlspecialchars($_POST["datum"]), htmlspecialchars($_POST["ort"])))) {
        echo "<div class='fine'> Playlist wurde erstellt! </div>";
    } else {
        die("<div class='fail'> Diese Playlist existiert bereits" . "<br><br>" . "<a href='aktivitaten.php'>Erneut versuchen</a> </div>");
    }

// Felder sollen nicht freigelassen werden:
    if ((!empty($_POST["name"])) and (!empty($_POST["beschreibung"])) and (!empty($_FILES["datum"])) and (!empty($_FILES["ort"]))) {
        $statement = $pdo->prepare("INSERT INTO Aktivitäten (name, beschreibung, datum, ort) VALUES (?, ?, ?,?)");
        if ($statement->execute(array(htmlspecialchars($_POST["name"]), htmlspecialchars($_POST["beschreibung"]), htmlspecialchars($_POST["datum"]), htmlspecialchars($_POST["ort"])))) {
            echo "<div class='fine'> Eintrag wurde erstellt" . "<br><br>" . "<a href='aktivitaten.php'>weiteren Aktvitätem hochladen</a> </div>";
        } else {
            echo "</div class=fail>Datenbank-Fehler 3</div>";
            echo $statement->errorInfo()[2];
        }
    } else {
        die("<div class='fail'> Alle Felder müssen ausgefüllt sein!" . "<br><br>" . "<a href='aktivitaten.php'>zurück zum Formular</a> </div>");
    }
}
?>




</body>
</html>
