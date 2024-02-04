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
    <link rel="stylesheet" type="text/css" href="../fehlermeldung.css">
</head>

<body>


<?php

if (!move_uploaded_file($_FILES["foto"]["tmp_name"], "/home/jw170/public_html/Bilder/" . $_FILES["foto"]["name"])) {  // Überprüfung ob Foto verschoben wurde an Zielort
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Bild konnte nicht hochgeladen werden. <br>", 'fail');
}
 // Überpfüfung ob mindestens ein Formularfeld gesetzt sind u. ID in der URL ist
     // Vorbereitung (Aktualisierung Upload Tabelle für spezifische ID)
     // Ausführung und <übernahme in die Datenbank
if (isset($_POST["beschreibung"]) or isset ($_POST["zustand"]) or isset ($_FILES["foto"]) or isset ($_POST["preis"]) and isset ($_GET["ID"])) {
    $statement = $pdo->prepare("UPDATE Upload SET beschreibung=?, zustand=?, foto=?, preis=? WHERE ID=?");
    if ($statement->execute(array(htmlspecialchars($_POST["beschreibung"]), htmlspecialchars($_POST["zustand"]), htmlspecialchars($_FILES["foto"]["name"]), htmlspecialchars($_POST["preis"]), $_GET["ID"]))) {

        //displayMessage-Funktion
        include 'fehlermeldung.php';
        displayMessage("Bearbeiten erfolgreich. <br><a href='ich-biete_Übersicht.php'>Zurück zu den Angeboten</a>",  'fine');


    } else {
        //displayMessage-Funktion
        include 'fehlermeldung.php';
        displayMessage("Datenbank-Fehler. <br>", 'fail');

    }
} else {
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Fehler im Formular. <br>", 'fail');
}

?>

</body>
</html>