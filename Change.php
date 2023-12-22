<?php
include "Header Sicherheit.php";
include "Datenbank Verbindung.php";
session_start();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="Formulare_1.css">
    <title>Bearbeiten</title>
</head>
<body>
<h1>Bearbeiten</h1>
<?php
$statement=$pdo->prepare("SELECT * FROM Upload WHERE ID=?");
if ($statement->execute(array($_GET["ID"]))){
    if($row=$statement->fetch()){
        ?>
        <form action="Change_do.php?ID=<?php echo $row["ID"];?>" method="post" enctype="multipart/form-data">
            <input type="text" placeholder="Neue Beschreibung" name="beschreibung" value="<?php echo $row["beschreibung"];?>">
             <input type="text" placeholder="Neuer Zustand" name="zustand" value="<?php echo $row["zustand"];?>">
            <input type="file" name="foto" value="<?php echo $row["foto"];?>">
             <input type="text" placeholder="Neuer Preis" name="preis" value="<?php echo $row["preis"];?>" > <br>

            <button type="submit">Absenden</button> <br>
            <a href="ich-biete_Übersicht.php"> <button class="button">Zurück</button></a>
        </form>
        <?php

    }else{
        die("<div class='fail'>Beitrag schon vorhanden</div>");
    }

} else{
    die("<div class='fail'>Formular-Fehler</div>");
}



?>



</body>
</html>