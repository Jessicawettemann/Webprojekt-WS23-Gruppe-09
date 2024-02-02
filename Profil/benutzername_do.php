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

    <title>Username bearbeiten</title>

</head>
<body>

<?php



# Prüfen ob Nutzername bereits vorhanden
$benutzername = htmlspecialchars($_POST["benutzername"], ENT_QUOTES);
$statement=$pdo->prepare("SELECT * FROM Nutzer WHERE benutzername = ?"); #alle Informationen aus der Tabelle "Nutzer" abzurufen, bei denen der Benutzername stimmt
$statement->execute([$benutzername]);
$benutzername2 = $statement-> fetch(); #Nutzer mit dem übergebenen Benutzernamen existiert, werden dessen Informationen in der Variable $benutzername2 gespeichert


if ($benutzername2){
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Der Nutzername existiert bereits, bitte wähle einen anderen. <br><a href='benutzername.php'>Profil bearbeiten</a>", 'fail');
 # wenn nicht fehlermeldung

}else{
    # Änderung der Nutzerdaten in der Datenbank
    $statement2=$pdo->prepare("UPDATE Nutzer SET benutzername=? WHERE ID=?");
    $Nutzer_id= htmlspecialchars($_GET["Nutzer_id"], ENT_QUOTES); #htmi angriffe schützen durch html
    $statement2->execute([$benutzername, $Nutzer_id]);# gibt true zurück, wenn die Aktualisierung erfolgreich war, andernfalls false.
}

?>
</body>
</html>
