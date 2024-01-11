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
    <link rel="stylesheet" type="text/css" href="css_kalender.css">
</head>
<body>

    <?php
    //Aktivität eintragen
    $statement = $pdo->prepare("INSERT INTO Aktivitäten (thema, beschreibung, datum, ort) VALUES (?,?,?,?)");

    if(($_POST["thema"]) !=null and ($_POST["beschreibung"]) !=null and ($_POST["datum"]) !=null and ($_POST["ort"]) !=null){
        $currentDate = date('Y-m-d');
        $inputDate = htmlspecialchars($_POST["datum"]);
        if(strtotime($inputDate) >= strtotime($currentDate)){
            if($statement->execute(array(htmlspecialchars($_POST["thema"]), htmlspecialchars($_POST["beschreibung"]), htmlspecialchars($_POST["datum"]), htmlspecialchars($_POST["ort"]),))){
                echo "<div class='fine'> Ereignis gespeichert </div>". "<br><br>" . "<a href='aktivitaeten.php'>Zu den Aktivitäten</a> </div>";
            } else {
                die("<div class='fail'> Fehlgeschlagen." . "<br><br>" . "<a href='aktivitaeten.php'>Erneut versuchen</a> </div>");
            }
        } else {
            die("<div class='fail'> Fehlgeschlagen: Das eingegebene Datum darf nicht in der Vergangenheit liegen. <br><br>" . "<a href='aktivitaeten.php'>Erneut versuchen</a> </div>");
        }
    }
    ?>

    <!-- Hier füge den Kalender ein -->
    <?php include "calendar.php"; ?>

</body>
</html>
