<?php
include 'Datenbank Verbindung.php';

session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Profilbild bearbeiten</title>

</head>
<body>

<?php
# Sicherstellung, dass alle für das Editieren notwendigen Felder ausgefüllt sind
if ($_FILES["profilbild"]["name"]=="") {
    die("<div class='fail'>Bitte füge ein Profilbild hinzu</div>");
} elseif ($_FILES ["profilbild"] ["size"] > 10000000){
    die("<div class='fail'>Bild größer als 1 MB</div>");
} else if(empty($_GET["Nutzer_Id"])) {
    die("<div class='fail'>Es ist ein Problem bei der Bearbeitung aufgetreten. Bitte lade die Seite neu.</div>");
}

# Sicherstellung, dass Dateityp jpg, png, gif, jpeg ist
$profilbild = $_FILES["profilbild"]["name"];
$filesplit = explode(".", $profilbild);
$filetyp = end ($filesplit);
if (!in_array($filetyp, array("jpg","JPG", "png", "gif", "jpeg"))){
    die ("<div class='fail'>Datei ist kein Bild (akzeptierte Dateitypen: .jpg, .jpeg, .png, .gif)</div>");
}

# Änderung der Nutzerdaten in der Datenbank
$statement=$pdo->prepare("UPDATE Nutzer SET profilbild=? WHERE ID=?");
$Nutzer_Id= htmlspecialchars($_GET["Nutzer_Id"], ENT_QUOTES);
$statement->execute([$profilbild, $Nutzer_Id]);


if($statement->execute()){
    echo '<p>'. "Deine Änderung war erfolgreich!";
    if(!move_uploaded_file($_FILES["profilbild"]["tmp_name"], "/home/jw170/public_html/Bilder/".$_FILES["profilbild"]["name"])) {
        echo "<div class='fail'>Dateifehler!</div>";
    }
}else{
    echo '<p>'. "<div class='fail'>Beim Bearbeiten ist etwas schiefgelaufen, bitte versuche es erneut.</div>". "</p> <a href= 'Profilbild.php'> Profilepicture bearbeiten</a>";
}
?>
</body>
</html>