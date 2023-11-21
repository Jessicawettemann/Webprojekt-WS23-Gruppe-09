<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Angebote löschen</title>
</head>
<body>
<?php
if(!isset($_SESSION["User"])) { #prüft, ob User eingeloggt ist
    die("<div class='fail'>Du musst eingeloggt sein, um deine Angebote löschen zu können!". "<br><br>" . "<a href='../Login Formular.php'>Hier geht's zum Login</a> </div>");
}
if(isset($_GET["ID"])){
    $statement=$pdo->prepare("DELETE FROM Ich_biete WHERE ID=?");
    if($statement->execute(array($_GET["ID"]))){
        echo "<div class='fine'>Angebot wurde erfolgreich gelöscht</div>";
    }else{
        die ("<div class='fail'>Datenbank-Fehler</div>");
    }
}
?>
<a class="back" href="ich-biete_Übersicht.php"> zu den Angeboten </a>
</body>
</html>
