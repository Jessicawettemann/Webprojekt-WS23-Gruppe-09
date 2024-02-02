<?php
include"../db.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Angebot Hinzufügen</title>
    <link rel="stylesheet" type="text/css" href="fehlermeldung.css">
</head>
<body>

<?php
if (!isset($_SESSION["Nutzer_ID"])) {
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Diese Funktion steht nur angemeldeten Nutzern zu Verfügung. <br><a href='Login Formular.php'>Hier geht's zum Login</a>", 'fail');
}
if (!isset($_FILES["Foto"]["tmp_name"]) || !isset($_FILES["Foto"]["name"])) {      ///Wieso steht hier ? Was macht es ?
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Upload fehlgeschlagen", 'fail');
}
if (!empty($_FILES["Foto"]["name"])){
    $fileName = $_FILES["foto"]["name"];
    $fileSplit = explode(".", $fileName);
    $fileType = $fileSplit[sizeof($fileSplit) - 1];    /// ????

    if ($fileType == "jpg" or $fileType == "png" or $fileType == "PNG" or $fileType == "pdf" or $fileType == "HEIC" or $fileType == "jpeg" or $fileType == "JPG") {
        echo "";
    } else {
        //displayMessage-Funktion
        include 'fehlermeldung.php';
        displayMessage("Dieses Dateiformat wird nicht unterstützt.", 'fail');
    }
    if ($_FILES["foto"]["size"] > 80000000) {
        //displayMessage-Funktion
        include 'fehlermeldung.php';
        displayMessage("Diese Datei ist leider zu groß.", 'fail');
    }
    if (!move_uploaded_file($_FILES["foto"]["tmp_name"], "/home/jw170/public_html/Bilder/" . $_FILES["foto"]["name"])) {
        //displayMessage-Funktion
        include 'fehlermeldung.php';
        displayMessage("Datenbankfehler.", 'fail');
    }
}

if (!isset($_POST["name"]) or !isset($_FILES["foto"])) {
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Formularfehler.", 'fail');
}
$statement = $pdo->prepare("INSERT INTO Ich_biete (name, foto) VALUES (?, ?)");   /// ???
// Feld soll nicht freigelassen werden:
if ($_POST["name"] !=null) {
    if ($statement->execute(array(htmlspecialchars($_POST["name"]), htmlspecialchars($_FILES["foto"]["name"])))) {   /// ???
        //displayMessage-Funktion
        include 'fehlermeldung.php';
        displayMessage("Upload erfolgreich. <br><a href='ich-biete_Hinzufügen.php'>Weitere Angebote hinzufügen</a>", 'fine');
    } else {
        //displayMessage-Funktion
        include 'fehlermeldung.php';
        displayMessage("Datenbank-Fehler 2.0. <br>", 'fail');

    }
} else {
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Das Feld Beschreibung muss ausgefüllt werden. <br><a href='ich-biete_Hinzufügen.php'>Zurück zum Formular</a>", 'fail');
}
?>

</body>
</html>