<?php
session_start();
include"Datenbank Verbindung.php";


?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Registrierung</title>

</head>
<body>

<?php

if(!isset($_POST["benutzername"]) or !isset($_POST["passwort"])){
    die("<div class='fail'> Formularfehler </div>");
}

if ($_FILES["profilbild"]["name"] != null) {
    $fileName = $_FILES["profilbild"]["name"];
    $fileSplit = explode(".", $fileName);
    $fileType = $fileSplit[sizeof($fileSplit) - 1];

    if ($fileType == "jpg" or $fileType == "png" or $fileType == "PNG" or $fileType == "pdf" or $fileType == "HEIC" or $fileType == "jpeg" or $fileType == "JPG") {
        echo "";
    } else {
        die("<div class='fail'> Dieses Dateiformat wird nicht unterstützt. </div>");
    }
    if ($_FILES["profilbild"]["size"] > 80000000) {
        die("<div class='fail'> Diese Datei ist leider zu groß </div>");
    }
    if (!move_uploaded_file($_FILES["profilbild"]["tmp_name"], "/home/jw170/public_html/Bilder/" .$_FILES["profilbild"]["name"])) {
        echo "<div class='fail'> Datenbankfehler </div>";
    }
}
$statement = $pdo->prepare("INSERT INTO Nutzer (vorname, nachname, benutzername, email, profilbild, passwort) VALUES (?,?,?,?,?,?)");
$p = "hjfew3545r8c0szhwgfsdafghjgfdhj";

// Felder sollen nicht freigelassen werden:
if(($_POST["vorname"]) !=null and ($_POST["nachname"]) !=null and ($_POST["benutzername"]) !=null and ($_POST["email"]) !=null and ($_POST["passwort"]) !=null){
    if($statement->execute(array(htmlspecialchars($_POST["vorname"]), htmlspecialchars($_POST["nachname"]), htmlspecialchars($_POST["benutzername"]), htmlspecialchars($_POST["email"]), htmlspecialchars($_FILES["profilbild"]["name"]), password_hash($_POST["passwort"].$p, PASSWORD_BCRYPT), ))){
        echo"<div class='fine'> Du wurdest erfolgreich registriert "."<br><br>"."<a href='Startseite.php'>Hier kommst du zur Startseite</a> </div>";
    }else{
        die("<div class='fail'> Diese Zugangsdaten sind bereits vergeben "."<br><br>". "<a href='Registrierung_Formular.php'>Erneut versuchen</a> </div>");
    }
}else{
    echo"<div class='fail'> Alle Felder müssen ausgefüllt sein! "."<br><br>"."<a href='Registrierung_Formular.php'>Erneut versuchen</a> </div>";
}

?>

</body>
</html>