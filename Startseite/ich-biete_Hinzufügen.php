<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="fehlermeldung.css">
    <title>Startseite</title>
    <title>Angebotsübersicht</title>
</head>
<body>
    
<?php
if(!isset($_SESSION["Nutzer_ID"])){
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Diese Funktion steht nur den Nutzern zu Verfügung. <br><a href='Login Formular.php'>Hier geht's zum Login</a>", 'fail');

}else{
    ?>

    <form action="ich-biete_Hinzufügen_do.php" method="post" enctype="multipart/form-data">
        <label for="Beschreibung">Beschreibung:</label>
        <input type="text" id="Beschreibung" name="Thema" required>

        <label for="foto">Foto hinzufügen:</label>
        <input type="file" id="Foto" name="Foto" required>

        <label for="Zustand">Zustand::</label>
        <input type="text" id="Zustand" name="Zustand" required>

        <label for="datum">Datum:</label>
        <input type="date" id="Datum" name="Datum" required>

        <label for="preis">Preis:</label>
        <input type="numbers" id="Preis" name="Preis" required>

        <label for="ort">Ort:</label>
        <input type="text" id="Ort" name="Ort" required>

        <button type="submit">Angebot hinzufügen</button>
        
        
    </form>

<?php
}
?>

</body>
</html>
