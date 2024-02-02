<?php
include 'Datenbank Verbindung.php';
include "Header Sicherheit.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="fehlermeldung.css">
    <title>Profilbild bearbeiten</title>

</head>
<body>

<?php
# Sicherstellung, dass alle für das Editieren notwendigen Felder ausgefüllt sind
if ($_FILES["profilbild"]["name"]=="") {
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Bitte füge ein Profilbild hinzu. <br>", 'fail');
   
} elseif ($_FILES ["profilbild"] ["size"] > 10000000){
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Bild größer als 1 MB. <br>", 'fail');
   
} else if(empty($_GET["Nutzer_Id"])) {
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Es ist ein Problem bei der Bearbeitung aufgetreten. Bitte lade die Seite neu. <br>", 'fail');
}

# Sicherstellung, dass Dateityp jpg, png, gif, jpeg ist
$profilbild = $_FILES["profilbild"]["name"];
$filesplit = explode(".", $profilbild);
$filetyp = end ($filesplit);
if (!in_array($filetyp, array("jpg","JPG", "png", "gif", "jpeg"))){
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Datei ist kein Bild (akzeptierte Dateitypen: .jpg, .jpeg, .png, .gif). <br>", 'fail');
}

# Änderung der Nutzerdaten in der Datenbank
$statement=$pdo->prepare("UPDATE Nutzer SET profilbild=? WHERE ID=?");
$Nutzer_Id= htmlspecialchars($_GET["Nutzer_Id"], ENT_QUOTES);
$statement->execute([$profilbild, $Nutzer_Id]);


if($statement->execute()){
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Deine Änderung war erfolgreich. <br>", 'fine');

    if(!move_uploaded_file($_FILES["profilbild"]["tmp_name"], "/home/jw170/public_html/Bilder/".$_FILES["profilbild"]["name"])) {
        //displayMessage-Funktion
        include 'fehlermeldung.php';
        displayMessage("Dateifehler. <br>", 'fail');
    }
}else{
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Beim Bearbeiten ist etwas schiefgelaufen, bitte versuche es erneut. <br><a href='Profilbild.php'>Profilbild bearbeiten</a>", 'fail');
}
?>
</body>
</html>