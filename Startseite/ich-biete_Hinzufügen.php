<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Startseite</title>
    <title>Angebotsübersicht</title>
</head>
<body>
    
<?php
if(!isset($_SESSION["User"])){
    echo("<div class='fail'> Diese Funktion steht nur den Nutzern zu Verfügung! "."<br><br>". "<a href='../Login Formular.php'>Hier geht's zum Login</a> </div>");
}else{
    ?>

    <form action="ich-biete_Hinzufügen_do.php" method="post" enctype="multipart/form-data">
        <label for="thema">Beschreibung:</label>
        <input type="text" id="thema" name="thema" required>

        <label for="foto">Foto hinzufügen:</label>
        <input type="file" id="Foto" placeholder="Foto">

        <label for="beschreibung">Zustand::</label>
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
