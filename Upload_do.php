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
if (!empty($_FILES["foto"]["name"])){
    $fileName = $_FILES["foto"]["name"];
    $fileSplit = explode(".", $fileName);
    $fileType = $fileSplit[sizeof($fileSplit) - 1];

    if ($fileType == "jpg" or $fileType == "png" or $fileType == "PNG" or $fileType == "pdf" or $fileType == "HEIC" or $fileType == "jpeg" or $fileType == "JPG") {
        echo "";
    } else {
        die("<div class='fail'> Dieses Dateiformat wird nicht unterstützt. </div>");
    }
    if ($_FILES["foto"]["size"] > 80000000) {
        die("<div class='fail'> Diese Datei ist leider zu groß </div>");
    }
    if (!move_uploaded_file($_FILES["foto"]["tmp_name"], "/home/jw170/public_html/Bilder/" . $_FILES["foto"]["name"])) {
        echo "<div class='fail'> Datenbankfehler 1 </div>";
    }
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


if (!isset($_POST["name"]) or !isset($_FILES["foto"])) {
    die("<div class='fail'> Formularfehler </div>");
}
$statement = $pdo->prepare("INSERT INTO Upload (beschreibung, foto,zustand,preis,ort) VALUES (?, ?,?,?,?)");
// Feld soll nicht freigelassen werden:
if ($_POST["name"] !=null) {
    if ($statement->execute(array(htmlspecialchars($_POST["beschreibung"]), htmlspecialchars($_FILES["foto"]["name"]),htmlspecialchars($_POST["zustand"]),htmlspecialchars($_POST["preis"]),htmlspecialchars($_POST["ort"])))) {
        echo "<div class='fine'> Upload erfolgreich" . "<br><br>" . "<a href='Upload.php'>weitere Künstler hinzufügen</a> </div>";
    } else {
        die("<div class='fail'> Datenbank-Fehler 2 </div>");
    }
} else {
    die("<div class='fail'> Das Feld (Künstler-)Name muss ausgefüllt werden!" . "<br><br>" . "<a href='Upload.php'>zurück zum Formular</a> </div>");
}
?>

</body>
</html>

