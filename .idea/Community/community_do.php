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


   <title>Kalender</title>
</head>
<body>

<?php

//Beitrag eintragen
$statement = $pdo->prepare("INSERT INTO Beitrag (beitrag) VALUES (?)");

// Feld sollen nicht freigelassen werden:
if(($_POST["beitrag"]) !=null){

       if($statement->execute(array(htmlspecialchars($_POST["beitrag"]),))){
           echo "<div class='fine'> Beitrag gespeichert </div>". "<br><br>" . "<a href='community.php'>Zu den Beiträgen</a> </div>";
       } else {
           die("<div class='fail'> Fehlgeschlagen." . "<br><br>" . "<a href='community.php'>Erneut versuchen</a> </div>");
       }
   }

?>
</body>
</html>