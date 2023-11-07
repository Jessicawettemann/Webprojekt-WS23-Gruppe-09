<?php
include"Datenbank Verbindung.php";

session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Registrierung</title>

</head>
<body>

<?php
if(!isset($_POST["Benutzername"]) or !isset($_POST["Passwort"])){
    die("<div class='fail'> Formularfehler </div>");
}

if ($_FILES["Profilbild"]["name"] != null) {
    $fileName = $_FILES["Profilbild"]["name"];
    $fileSplit = explode(".", $fileName);
    $fileType = $fileSplit[sizeof($fileSplit) - 1];

    if ($fileType == "jpg" or $fileType == "png" or $fileType == "PNG" or $fileType == "pdf" or $fileType == "HEIC" or $fileType == "jpeg" or $fileType == "JPG") {
        echo "";
    } else {
        die("<div class='fail'> Dieses Dateiformat wird nicht unterstützt. </div>");
    }
    if ($_FILES["Profilbild"]["size"] > 80000000) {
        die("<div class='fail'> Diese Datei ist leider zu groß </div>");
    }
    if (!move_uploaded_file($_FILES["Profilbild"]["tmp_name"], "/home/jw170/public_html/Bilder/" .$_FILES["Profilbild"]["name"])) {
        echo "<div class='fail'> Datenbankfehler </div>";
    }
}

?>

</body>
</html>