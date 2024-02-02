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
    <link rel="stylesheet" type="text/css" href="fehlermeldung.css">
</head>

<body>
<br><br>
<h1> Bearbeiten</h1>
<br><br>

<?php

if (!move_uploaded_file($_FILES["foto"]["tmp_name"], "/home/jw170/public_html/Bilder/" . $_FILES["foto"]["name"])) {
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Bild konnte nicht hochgeladen werden. <br>", 'fail');
}
if (isset($_POST["beschreibung"]) or isset ($_POST["zustand"]) or isset ($_FILES["foto"]) or isset ($_POST["preis"]) and isset ($_GET["ID"])) {
    $statement = $pdo->prepare("UPDATE Upload SET beschreibung=?, zustand=?, foto=?, preis=? WHERE ID=?");
    if ($statement->execute(array(htmlspecialchars($_POST["beschreibung"]), htmlspecialchars($_POST["zustand"]), htmlspecialchars($_FILES["foto"]["name"]), htmlspecialchars($_POST["preis"]), $_GET["ID"]))) {
        //displayMessage-Funktion
        include 'fehlermeldung.php';
        displayMessage("Bearbeiten erfolgreich. <br>", 'fine');

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
<a class="back" href="ich-biete_Übersicht.php"> zurück zu den Angeboten </a>
</body>
</html>