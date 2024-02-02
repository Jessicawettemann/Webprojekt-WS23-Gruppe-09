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
    <link rel="stylesheet" type="text/css" href="Bearbeiten.css">
    <link rel="stylesheet" type="text/css" href="fehlermeldung.css">
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
            <h1>Bearbeiten</h1>
            <input type="text" placeholder="Neue Beschreibung" name="beschreibung" value="<?php echo $row["beschreibung"];?>">
             <input type="text" placeholder="Neuer Zustand" name="zustand" value="<?php echo $row["zustand"];?>">
            <input type="file" name="foto" value="<?php echo $row["foto"];?>">
             <input type="text" placeholder="Neuer Preis" name="preis" value="<?php echo $row["preis"];?>" > <br>

            <button type="submit">Absenden</button> <br><br>
            <a href="ich-biete_Übersicht.php">Zurück </a>
        </form>
        <?php

    }else{
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Beitrag schon vorhanden. <br>", 'fail');
    }

} else{
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Formular-Fehler. <br>", 'fail');
}



?>



</body>
</html>