<?php

include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">

    <title>Forum</title>
</head>
<body>

<?php


//Aktivität eintragen


$statement = $pdo->prepare("INSERT INTO Beitrag (beitrag) VALUES (?)");

// Feld sollen nicht freigelassen werden:


        if($statement->execute(array(htmlspecialchars($_POST["beitrag"]),))){
            echo "<div class='fine'> Ereignis gespeichert </div>". "<br><br>" . "<a href='community_do.php'>Zu den Beiträgen</a> </div>";
        } else {
            die("<div class='fail'> Fehlgeschlagen." . "<br><br>" . "<a href='community_do.php'>Erneut versuchen</a> </div>");
        }


?>
</body>
</html>
