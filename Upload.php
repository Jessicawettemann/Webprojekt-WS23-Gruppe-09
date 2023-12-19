<?php
include "Datenbank Verbindung.php";
session_start();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="Formulare.css">
    <title>Uploads</title>
</head>
<body>


<?php
if(!isset($_SESSION["Nutzer_ID"])){
    echo("<div class='fail'> Bitte melde dich zunächst an! "."<br><br>". "<a href='Login Formular.php'>Hier geht's zum Login</a> </div>");
}else{
    ?>

    <form1 action="Upload_do.php" method="post" enctype="multipart/form-data">
        <h1> Upload</h1>
        <label class="label" for="beschreibung"></label><br>
        <input type="text" name="beschreibung" placeholder="Beschreibung">
        <br>
        <label class="label" for="foto"></label><br>
        <input type="file" name="foto" placeholder="Foto">
        <br>
        <label class="label" for="zustand"></label><br>
        <input type="text" name="zustand" placeholder="Zustand">
        <br>
        <label class="label" for="preis"></label><br>
        <input type="text" name="preis" placeholder="Preis">
        <br>
        <label class="label" for="ort"></label><br>
        <input type="text" name="ort" placeholder="Ort">
        <br><br><br>
        <button class="button" type="submit">Hochladen</button>
    </form1>


    <?php
}
?>

</body>
</html>
