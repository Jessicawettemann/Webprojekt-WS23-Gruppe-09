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
if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $beschreibung=$_POST['beschreibung'];
    $foto=$_FILES['foto'];
    $optionalImage=$_FILES['optionalImage'];
    $zustand=$_POST['zustand'];
    $preis=$_POST['preis'];
    $ort=$_POST['ort'];
    $statement=$pdo->prepare("UPDATE Upload SET beschreibung=?, foto=?, optionalImage=?, zustand=?, preis=?, ort=? WHERE ID=?");
    if ($statement->execute([$id, $beschreibung, $foto, $optionalImage, $zustand, $preis, $ort])){
        header('Location: ich-biete_Übersicht.php');
        exit ();
    }else{
        echo "<div class='fail'>Fehlermeldung!</div>";
        echo $statement->errorInfo()[2];
        die();
    }
}
?>

</body>
</html>