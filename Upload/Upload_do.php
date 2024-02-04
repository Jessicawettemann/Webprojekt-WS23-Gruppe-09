<?php
include "Datenbank Verbindung.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="../fehlermeldung.css">
</head>
<?php
if (!isset($_POST["beschreibung"]) ) {
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Formularfehler 1 <br>", 'fail');

}

if (!isset($_FILES["foto"]["tmp_name"]) || !isset($_FILES["foto"]["name"])) {
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Upload fehlgeschlagen. <br><a href='Upload.php'>Zurück</a>", 'fail');
}

// Überprüfen Sie den Dateityp und die Dateigröße
$fileName = $_FILES["foto"]["name"];
$fileInfo = pathinfo($fileName);
$fileType = $fileInfo['extension'];# datei wird auf foramt überprüft
$fileSize = $_FILES["foto"]["size"];

if ($fileType == "jpg" or $fileType == "png" or $fileType == "PNG" or $fileType == "pdf" or $fileType == "HEIC" or $fileType == "jpeg" or $fileType == "JPG") {
    echo "";
} else {
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Dieses Dateiformat wird nicht unterstützt. <br><a href='Upload.php'>Zurück</a>", 'fail');
}

if ($fileSize > 80000000) {
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Diese Datei ist leider zu groß. <br><a href='Upload.php'>Zurück</a>", 'fail');
}

if (!move_uploaded_file($_FILES["foto"]["tmp_name"], "/home/jw170/public_html/Bilder/" . $_FILES["foto"]["name"])) {
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Datenbankfehler 1.", 'fail');
}

// Überprüfung, ob ein zusätzliches Bild hochgeladen wurde
if (isset($_FILES["optionalImage"]["tmp_name"]) && isset($_FILES["optionalImage"]["name"])) {
        // Überprüfen Sie den Dateityp und die Dateigröße
        $optionalImageFileName = $_FILES["optionalImage"]["name"];
        $optionalImageFileInfo = pathinfo($optionalImageFileName);
        $optionalImageFileType = $optionalImageFileInfo['extension'];
        $optionalImageFileSize = $_FILES["optionalImage"]["size"];
    
        // Überprüfungen
        if ($optionalImageFileType == "jpg" or $optionalImageFileType == "png" or $optionalImageFileType == "PNG" or $optionalImageFileType == "pdf" or $optionalImageFileType == "HEIC" or $optionalImageFileType == "jpeg" or $optionalImageFileType == "JPG") {
            echo "";
        } else {
            //displayMessage-Funktion
            include 'fehlermeldung.php';
            displayMessage("Dieses Dateiformat wird nicht unterstützt. <br><a href='Upload.php'>Zurück</a>", 'fail');
        }
    
        if ($optionalImageFileSize > 80000000) {
            //displayMessage-Funktion
            include 'fehlermeldung.php';
            displayMessage("Diese Datei ist leider zu groß. <br><a href='Upload.php'>Zurück</a>", 'fail');
        }
    
        // Verschiebung zusätzliche Bild in den gewünschten Ordner
        if (!move_uploaded_file($_FILES["optionalImage"]["tmp_name"], "/home/jw170/public_html/Bilder/" . $_FILES["optionalImage"]["name"])) {
            //displayMessage-Funktion
            include 'fehlermeldung.php';
            displayMessage("Datenbankfehler optionales Bild <br>", 'fail');
        }
    }

if (!isset($_POST["zustand"])) {
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Zustand Eintrag falsch. <br><a href='Upload.php'>Zurück</a>", 'fail');
}

if (!isset($_POST["preis"]) ) {
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Preis Eintrag falsch. <br><a href='Upload.php'>Zurück</a>", 'fail');
}

if (!isset($_POST["ort"])) {
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Ort Eintrag falsch. <br><a href='Upload.php'>Zurück</a>", 'fail');
}

if ((!empty($_POST["beschreibung"])) and (!empty($_FILES["foto"])) and (!empty($_POST["zustand"])) and (!empty($_POST["preis"])) and (!empty($_POST["ort"]))) {

    $statement = $pdo->prepare("INSERT INTO Upload (beschreibung, foto, optionalImage, zustand, preis, ort) VALUES (?, ?, ?, ?, ?,?)");
    if ($statement->execute(array(htmlspecialchars($_POST["beschreibung"]), htmlspecialchars($_FILES["foto"]["name"]), htmlspecialchars($_FILES["optionalImage"]["name"]), htmlspecialchars($_POST["zustand"]), htmlspecialchars($_POST["preis"]), htmlspecialchars($_POST["ort"])))) {
            //displayMessage-Funktion
            include 'fehlermeldung.php';
            displayMessage("Eintrag wurde erstellt. <br><a href='ich-biete_Übersicht.php'>Zurück zur Übersicht</a>", 'fine');
        
    } else {
        //displayMessage-Funktion
        include 'fehlermeldung.php';
        displayMessage("Datenbank-Fehler 3. <br>", 'fail');
    }


} else {
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Alle Felder müssen ausgefüllt sein. <br><a href='Upload.php'>Zurück</a>", 'fine');
    
}
?>



</body>
</html>