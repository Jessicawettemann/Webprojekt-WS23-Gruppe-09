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
$statement = $pdo->prepare("INSERT INTO User (Vorname, Nachname, Benutzername, E-mail, Profilbild, Passwort) VALUES (?,?,?,?,?,?)");
$p = "hjfew3545r8c0szhwgfsdafghjgfdhj";

// Felder sollen nicht freigelassen werden:
if(($_POST["Vorname"]) !=null and ($_POST["Nachname"]) !=null and ($_POST["Benutzername"]) !=null and ($_POST["E-Mail"]) !=null and ($_POST["Passwort"]) !=null){
    if($statement->execute(array(htmlspecialchars($_POST["Vorname"]), htmlspecialchars($_POST["Nachname"]), htmlspecialchars($_POST["Benutzername"]), htmlspecialchars($_POST["E-Mail"]), htmlspecialchars($_FILES["Profilbild"]["name"]), password_hash($_POST["Passwort"].$p, PASSWORD_BCRYPT), ))){
        echo"<div class='fine'> Du wurdest erfolgreich registriert "."<br>";
    }else{
        die("<div class='fail'> Diese Zugangsdaten sind bereits vergeben "."<br><br>". "<a href='Registrierung%20Formular.php'>Erneut versuchen</a> </div>");
    }
}else{
    echo"<div class='fail'> Alle Felder müssen ausgefüllt sein! "."<br><br>"."<a href='Registrierung%20Formular.php'>Erneut versuchen</a> </div>";
}
?>

</body>
</html>