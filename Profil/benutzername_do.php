<?php

include 'Datenbank Verbindung.php';
include "Header Sicherheit.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">

    <title>Username bearbeiten</title>

</head>
<body>

<?php

# Sicherstellung, dass alle für das Editieren notwendigen Felder ausgefüllt sind -> funktioniert nicht
if (empty($_POST["benutzername"])) {
    die("<div class='fail'>Bitte fülle für die Änderung alle Felder aus</div>"."<a href= 'benutzername.php'> Zurück zum Bearbeiten</a>");
} else if(empty($_GET["Nutzer_id"])) {
    die("<div class='fail'>Es ist ein Problem bei der Bearbeitung passiert. Bitte probieren es erneut.</div>"."<a href= 'benutzername.php'> Zurück zum Bearbeiten</a>");
}

# Prüfen ob Nutzername bereits vorhanden
$benutzername = htmlspecialchars($_POST["benutzername"], ENT_QUOTES);
$statement=$pdo->prepare("SELECT * FROM Nutzer WHERE benutzername = ?"); #alle Informationen aus der Tabelle "Nutzer" abzurufen, bei denen der Benutzername stimmt
$statement->execute([$benutzername]);
$benutzername2 = $statement-> fetch(); #Nutzer mit dem übergebenen Benutzernamen existiert, werden dessen Informationen in der Variable $benutzername2 gespeichert


if ($benutzername2){
    die ("<div class='fail'>Der Nutzername existiert bereits, bitte wähle einen anderen.</div>"."</p> <a href= 'benutzername.php'> Profil bearbeiten</a>"); # wenn nicht fehlermeldung
}else{
    # Änderung der Nutzerdaten in der Datenbank
    $statement2=$pdo->prepare("UPDATE Nutzer SET benutzername=? WHERE ID=?");
    $Nutzer_id= htmlspecialchars($_GET["Nutzer_id"], ENT_QUOTES); #htmi angriffe schützen durch html
    $statement2->execute([$benutzername, $Nutzer_id]);# gibt true zurück, wenn die Aktualisierung erfolgreich war, andernfalls false.
}
if($statement->execute()){
    echo '<p>'. "<div class='fine'>Deine Änderung war erfolgreich!</div>";
}else{
    echo '<p>'. "<div class='fail'>Beim Bearbeiten ist etwas schiefgelaufen, bitte versuche es erneut</div>.". "</p> <a href= 'benutzername.php'> Benutzername bearbeiten</a>";
}
?>
</body>
</html>
