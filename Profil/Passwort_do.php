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
    <title>Passwort bearbeiten</title>

</head>
<body>

<?php
# Passwort Hash für Sicherheit, Definition Pepper
$p = "hjfew3545r8c0szhwgfsdafghjgfdhj";
$hash= password_hash($_POST["passwort"].$p, PASSWORD_BCRYPT);

# Sicherstellung, dass alle für das Editieren notwendigen Felder ausgefüllt sind
if (empty($_POST["passwort"])) {
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Bitte fülle für die Änderung alle Felder aus.<br>", 'fail');
    

} else if(empty($_GET["Nutzer_Id"])) {
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Es ist ein Problem bei der Bearbeitung aufgetreten. Bitte lade die Seite neu.<br>", 'fail');
}

# Änderung der Nutzerdaten in der Datenbank
$statement=$pdo->prepare("UPDATE Nutzer SET passwort=? WHERE ID=?");
$passwort= htmlspecialchars($_POST["passwort"], ENT_QUOTES);
$Nutzer_Id= htmlspecialchars($_GET["Nutzer_Id"], ENT_QUOTES);
$statement->execute([$hash, $Nutzer_Id]);

if($statement->execute()){
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Deine Änderung war erfolgreich. <br>", 'fine');

}else{
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Beim Bearbeiten ist etwas schiefgelaufen, bitte versuche es erneut. <br><a href='Passwort.php'>Passwort bearbeiten</a>", 'fail');
}
?>
</body>
</html>
