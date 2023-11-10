<?php

include 'Datenbank Verbindung.php';

session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Passwort bearbeiten</title>

</head>
<body>

<?php
# Passwort Hash für Sicherheit, Definition Pepper
$p = "hjfew3545r8c0szhwgfsdafghjgfdhj";
$hash= password_hash($_POST["passwort"].$p, PASSWORD_BCRYPT);

# Sicherstellung, dass alle für das Editieren notwendigen Felder ausgefüllt sind
if (empty($_POST["passwort"])) {
    die("<div class='fail'>Bitte fülle für die Änderung alle Felder aus</div>");
} else if(empty($_GET["Nutzer_Id"])) {
    die("<div class='fail'>Es ist ein Problem bei der Bearbeitung aufgetreten. Bitte lade die Seite neu.</div>");
}

# Änderung der Nutzerdaten in der Datenbank
$statement=$pdo->prepare("UPDATE Nutzer SET passwort=? WHERE ID=?");
$passwort= htmlspecialchars($_POST["passwort"], ENT_QUOTES);
$Nutzer_Id= htmlspecialchars($_GET["Nutzer_Id"], ENT_QUOTES);
$statement->execute([$hash, $Nutzer_Id]);

if($statement->execute()){
    echo '<p>'. "<div class='fine''>Deine Änderung war erfolgreich!</div>";
}else{
    echo '<p>'. "<div class='fail'>Beim Bearbeiten ist etwas schiefgelaufen, bitte versuche es erneut.</div>". "</p> <a href= 'Passwort.php'> Passwort bearbeiten</a>";
}
?>
</body>
</html>
