<?php
include 'Datenbank Verbindung.php';
include "Header Sicherheit.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="Profil_1.css">
    <link rel="stylesheet" type="text/css" href="fehlermeldung.css">
    <title>E- Mail bearbeiten</title>

</head>
<body>

<?php

# Sicherstellung, dass alle für das Editieren notwendigen Felder ausgefüllt sind
if (empty($_POST["email"])) {
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Bitte fülle für die Registrierung alle Felder aus. <br>", 'fail');
    
} else if(empty($_GET["Nutzer_Id"])) {
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Es ist ein Problem bei der Bearbeitung passiert. Bitte probieren sie es nochmal von vorne. <br>", 'fail');
}

# Prüfen ob Mail bereits vorhanden
$email= htmlspecialchars($_POST["email"], ENT_QUOTES);
$statement=$pdo->prepare("SELECT * FROM Nutzer WHERE email = ?");
$statement->execute([$email]);
$email2 = $statement-> fetch();
if ($email2){
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Die Mailadresse existiert bereits, bitte wähle eine andere.<br><a href='email.php'>Zurück zur Bearbeitung</a>", 'fail');

}else{
    # Änderung der Nutzerdaten in der Datenbank
    $statement2=$pdo->prepare("UPDATE Nutzer SET email=? WHERE ID=?");
    $Nutzer_Id= htmlspecialchars($_GET["Nutzer_Id"], ENT_QUOTES);
    $statement2->execute([$email, $Nutzer_Id]);
}
if($statement->execute()){
        //displayMessage-Funktion
        include 'fehlermeldung.php';
        displayMessage("Deine Änderung war erfolgreich.<br>", 'fine');

}else{
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Beim Bearbeiten ist etwas schiefgelaufen, bitte versuche es erneut.<br><a href='email.php'>Mail bearbeiten</a>", 'fail');
}
?>
</body>
</html>
