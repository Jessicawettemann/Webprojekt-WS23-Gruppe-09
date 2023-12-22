<?php
include "Header Sicherheit.php";
include "Datenbank Verbindung.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Bearbeiten</title>
    <link rel="stylesheet" href="Übersicht.css">
</head>

<body>
<br><br>
<h1> Bearbeiten</h1>
<br><br>

<?php

if (!move_uploaded_file($_FILES["foto"]["tmp_name"], "/home/jw170/public_html/Bilder/" . $_FILES["foto"]["name"])) {
    die ("<div class='fail'>Bild konnte nicht hochgeladen werden</div>");
}
if (isset($_POST["beschreibung"]) or isset ($_POST["zustand"]) or isset ($_FILES["foto"]) or isset ($_POST["preis"]) and isset ($_GET["ID"])) {
    $statement = $pdo->prepare("UPDATE Upload SET beschreibung=?, zustand=?, foto=?, preis=? WHERE ID=?");
    if ($statement->execute(array(htmlspecialchars($_POST["beschreibung"]), htmlspecialchars($_POST["zustand"]), htmlspecialchars($_FILES["foto"]["name"]), htmlspecialchars($_POST["preis"]), $_GET["ID"]))) {
        echo "<div class='fine'>Bearbeiten erfolgreich</div>" . "<br>";
    } else {
        echo "<div class='fail'>Datenbank-Fehler</div>";
        echo $statement->errorInfo()[2];
    }
} else {
    die ("<div class='fail'>Fehler im Formular</div>");
}

?>
<a class="back" href="ich-biete_Übersicht.php"> zurück zu den Songs </a>
</body>
</html>