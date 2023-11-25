<?php
include"../db.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Angebot Hinzufügen</title>
</head>
<body>

<?php
if (!isset($_SESSION["User"])) {
    die("<div class='fail'>Diese Funktion steht nur angemeldeten Nutzern zu! "."<br><br>". "<a href='../Login Formular.php'>Hier geht's zum Login</a> </div>");
}
if (!isset($_FILES["Foto"]["tmp_name"]) || !isset($_FILES["Foto"]["name"])) {
    die("<div class='fail'> Upload fehlgeschlagen </div>");
}
if (!empty($_FILES["Foto"]["name"])){
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
        echo "<div class='fail'> Datenbankfehler </div>";
    }
}

if (!isset($_POST["name"]) or !isset($_FILES["foto"])) {
    die("<div class='fail'> Formularfehler </div>");
}
$statement = $pdo->prepare("INSERT INTO Ich_biete (name, foto) VALUES (?, ?)");
// Feld soll nicht freigelassen werden:
if ($_POST["name"] !=null) {
    if ($statement->execute(array(htmlspecialchars($_POST["name"]), htmlspecialchars($_FILES["foto"]["name"])))) {
        echo "<div class='fine'> Upload erfolgreich" . "<br><br>" . "<a href='ich-biete_Hinzufügen.php'>weitere Angebote hinzufügen</a> </div>";
    } else {
        die("<div class='fail'> Datenbank-Fehler 2.0 </div>");
    }
} else {
    die("<div class='fail'> Das Feld Beschreibung muss ausgefüllt werden!" . "<br><br>" . "<a href='ich-biete_Hinzufügen.php'>zurück zum Formular</a> </div>");
}
?>

</body>
</html>