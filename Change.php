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
$statement=$pdo->prepare("SELECT * FROM Upload WHERE ID=?"); // Vorbereitung Abfrage für aus Upload für eine bestimmte ID
if ($statement->execute(array($_GET["ID"]))){  //Ausführung Abfrage mit der ID aus der URL / Wenn erfolgreich gehts weiter
    if($row=$statement->fetch()){ // Überüfung ob fetch ein Ergebnis liefert (Wenn gefunden dann wird dieser in $row gespeichert) 

// Unten werden Eingabefelder erstellt, welche vorab den ursprünglichen Wert aus der Datenbank anzeigen
?> 

        <form action="Change_do.php?ID=<?php echo $row["ID"];?>" method="post" enctype="multipart/form-data">  
            <h1>Bearbeiten</h1>
            <input type="text" name="beschreibung" value="<?php echo $row["beschreibung"];?>">
            <input type="text" name="zustand" value="<?php echo $row["zustand"];?>">
            <input type="file" name="foto">
            <input type="text" name="preis" value="<?php echo $row["preis"];?>" > <br>

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
        die("<div class='fail'>Formulare-Fehler</div>");
    }
?>

</body>
</html>