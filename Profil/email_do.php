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
    <title>E- Mail bearbeiten</title>

</head>
<body>

<?php

# Sicherstellung, dass alle für das Editieren notwendigen Felder ausgefüllt sind
if (empty($_POST["email"])) {
    die("<div class='fail'>Bitte fülle für die Registrierung alle Felder aus</div>");
} else if(empty($_GET["Nutzer_Id"])) {
    die("<div class='fail'>Es ist ein Problem bei der Bearbeitung passiert. Bitte probieren sie es nochmal von vorne.</div>");
}

# Prüfen ob Mail bereits vorhanden
$email= htmlspecialchars($_POST["email"], ENT_QUOTES);
$statement=$pdo->prepare("SELECT * FROM Nutzer WHERE email = ?");
$statement->execute([$email]);
$email2 = $statement-> fetch();
if ($email2){
    die ("<div class='fail'>Die Mailadresse existiert bereits, bitte wähle eine andere.</div>". "</p> <a href= 'email.php'> Zurück zur Bearbeitung</a>");
}else{
    # Änderung der Nutzerdaten in der Datenbank
    $statement2=$pdo->prepare("UPDATE Nutzer SET email=? WHERE ID=?");
    $Nutzer_Id= htmlspecialchars($_GET["Nutzer_Id"], ENT_QUOTES);
    $statement2->execute([$email, $Nutzer_Id]);
}
if($statement->execute()){
    echo '<p>'. "<div class='fine''>Deine Änderung war erfolgreich!</div>";
}else{
    echo '<p>'. "<div>Beim Bearbeiten ist etwas schiefgelaufen, bitte versuche es erneut.</div>". "</p> <a href= 'email_do.php'> Mail bearbeiten</a>";
}
?>
</body>
</html>
