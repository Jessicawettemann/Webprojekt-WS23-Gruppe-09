<?php
include "Datenbank Verbindung.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">

    <title>Uploads</title>
</head>
<body>



    <form action="Upload_do.php" method="post" enctype="multipart/form-data">
        <h1> Upload</h1>
        <label class="label" for="beschreibung"></label><br>
        <input type="text" name="beschreibung" placeholder="Beschreinbung">
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
        <input type="text" name="ort" placeholder="Preis">
        <br><br><br>

        <button class="button" type="submit">Hochladen</button>
    </form>



</body>
</html>


