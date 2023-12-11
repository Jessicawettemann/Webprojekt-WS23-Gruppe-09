<?php
include"Datenbank Verbindung.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
</head>
<?php
if (!isset($_POST["beschreibung"]) ) {
    die("<div class='fail'> Formularfehler 1 </div>");
}

if (!isset($_FILES["foto"]["tmp_name"]) || !isset($_FILES["foto"]["name"])) {
    die("<div class='fail'> Upload fehlgeschlagen </div>");
}

// Überprüfen Sie den Dateityp und die Dateigröße
$fileName = $_FILES["foto"]["name"];
$fileInfo = pathinfo($fileName);
$fileType = $fileInfo['extension'];
$fileSize = $_FILES["foto"]["size"];

if ($fileType == "jpg" or $fileType == "png" or $fileType == "PNG" or $fileType == "pdf" or $fileType == "HEIC" or $fileType == "jpeg" or $fileType == "JPG") {
    echo "";
} else {
    die("<div class='fail'> Dieses Dateiformat wird nicht unterstützt. </div>");
}

if ($fileSize > 80000000) {
    die("<div class='fail'> Diese Datei ist leider zu groß </div>");
}



     if (!move_uploaded_file($_FILES["foto"]["tmp_name"], "/home/jw170/public_html/Bilder/" . $_FILES["foto"]["name"])) {
        echo "<div class='fail'> Datenbankfehler 1 </div>";

}
if (!isset($_POST["zustand"])) {
    die("<div class='fail'> Zustand eintrag falsch </div>");
}
if (!isset($_POST["preis"]) ) {
    die("<div class='fail'> Preis eintrag falsch </div>");
}
if (!isset($_POST["ort"])) {
    die("<div class='fail'> Ort eintrag falsch </div>");
}





if ((!empty($_POST["beschreibung"])) and (!empty($_POST["foto"])) and (!empty($_FILES["zustand"])) and (!empty($_FILES["preis"])) and (!empty($_FILES["ort"])))  {

    $statement = $pdo->prepare("INSERT INTO Upload (beschreibung, foto, zustand, preis, ort) VALUES (?, ?, ?, ?, ?)");
    if ($statement->execute(array(htmlspecialchars($_POST["beschreibung"]), htmlspecialchars($_FILES["foto"]["name"]), htmlspecialchars($_FILES["zustand"]), htmlspecialchars($_FILES["preis"]), htmlspecialchars($_FILES["ort"])))) {
        echo "<div class='fine'> Eintrag wurde erstellt" . "<br><br>" . "<a href='Upload.php'>weiteren Song hochladen</a> </div>";
    } else {
        echo "</div class=fail>Datenbank-Fehler 3</div>";
        echo $statement->errorInfo()[2];
    }


} else {
    die("<div class='fail'> Alle Felder müssen ausgefüllt sein!" . "<br><br>" . "<a href='Upload.php'>zurück zum Formular</a> </div>");
}
?>
?>



</body>
</html>

