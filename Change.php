<?php
include "Header Sicherheit.php";
include "Datenbank Verbindung.php";
session_start();

$ID = $_GET['id'];
$newValue = $_POST['newValue'];
$selectedColumn = $_POST['selectedColumn'];

$statement=$pdo->prepare("UPDATE Upload SET $selectedColumn = :newValue WHERE ID = :ID");
$statement->bindParam(':newValue', $newValue);
$statement->bindParam(':ID', $ID);

if ($statement->execute()){
    echo "<div class='success'>Der Wert wurde erfolgreich geändert!</div>";
}else{
    echo "<div class='fail'>Fehlermeldung!</div>";
    echo $statement->errorInfo()[2];
    die();
}
?>

<a href="ich-biete_Übersicht.php"> <button class="button">Zurück</button></a>
</body>
</html>